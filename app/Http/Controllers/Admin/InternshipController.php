<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Instansi;
use App\Models\Internship;
use App\Models\Participant;
use App\Models\Permohonan;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class InternshipController extends Controller
{
    public function index(Request $request): View
    {

        $totalAktif = Internship::where('status_magang', 'Aktif')->count();
        $totalNonaktif = Internship::where('status_magang', 'Nonaktif')->count();
        $totalSemua = Internship::count();

        $internships = Internship::with([
            'participants:id,nama,nik',
            'permohonan:id,instansi,tgl_mulai,tgl_selesai,jenis_magang',
            'supervisor:id,nama,nip',
        ])
            ->latest('created_at')
            ->paginate(10);

        return view('admin.internship.index', compact('totalAktif', 'totalNonaktif', 'totalSemua', 'internships'));
    }

    public function show(Internship $internship)
    {
        $internship->load(['permohonan', 'participants', 'supervisor']);

        return view('admin.internship.detail', compact('internship'));
    }

    public function data(Request $request)
    {
        // Endpoint untuk DataTables Yajra
        $query = Internship::query()->with([
            'supervisor:id,nama',
            'permohonan:id,instansi,tgl_mulai,tgl_selesai,jenis_magang',
            'participants:id,nama',
        ]);

        // Filter berdasarkan query parameters
        if ($request->filled('status_magang')) {
            $query->where('status_magang', $request->status_magang);
        }


        // Query untuk DataTables
        return DataTables::of($query)
            ->editColumn('tgl_mulai', fn($p) => optional($p->permohonan->tgl_mulai)->format('d-m-Y'))
            ->editColumn('tgl_selesai', fn($p) => optional($p->permohonan->tgl_selesai)->format('d-m-Y'))
            ->addColumn('pembimbing', fn($p) => optional($p->supervisor)->nama ?? '-')
            ->addColumn('permohonan', fn($p) => optional($p->permohonan)->id ?? '-')
            ->addColumn('peserta',    fn($p) => optional($p->participant)->nama ?? '-')
            ->editColumn('status_magang', function ($p) {
                $cls = $p->status_magang == 'Aktif' ? 'bg-success' : 'bg-secondary';
                return "<span class='badge $cls'>$p->status_magang</span>";
            })
            ->addColumn('aksi', function ($p) {
                $url1 = route('admin.internship.edit', $p->id);
                $url2 = route('admin.internship.show', $p->id);
                return "<div class='flex gap-2'>
                        <a href='$url1' class='btn btn-sm btn-primary text-white' data-bs-toggle='tooltip'
        data-bs-placement='top' title='Edit'>
                            <i class='fa-solid fa-pen-to-square'></i> Edit
                        </a>
                        <a href='$url2' class='btn btn-sm btn-success text-white' data-bs-toggle='tooltip'
        data-bs-placement='top' title='Detail'>
                            <i class='fa-solid fa-eye'></i> Detail
                        </a>
                        </div>";
            })
            ->rawColumns(['status_magang', 'aksi'])
            ->make(true);
    }

    public function create()
    {
        $permohonan  = Permohonan::where('status', 'Aktif')->orderBy('instansi')->get();
        $supervisors = Supervisor::all();
        $participants = Participant::all();
        return view('admin.internship.create', compact('permohonan', 'supervisors', 'participants'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate(
            [
                // Hanya izinkan permohonan yang ada di tabel 'permohonan' DAN statusnya 'Aktif'
                'id_permohonan' => ['required', 'integer', Rule::exists('permohonan', 'id')->where(function ($query) {
                    $query->where('status', 'Aktif');
                })],
                'id_pembimbing' => 'required|integer|exists:supervisors,id',
                'id_peserta'    => 'required|array',
                'id_peserta.*'  => 'integer|exists:participants,id',
            ],
            [
                // Menambahkan pesan error kustom agar lebih informatif
                'id_permohonan.exists' => 'Permohonan yang dipilih harus memiliki status Aktif.',
            ]
        );

        $internship = Internship::create([
            'id_pembimbing' => $validated['id_pembimbing'],
            'id_permohonan'  => $validated['id_permohonan'],
            'status_magang' => 'Aktif',
        ]);

        $internship->participants()->attach($validated['id_peserta']);

        return redirect()->route('admin.internship.index')
            ->with('success', 'Data magang berhasil ditambahkan.');
    }

    public function edit(Internship $internship)
    {
        $permohonan  = Permohonan::where('status', 'Aktif')->orderBy('instansi')->get();
        $supervisors = Supervisor::orderBy('nama')->get();
        $participants = Participant::orderBy('nama')->get();

        return view('admin.internship.edit', compact(
            'internship',
            'permohonan',
            'supervisors',
            'participants'
        ));
    }


    public function update(Request $request, Internship $internship)
    {
        // Validasi input
        $validated = $request->validate(
            [
                'id_permohonan' => ['required', 'integer', Rule::exists('permohonan', 'id')->where(function ($query) {
                    $query->where('status', 'Aktif');
                })],
                'id_pembimbing' => 'required|integer|exists:supervisors,id',
                'status_magang' => ['required', Rule::in(['Aktif', 'Nonaktif'])],
                'id_peserta'    => 'required|array',
                'id_peserta.*'  => 'integer|exists:participants,id',
            ],
            [
                'id_permohonan.exists' => 'Permohonan yang dipilih harus memiliki status Aktif.',
            ]
        );

        // Update data permohonan
        $internship->update([
            'id_permohonan'        => $validated['id_permohonan'],
            'id_peserta'           => $validated['id_peserta'],
            'id_pembimbing'          => $validated['id_pembimbing'],
            'status'             => $validated['status_magang'],
        ]);

        $internship->participants()->sync($validated['id_peserta']);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.internship.index')
            ->with('success', 'Data magang berhasil diperbarui.');
    }
    //
}
