<?php

namespace App\Http\Controllers\Atasan;

use App\Exports\PermohonanExport;
use App\Http\Controllers\Controller;
use App\Models\Institute;
use App\Models\Permohonan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class PermohonanController extends Controller
{
    public function show(Permohonan $application)
    {

        $application->load(['institute', 'participants']);

        return view('atasan.permohonan.show', compact('application'));
    }

    public function index(Request $request): View
    {
        // Filter institute, jumlah per status
        $searchinstitutes = Institute::orderBy('nama_instansi')->get();

        $totalAktif = Permohonan::where('status', 'Aktif')->count();
        $totalProses = Permohonan::where('status', 'Proses')->count();
        $totalSelesai = Permohonan::where('status', 'Selesai')->count();
        $totalTolak = Permohonan::where('status', 'Ditolak')->count();
        $totalSemua = Permohonan::count();

        return view('atasan.permohonan.index', compact('searchinstitutes', 'totalAktif', 'totalProses', 'totalSelesai', 'totalTolak', 'totalSemua'));
    }

    public function data(Request $request)
    {
        $query = Permohonan::query()->with('institute');

        // Filter berdasarkan query parameters
        if ($request->filled('q')) {
            $q = $request->q;
            $query->whereHas('institute', function ($query) use ($q) {
                $query->where('nama_instansi', 'like', "%$q%");
            })
                ->orWhere('pembimbing_sekolah', 'like', "%$q%");
        }

        if ($request->filled('id_institute')) {
            $query->where('id_institute', $request->id_institute);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('jenis_magang')) {
            $query->where('jenis_magang', $request->jenis_magang);
        }

        return DataTables::of($query)
            ->addColumn('instansi', function ($p) {
                return $p->institute->nama_instansi ?? '-';
            })
            ->editColumn('tgl_suratmasuk', fn ($p) => $p->tgl_surat?->format('d-m-Y'))
            ->editColumn('tgl_mulai', fn ($p) => $p->tgl_mulai?->format('d-m-Y'))
            ->editColumn('tgl_selesai', fn ($p) => $p->tgl_selesai?->format('d-m-Y'))
            ->editColumn('status', function ($p) {
                $cls = match ($p->status) {
                    'Aktif' => 'bg-success text-white',
                    'Proses' => 'bg-warning text-dark',
                    'Selesai' => 'bg-primary',
                    default => 'bg-danger'
                };

                return "<span class='badge $cls'>$p->status</span>";
            })
            ->addColumn('aksi', function ($p) {
                return "<div class='flex gap-2'>
                <a href='".route('atasan.permohonan.show', $p->id)."'
                   class='btn btn-sm btn-success text-white'
                   data-bs-toggle='tooltip'
                   data-bs-placement='top'
                   title='Detail'>
                    <i class='fa-solid fa-eye'></i> Detail
                </a>
            </div>";
            })
            ->setRowClass(function ($p) {
                return match ($p->status) {
                    'Aktif' => 'table-success',
                    'Proses' => 'table-warning',
                    'Selesai' => 'table-primary',
                    default => 'table-danger'
                };
            })
            ->rawColumns(['status', 'aksi'])
            ->make(true);
    }

    public function exportExcel(Request $request)
    {
        $filename = 'permohonan_'.now()->format('Ymd_His').'.xlsx';

        return Excel::download(new PermohonanExport($request), $filename);
        if ($request->filled('id_institute')) {
            $q->where('id_institute', $request->id_institute);
        }
    }

    public function exportPdf(Request $request)
    {
        $q = Permohonan::query()->with('institute');

        if ($request->filled('q')) {
            $q->whereHas('institute', function ($query) use ($request) {
                $query->where('nama_instansi', 'like', "%{$request->q}%");
            })
                ->orWhere('pembimbing_sekolah', 'like', "%{$request->q}%");
        }

        if ($request->filled('id_institute')) {
            $q->where('id_institute', $request->id_institute);
        }

        if ($request->filled('status')) {
            $q->where('status', $request->status);
        }

        if ($request->filled('jenis_magang')) {
            $q->where('jenis_magang', $request->jenis_magang);
        }

        $data = $q->orderBy('tgl_suratmasuk', 'desc')->get();

        // Build subtitle based on active filters
        $subtitle = [];
        if ($request->q) {
            $subtitle[] = 'Pencarian: "'.$request->q.'"';
        }
        if ($request->status) {
            $subtitle[] = 'Status: '.$request->status;
        }
        if ($request->jenis_magang) {
            $subtitle[] = 'Jenis Magang: '.$request->jenis_magang;
        }
        $subtitle = implode(' · ', $subtitle);

        $pdf = Pdf::loadView('atasan.permohonan.pdf', compact('data', 'subtitle'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('permohonan_'.now()->format('Ymd_His').'.pdf');
    }
}
