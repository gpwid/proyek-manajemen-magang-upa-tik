<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SupervisorsExport;
use App\Http\Controllers\Controller;
use App\Models\Supervisor;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class SupervisorController extends Controller
{
    public function index(): View
    {
        return view('admin.pembimbing.index');
    }

    public function data(Request $request)
    {
        $query = Supervisor::query();

        // Filter Search Custom
        if ($request->searchbox) {
            $search = $request->searchbox;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('actions', function ($p) {
                return "<div class='flex gap-2'>
                    <a href='".route('admin.pembimbing.edit', $p->id)."'
                       class='btn btn-sm btn-primary text-white'
                       data-bs-toggle='tooltip'
                       data-bs-placement='top'
                       title='Edit'>
                        <i class='fa-solid fa-pen-to-square'></i> Edit
                    </a>
                </div>";
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function create(): View
    {
        return view('admin.pembimbing.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama'  => ['required', 'string', 'max:50'],
            'nip'   => ['required', 'string', 'max:30', 'unique:supervisors,nip'],
            'email' => [
                'required', 'string', 'email', 'max:191',
                'unique:supervisors,email',
                'unique:users,email',
            ],
        ]);

        DB::transaction(function () use ($validated) {
            // 1) Buat akun user dengan role 'pembimbing'
            $user = User::create([
                'name'     => $validated['nama'],
                'email'    => $validated['email'],
                'password' => Hash::make($validated['nip']), // password awal = NIP
                'role'     => 'pembimbing',
            ]);

            // (Opsional) Spatie Permission
            if (method_exists($user, 'assignRole')) {
                $user->assignRole('pembimbing');
            }

            // 2) Buat Supervisor terhubung ke user
            Supervisor::create([
                'nama'    => $validated['nama'],
                'nip'     => $validated['nip'],
                'email'   => $validated['email'],
                'user_id' => $user->id,
            ]);
        });

        return redirect()
            ->route('admin.pembimbing.index')
            ->with('sukses', 'Pembimbing berhasil ditambahkan.');
    }

    public function edit(Supervisor $supervisor): View
    {
        return view('admin.pembimbing.edit', compact('supervisor'));
    }

    public function update(Request $request, Supervisor $supervisor): RedirectResponse
    {
        $validated = $request->validate([
            'nama'  => ['required', 'string', 'max:50'],
            'nip'   => [
                'required', 'string', 'max:30',
                Rule::unique('supervisors', 'nip')->ignore($supervisor->id),
            ],
            'email' => [
                'required', 'string', 'email', 'max:191',
                Rule::unique('supervisors', 'email')->ignore($supervisor->id),
                // unique di users juga; kalau supervisor sudah punya user_id, abaikan email user itu
                Rule::unique('users', 'email')->ignore($supervisor->user_id),
            ],
        ]);

        DB::transaction(function () use ($validated, $supervisor) {
            // Update supervisor
            $supervisor->update([
                'nama'  => $validated['nama'],
                'nip'   => $validated['nip'],
                'email' => $validated['email'],
            ]);

            // Sinkron ke tabel users (jika user terkait ada)
            if ($supervisor->user_id) {
                $user = User::find($supervisor->user_id);
                if ($user) {
                    $user->update([
                        'name'  => $validated['nama'],
                        'email' => $validated['email'],
                        // password tidak diubah di sini; kalau mau, bisa tambah opsi ganti password
                    ]);
                }
            }
        });

        return redirect()
            ->route('admin.pembimbing.index')
            ->with('sukses', 'Data pembimbing berhasil diperbarui.');
    }

    public function exportExcel(Request $request)
    {
        $filename = 'pembimbing_'.now()->format('Ymd_His').'.xlsx';
        return Excel::download(new SupervisorsExport($request), $filename);
    }

    public function exportPdf(Request $request)
    {
        $q = Supervisor::query();

        if ($search = $request->get('searchbox')) {
            $q->where(function ($x) use ($search) {
                $x->where('nama', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $data = $q->orderBy('nama')->get();
        $subtitle = $request->get('searchbox') ? 'Hasil pencarian untuk: "'.$request->get('searchbox').'"' : '';

        $pdf = Pdf::loadView('admin.pembimbing.pdf', compact('data', 'subtitle'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('pembimbing_'.now()->format('Ymd_His').'.pdf');
    }
}
