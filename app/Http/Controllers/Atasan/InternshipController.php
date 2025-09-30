<?php

namespace App\Http\Controllers\Atasan;

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

        return view('atasan.internship.index', compact(
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
                $url1 = route('atasan.internship.edit', $i->id);
                $url2 = route('atasan.internship.show', $i->id);

                return "<div class='flex gap-2'>
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

    public function show(Internship $internship): \Illuminate\View\View
    {
        $internship->load([
            'permohonan:id,id_institute,no_surat,tgl_mulai,tgl_selesai,jenis_magang',
            'permohonan.institute:id,nama_instansi',
            'supervisor:id,nama,nip',
            'participants:id,nama,nik,nisnim,jenis_kelamin,jurusan,kontak_peserta',
        ]);

        return view('atasan.internship.detail', compact('internship'));
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

        $pdf = Pdf::loadView('atasan.internship.pdf', compact('data', 'subtitle'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('internships_' . now()->format('Ymd_His') . '.pdf');
    }
}
