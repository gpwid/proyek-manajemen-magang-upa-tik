<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permohonan;
use App\Models\Institute;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PermohonanExport;
use Barryvdh\DomPDF\Facade\Pdf;

class PermohonanController extends Controller
{
    public function show(Permohonan $permohonan)
    {
        // Menampilkan detail permohonan
        return view('admin.permohonan.show', compact('permohonan'));
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

    // public function data(Request $request)
    // {
    //     // Endpoint untuk DataTables Yajra
    //     $query = Permohonan::query();

    //     // Filter berdasarkan query parameters
    //     if ($request->filled('q')) {
    //         $q = $request->q;
    //         $query->where(function ($x) use ($q) {
    //             $x->where('institute', 'like', "%$q%")
    //                 ->orWhere('pembimbing_sekolah', 'like', "%$q%");
    //         });
    //     }
    //     if ($request->filled('status')) {
    //         $query->where('status', $request->status);
    //     }
    //     if ($request->filled('jenis_magang')) {
    //         $query->where('jenis_magang', $request->jenis_magang);
    //     }


    //     // Query untuk DataTables
    //     return DataTables::of($query)
    //         ->editColumn('tgl_surat', fn($p) => optional($p->tgl_surat)->format('d-m-Y'))
    //         ->editColumn('tgl_mulai', fn($p) => optional($p->tgl_mulai)->format('d-m-Y'))
    //         ->editColumn('tgl_selesai', fn($p) => optional($p->tgl_selesai)->format('d-m-Y'))
    //         ->editColumn('status', function ($p) {
    //             $cls = $p->status == 'Aktif' ? 'bg-success' : ($p->status == 'Proses' ? 'bg-warning text-dark' : ($p->status == 'Selesai' ? 'bg-primary' : 'bg-danger'));
    //             return "<span class='badge $cls'>$p->status</span>";
    //         })
    //         ->addColumn('aksi', function ($p) {
    //             $url1 = route('admin.permohonan.edit', $p->id);
    //             $url2 = route('admin.permohonan.show', $p->id);
    //             return "<div class='flex gap-2'>
    //                     <a href='$url1' class='btn btn-sm btn-primary text-white' data-bs-toggle='tooltip'
    //     data-bs-placement='top' title='Edit'>
    //                         <i class='fa-solid fa-pen-to-square'></i> Edit
    //                     </a>
    //                     <a href='$url2' class='btn btn-sm btn-success text-white' data-bs-toggle='tooltip'
    //     data-bs-placement='top' title='Detail'>
    //                         <i class='fa-solid fa-eye'></i> Detail
    //                     </a>
    //                     </div>";
    //         })
    //         ->setRowClass(function ($p) {
    //             if ($p->status == 'Aktif') return 'table-success';
    //             if ($p->status == 'Proses') return 'table-warning';
    //             if ($p->status == 'Selesai') return 'table-primary';
    //             return 'table-danger';
    //         })
    //         ->rawColumns(['status', 'aksi'])
    //         ->make(true);
    // }

    public function data(Request $request)
{
    $query = Permohonan::query()->with('institute');

    // Filter berdasarkan query parameters
    if ($request->filled('q')) {
        $q = $request->q;
        $query->whereHas('institute', function($query) use ($q) {
            $query->where('nama_instansi', 'like', "%$q%");
        })
        ->orWhere('pembimbing_sekolah', 'like', "%$q%");
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('jenis_magang')) {
        $query->where('jenis_magang', $request->jenis_magang);
    }

    return DataTables::of($query)
        ->addColumn('instansi', function($p) {
            return $p->institute->nama_instansi ?? '-';
        })
        ->editColumn('tgl_surat', fn($p) => $p->tgl_surat?->format('d-m-Y'))
        ->editColumn('tgl_mulai', fn($p) => $p->tgl_mulai?->format('d-m-Y'))
        ->editColumn('tgl_selesai', fn($p) => $p->tgl_selesai?->format('d-m-Y'))
        ->editColumn('status', function ($p) {
            $cls = match($p->status) {
                'Aktif' => 'bg-success',
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
                   class='btn btn-sm btn-success text-white'
                   data-bs-toggle='tooltip'
                   data-bs-placement='top'
                   title='Detail'>
                    <i class='fa-solid fa-eye'></i> Detail
                </a>
            </div>";
        })
        ->setRowClass(function ($p) {
            return match($p->status) {
                'Aktif' => 'table-success',
                'Proses' => 'table-warning',
                'Selesai' => 'table-primary',
                default => 'table-danger'
            };
        })
        ->rawColumns(['status', 'aksi'])
        ->make(true);
}

    public function edit(Permohonan $permohonan)
    {
        // Form edit permohonan
        $searchinstitutes = Institute::orderBy('nama_instansi')->get();
        return view('admin.permohonan.edit', compact('permohonan', 'searchinstitutes'));
    }


    public function update(Request $request, Permohonan $permohonan)
    {
        // Validasi input
        $validated = $request->validate([
            'tgl_surat'          => 'required|date',
            'id_institute'        => 'required|exists:institute,id',
            'tgl_mulai'          => 'required|date',
            'tgl_selesai'        => 'required|date|after_or_equal:tgl_mulai',
            'pembimbing_sekolah' => 'required|string|max:255',
            'kontak_pembimbing'  => 'required|string|max:13',
            'jenis_magang'       => 'required|in:Mandiri,MBKM,Sekolah',
            'file_permohonan'    => 'nullable|file|mimes:pdf|max:5120', // EDIT: tidak wajib
        ]);

        // Cari institute terkait
        $institute = Institute::findOrFail($validated['id_institute']);

        // Proses upload file jika ada
        if ($request->hasFile('file_permohonan')) {
            // hapus file lama (jika ada)
            if ($permohonan->file_permohonan) {
                Storage::disk('public')->delete($permohonan->file_permohonan);
            }
            $path = $request->file('file_permohonan')->store('permohonan', 'public');
        } else {
            $path = $permohonan->file_permohonan; // tetap pakai yang lama
        }

        // Update data permohonan
        $permohonan->update([
            'id_institute'        => $institute->id,
            'institute'           => $institute->nama_instansi,
            'tgl_surat'          => $validated['tgl_surat'],
            'tgl_mulai'          => $validated['tgl_mulai'],
            'tgl_selesai'        => $validated['tgl_selesai'],
            'pembimbing_sekolah' => $validated['pembimbing_sekolah'],
            'kontak_pembimbing'  => $validated['kontak_pembimbing'],
            'jenis_magang'       => $validated['jenis_magang'],
            'status'             => $permohonan->status,
            'file_permohonan'    => $path,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.permohonan.index')
            ->with('success', 'Permohonan berhasil diperbarui.');
    }

    public function updateStatus(Request $request, Permohonan $permohonan)
    {
        // Validasi input status
        $data = $request->validate([
            'to' => 'required|in:Aktif,Proses,Selesai,Ditolak',
        ]);

        $to = $data['to'];

        // Transisi status sesuai aturan
        $allowed = match ($permohonan->status) {
            'Aktif' => ['Selesai', 'Ditolak'],
            'Proses' => ['Aktif', 'Ditolak'],
            default => [],
        };

        // Cek apakah transisi status diizinkan (cari $to di dalam array $allowed)
        if (! in_array($to, $allowed, true)) {
            return back()->withErrors('Transisi status tidak diizinkan dari ' . $permohonan->status . ' ke ' . $to);
        }

        // Update status permohonan
        $permohonan->update(['status' => $to]);

        // Redirect dengan pesan sukses
        return back()->with('success', 'Status permohonan berhasil diperbarui menjadi ' . $to);
    }

    public function exportExcel(Request $request)
{
    $filename = 'permohonan_' . now()->format('Ymd_His') . '.xlsx';
    return Excel::download(new PermohonanExport($request), $filename);
}

    public function exportPdf(Request $request)
    {
        $q = Permohonan::query()->with('institute');

    if ($request->filled('q')) {
        $q->whereHas('institute', function($query) use ($request) {
            $query->where('nama_instansi', 'like', "%{$request->q}%");
        })
        ->orWhere('pembimbing_sekolah', 'like', "%{$request->q}%");
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
            $subtitle[] = 'Pencarian: "' . $request->q . '"';
        }
        if ($request->status) {
            $subtitle[] = 'Status: ' . $request->status;
        }
        if ($request->jenis_magang) {
            $subtitle[] = 'Jenis Magang: ' . $request->jenis_magang;
        }
        $subtitle = implode(' · ', $subtitle);

        $pdf = Pdf::loadView('admin.permohonan.pdf', compact('data', 'subtitle'))
                ->setPaper('a4', 'landscape');

        return $pdf->download('permohonan_'.now()->format('Ymd_His').'.pdf');
    }
}
