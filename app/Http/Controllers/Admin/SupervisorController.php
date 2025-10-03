<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SupervisorsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupervisorRequest;
use App\Http\Requests\UpdateSupervisorRequest;
use App\Models\Supervisor;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


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
                    ->orWhere('nip', 'like', "%{$search}%");
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

    public function store(StoreSupervisorRequest $request): RedirectResponse
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'nip'  => 'required|string|max:30|unique:supervisors,nip',
        ]);

        $nama = $request->input('nama');
        $nip  = $request->input('nip');

        // Bentuk email dasar dari nama → nama@unri.ac.id (dibersihkan)
        $baseEmail = $this->emailFromName($nama);
        // Pastikan unik di tabel users
        $email = $this->uniqueEmail($baseEmail);

        DB::transaction(function () use ($nama, $nip, $email) {
            // 1) Buat akun user dengan role 'pembimbing'
            $user = User::create([
                'name'     => $nama,
                'email'    => $email,
                'password' => Hash::make($nip),    // password awal = NIP
                'role'     => 'pembimbing',        // kolom role di tabel users
            ]);

            // 2) (Opsional) Jika pakai Spatie Permission:
            if (method_exists($user, 'assignRole')) {
                $user->assignRole('pembimbing');
            }

            // 3) Buat supervisor terhubung ke user + simpan email
            Supervisor::create([
                'nama'    => $nama,
                'nip'     => $nip,
                'email'   => $email,
                'user_id' => $user->id,
            ]);
        });

        return redirect()
            ->route('admin.pembimbing.index')
            ->with('sukses', 'Data Disimpan & akun pembimbing dibuat.');
    }

    public function edit(Supervisor $supervisor): View
    {
        return view('admin.pembimbing.edit', compact('supervisor'));
    }

    public function update(UpdateSupervisorRequest $request, Supervisor $supervisor): RedirectResponse
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'nip'  => 'required|string|max:30|unique:supervisors,nip,'.$supervisor->id,
        ]);

        // Catatan: kalau ingin sinkron juga ke tabel users (name/email), bisa ditambah di sini.
        $supervisor->update($request->only(['nama','nip']));

        return redirect()
            ->route('admin.pembimbing.index')
            ->with('sukses', 'Data berhasil diperbarui');
    }

    public function exportExcel(Request $request)
    {
        $filename = 'pembimbing_'.now()->format('Ymd_His').'.xlsx';

        return Excel::download(new SupervisorsExport($request), $filename);
    }

    public function exportPdf(Request $request)
    {
        $q = Supervisor::query();

        if ($search = $request->get('search')) {
            $q->where(function ($x) use ($search) {
                $x->where('nama', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");
            });
        }

        $data = $q->orderBy('nama')->get();
        $subtitle = '';
        if ($search) {
            $subtitle = 'Hasil pencarian untuk: "'.$search.'"';
        }

        $pdf = Pdf::loadView('admin.pembimbing.pdf', compact('data', 'subtitle'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('supervisor_'.now()->format('Ymd_His').'.pdf');
    }

    /**
     * Bentuk base email dari nama → nama@unri.ac.id
     * - huruf kecil
     * - hapus non-alfanumerik
     */
    private function emailFromName(string $nama): string
    {
        $local = Str::of($nama)
            ->lower()
            ->replaceMatches('/[^a-z0-9]+/i', '')
            ->limit(64, '');

        $local = $local->isEmpty() ? 'user' : (string)$local;

        return $local . '@unri.ac.id';
    }

    /**
     * Pastikan email unik di tabel users.
     * Jika sudah ada, akan menjadi nama2@unri.ac.id, nama3@unri.ac.id, dst.
     */
    private function uniqueEmail(string $baseEmail): string
    {
        [$local, $domain] = explode('@', $baseEmail, 2);
        $email = $baseEmail;
        $n = 1;

        while (User::where('email', $email)->exists()) {
            $n++;
            $email = $local . $n . '@' . $domain;
        }

        return $email;
    }
}
