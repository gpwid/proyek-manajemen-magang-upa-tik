<?php

namespace App\Http\Controllers\admin;

use App\Exports\InternshipsExport;
use App\Http\Controllers\Controller;
use App\Models\Institute;
use App\Models\Internship;
use App\Models\Participant;
use App\Models\Permohonan;
use App\Models\Supervisor;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class InternshipController extends Controller
{
    //

    public function index(Request $request): View
    {
        $totalAktif = Internship::where('status_magang', 'Aktif')->count();
        $totalNonaktif = Internship::where('status_magang', 'Nonaktif')->count();
        $totalTidakSelesai = Internship::where('status_magang', 'Tidak Selesai')->count();
        $totalSemua = Internship::count();

        $searchinstitutes = Institute::orderBy('nama_instansi')->get();

        $internships = Internship::with([
            'participants:id,nama,nik',
            'permohonan:id,id_institute,no_surat,tgl_mulai,tgl_selesai,jenis_magang',
            'permohonan.institute:id,nama_instansi',
            'supervisor:id,nama,nip',
        ])->latest('created_at')->paginate(10);

        return view('admin.internship.index', compact(
            'totalAktif',
            'totalNonaktif',
            'totalTidakSelesai',
            'totalSemua',
            'internships',
            'searchinstitutes'
        ));
    }

    public function data(Request $request)
    {
        $query = Internship::query()->with([
            'supervisor:id,nama',
            'permohonan:id,id_institute,no_surat,tgl_mulai,tgl_selesai,jenis_magang',
            'permohonan.institute:id,nama_instansi',
            'participants:id,nama',
        ]);

        if ($request->filled('status_magang')) {
            $query->where('status_magang', $request->status_magang);
        }
        if ($request->filled('id_institute')) { // ← filter Instansi
            $query->whereHas(
                'permohonan',
                fn($q) => $q->where('id_institute', $request->id_institute)
            );
        }

        return DataTables::of($query)
            ->addColumn('instansi', fn($i) => $i->permohonan?->institute?->nama_instansi ?? '-')
            ->addColumn('no_surat', fn($i) => $i->permohonan?->no_surat ?? '-')
            ->addColumn('pembimbing', fn($i) => $i->supervisor?->nama ?? '-')
            ->editColumn('tgl_mulai', fn($i) => optional($i->permohonan?->tgl_mulai)->format('d-m-Y'))
            ->editColumn('tgl_selesai', fn($i) => optional($i->permohonan?->tgl_selesai)->format('d-m-Y'))
            ->addColumn('peserta', fn($i) => $i->participants->pluck('nama')->join(', '))
            ->editColumn('status_magang', function ($i) {
                $cls = $i->status_magang === 'Aktif'
                    ? 'bg-success'
                    : ($i->status_magang === 'Tidak Selesai' ? 'bg-danger text-white' : 'bg-secondary');


                return "<span class='badge {$cls}'>{$i->status_magang}</span>";
            })
            ->addColumn('aksi', function ($i) {
                $url1 = route('admin.internship.edit', $i->id);
                $url2 = route('admin.internship.show', $i->id);

                return "<div class='flex gap-2'>
                    <a href='{$url1}' class='btn btn-sm btn-primary text-white'><i class='fa-solid fa-pen-to-square'></i> Edit</a>
                    <a href='{$url2}' class='btn btn-sm btn-success text-white'><i class='fa-solid fa-eye'></i> Detail</a>
                </div>";
            })
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && $request->search['value'] != '') {
                    $keyword = $request->search['value'];
                    $query->where(function ($q) use ($keyword) {
                        $q->where('id', 'like', "%{$keyword}%")
                            ->orWhere('status_magang', 'like', "%{$keyword}%")
                            // Mencari di dalam relasi participants
                            ->orWhereHas('participants', function ($subQuery) use ($keyword) {
                                $subQuery->where('nama', 'like', "%{$keyword}%");
                            })
                            // Mencari di dalam relasi supervisor
                            ->orWhereHas('supervisor', function ($subQuery) use ($keyword) {
                                $subQuery->where('nama', 'like', "%{$keyword}%");
                            });
                    });
                }
            })
            ->filter(function ($query) use ($request) {
                if ($request->has('search') && $request->search['value'] != '') {
                    $keyword = $request->search['value'];
                    $query->where(function ($q) use ($keyword) {
                        $q->where('id', 'like', "%{$keyword}%")
                            ->orWhere('status_magang', 'like', "%{$keyword}%")
                            // Mencari di dalam relasi participants
                            ->orWhereHas('participants', function ($subQuery) use ($keyword) {
                                $subQuery->where('nama', 'like', "%{$keyword}%");
                            })
                            // Mencari di dalam relasi supervisor
                            ->orWhereHas('supervisor', function ($subQuery) use ($keyword) {
                                $subQuery->where('nama', 'like', "%{$keyword}%");
                            });
                    });
                }
            })
            ->rawColumns(['status_magang', 'aksi'])
            ->make(true);
    }

    public function create()
    {
        $permohonan = Permohonan::with('institute')
            ->where('status', 'Aktif')
            ->orderBy('tgl_surat', 'desc')
            ->get();
        $permohonan = Permohonan::with('institute')
            ->where('status', 'Aktif')
            ->orderBy('tgl_surat', 'desc')
            ->get();
        $supervisors = Supervisor::all();
        $participants = Participant::all();

        return view('admin.internship.create', compact('permohonan', 'supervisors', 'participants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_permohonan' => ['required', 'integer', Rule::exists('permohonan', 'id')->where(fn($q) => $q->where('status', 'Aktif'))],
            'id_pembimbing' => 'required|integer|exists:supervisors,id',
            'id_peserta' => 'required|array',
            'id_peserta.*' => 'integer|exists:participants,id',
        ], [
            'id_permohonan.exists' => 'Permohonan yang dipilih harus memiliki status Aktif.',
        ]);

        $internship = Internship::create([
            'id_pembimbing' => $validated['id_pembimbing'],
            'id_permohonan' => $validated['id_permohonan'],
            'id_permohonan' => $validated['id_permohonan'],
            'status_magang' => 'Aktif',
        ]);

        $internship->participants()->attach($validated['id_peserta']);

        // <<< KUNCI: set peserta -> permohonan terkait agar muncul di Detail Permohonan
        Participant::whereIn('id', $validated['id_peserta'])
            ->update(['permohonan_id' => $validated['id_permohonan']]);

        return redirect()->route('admin.internship.index')
            ->with('success', 'Data magang berhasil ditambahkan.');
    }

    public function show(Internship $internship): \Illuminate\View\View
    {
        $internship->load([
            'permohonan:id,id_institute,no_surat,tgl_mulai,tgl_selesai,jenis_magang',
            'permohonan.institute:id,nama_instansi',
            'supervisor:id,nama,nip',
            'participants:id,nama,nik,nisnim,jenis_kelamin,jurusan,kontak_peserta',
        ]);

        return view('admin.internship.detail', compact('internship'));
    }

    public function edit(Internship $internship)
    {
        $permohonan = Permohonan::with('institute')
            ->where('status', 'Aktif')
            ->orderBy('tgl_surat', 'desc')
            ->get();
        $permohonan = Permohonan::with('institute')
            ->where('status', 'Aktif')
            ->orderBy('tgl_surat', 'desc')
            ->get();
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
        $validated = $request->validate([
            'id_permohonan' => ['required', 'integer', Rule::exists('permohonan', 'id')->where(fn($q) => $q->where('status', 'Aktif'))],
            'id_pembimbing' => 'required|integer|exists:supervisors,id',
            'status_magang' => ['required', Rule::in(['Aktif', 'Nonaktif', 'Tidak Selesai'])],
            'id_peserta' => 'required|array',
            'id_peserta.*' => 'integer|exists:participants,id',
        ], [
            'id_permohonan.exists' => 'Permohonan yang dipilih harus memiliki status Aktif.',
        ]);

        $internship->update([
            'id_permohonan' => $validated['id_permohonan'],
            'id_pembimbing' => $validated['id_pembimbing'],
            'status_magang' => $validated['status_magang'],
        ]);

        // Simpan perubahan peserta di pivot
        $changes = $internship->participants()->sync($validated['id_peserta']);

        // Peserta baru ditambahkan ke internship ini -> set permohonan_id
        if (! empty($changes['attached'])) {
            Participant::whereIn('id', $changes['attached'])
                ->update(['permohonan_id' => $validated['id_permohonan']]);
        }

        // Peserta yang dicabut dari internship ini -> kosongkan permohonan_id jika sebelumnya menunjuk permohonan ini
        if (! empty($changes['detached'])) {
            Participant::whereIn('id', $changes['detached'])
                ->where('permohonan_id', $validated['id_permohonan'])
                ->update(['permohonan_id' => null]);
        }

        // Pastikan yang tersisa semua menunjuk permohonan saat ini
        Participant::whereIn('id', $validated['id_peserta'])
            ->update(['permohonan_id' => $validated['id_permohonan']]);

        return redirect()->route('admin.internship.index')
            ->with('success', 'Data magang berhasil diperbarui.');
    }

    // Export
    public function exportExcel(Request $request)
    {
        $filename = 'internships_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new InternshipsExport($request), $filename);
    }

    public function exportPdf(Request $request)
    {
        $q = Internship::with(['permohonan.institute', 'supervisor', 'participants']);

        if ($request->filled('status_magang')) {
            $q->where('status_magang', $request->status_magang);
        }
        if ($request->filled('id_institute')) {
            $q->whereHas('permohonan', fn($x) => $x->where('id_institute', $request->id_institute));
        }

        $data = $q->latest('created_at')->get();
        $subtitle = [];
        if ($request->status_magang) {
            $subtitle[] = 'Status: ' . $request->status_magang;
        }
        if ($request->id_institute) {
            $subtitle[] = 'Instansi: ' . $data->first()?->permohonan?->institute?->nama_instansi;
        }
        $subtitle = implode(' · ', array_filter($subtitle));

        $pdf = Pdf::loadView('admin.internship.pdf', compact('data', 'subtitle'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('internships_' . now()->format('Ymd_His') . '.pdf');
    }
}
