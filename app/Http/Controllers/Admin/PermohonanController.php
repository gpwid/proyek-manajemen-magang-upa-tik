<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PermohonanExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermohonanRequest;
use App\Http\Requests\UpdatePermohonanRequest;
use App\Models\Institute;
use App\Models\Permohonan;
use App\Services\PermohonanService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class PermohonanController extends Controller
{
    public function show(Permohonan $application)
    {

        $application->load(['institute', 'participants', 'internships.participants']);

        return view('admin.permohonan.show', compact('application'));
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

        return view('admin.permohonan.index', compact('searchinstitutes', 'totalAktif', 'totalProses', 'totalSelesai', 'totalTolak', 'totalSemua'));
    }

    public function create()
    {
        $data = \App\Models\Institute::all();

        return view('admin.permohonan.tambah', compact('data'));
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
                <a href='".route('admin.permohonan.edit', $p->id)."'
                   class='btn btn-sm btn-primary text-white'
                   data-bs-toggle='tooltip'
                   data-bs-placement='top'
                   title='Edit'>
                    <i class='fa-solid fa-pen-to-square'></i> Edit
                </a>
                <a href='".route('admin.permohonan.show', $p->id)."'
                   class='btn btn-sm btn-info text-white'
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

    public function edit(Permohonan $application)
    {
        // Form edit permohonan
        $searchinstitutes = Institute::orderBy('nama_instansi')->get();

        return view('admin.permohonan.edit', compact('application', 'searchinstitutes'));
    }

    public function update(UpdatePermohonanRequest $request, Permohonan $application, PermohonanService $service): RedirectResponse
    {
        $validated = $request->validated();

        $filePermohonan = $request->file('file_permohonan'); // KALO ADA ERROR CUEKIN AJA, ITU MASALAH INTELLISENSE BUKAN MASALAH AKU
        $fileSurat = $request->file('file_suratbalasan');

        $service->updatePermohonan($application, $validated, $filePermohonan, $fileSurat);

        return redirect()->route('admin.permohonan.index')
            ->with('success', 'Permohonan berhasil diperbarui.');
    }

    public function store(StorePermohonanRequest $request, PermohonanService $service): RedirectResponse
    {
        $validated = $request->validated();

        // Ambil file dari request secara terpisah
        $filePermohonan = $request->file('file_permohonan');
        $fileSurat = $request->file('file_suratbalasan');

        $service->createPermohonan($validated, $filePermohonan, $fileSurat);

        return redirect()->route('admin.permohonan.index')
            ->with('success', 'Data permohonan berhasil ditambahkan.');
    }

    public function updateStatus(Request $request, Permohonan $application)
    {
        // Validasi input status
        $data = $request->validate([
            'to' => 'required|in:Aktif,Proses,Selesai,Ditolak',
        ]);

        $to = $data['to'];

        // Transisi status sesuai aturan
        $allowed = match ($application->status) {
            'Aktif' => ['Selesai', 'Ditolak'],
            'Proses' => ['Aktif', 'Ditolak'],
            default => [],
        };

        // Cek apakah transisi status diizinkan (cari $to di dalam array $allowed)
        if (! in_array($to, $allowed, true)) {
            return back()->withErrors('Transisi status tidak diizinkan dari '.$application->status.' ke '.$to);
        }

        // Update status permohonan
        $application->update(['status' => $to]);

        // Redirect dengan pesan sukses
        return back()->with('success', 'Status permohonan berhasil diperbarui menjadi '.$to);
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

        $pdf = Pdf::loadView('admin.permohonan.pdf', compact('data', 'subtitle'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('permohonan_'.now()->format('Ymd_His').'.pdf');
    }
}
