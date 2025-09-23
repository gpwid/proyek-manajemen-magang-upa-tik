<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PermohonanExport;
use App\Http\Controllers\Controller;
use App\Models\Institute;
use App\Models\Permohonan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;

class PermohonanController extends Controller
{
    public function show(Permohonan $permohonan)
    {
        // Menampilkan detail permohonan
        // return view('admin.permohonan.show', compact('permohonan'));

        $permohonan->load(['institute', 'participants']);

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

    public function indexTambah()
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
            ->editColumn('tgl_suratmasuk', fn($p) => $p->tgl_surat?->format('d-m-Y'))
            ->editColumn('tgl_mulai', fn($p) => $p->tgl_mulai?->format('d-m-Y'))
            ->editColumn('tgl_selesai', fn($p) => $p->tgl_selesai?->format('d-m-Y'))
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
                <a href='" . route('admin.permohonan.edit', $p->id) . "'
                   class='btn btn-sm btn-primary text-white'
                   data-bs-toggle='tooltip'
                   data-bs-placement='top'
                   title='Edit'>
                    <i class='fa-solid fa-pen-to-square'></i> Edit
                </a>
                <a href='" . route('admin.permohonan.show', $p->id) . "'
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

    public function edit(Permohonan $permohonan)
    {
        // Form edit permohonan
        $searchinstitutes = Institute::orderBy('nama_instansi')->get();

        return view('admin.permohonan.edit', compact('permohonan', 'searchinstitutes'));
    }

    // public function update(Request $request, Permohonan $permohonan)
    // {
    //     // Validasi input
    //     $validated = $request->validate([
    //         'no_surat' => 'required|string|max:100|unique:permohonan,no_surat',
    //         'tgl_surat' => 'required|date',
    //         'id_institute' => 'required|exists:institutes,id',
    //         'tgl_mulai' => 'required|date',
    //         'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
    //         'pembimbing_sekolah' => 'required|string|max:255',
    //         'kontak_pembimbing' => 'required|string|max:13',
    //         'jenis_magang' => 'required|in:Mandiri,MBKM,Sekolah',
    //         'file_permohonan' => 'nullable|file|mimes:pdf|max:5120', // EDIT: tidak wajib
    //         'file_suratbalasan' => 'nullable|file|mimes:pdf|max:5120', // TAMBAH: surat balasan
    //         'catatan' => 'nullable|string|max:255', // TAMBAH: catatan
    //     ]);

    //     // Cari institute terkait
    //     $institute = Institute::findOrFail($validated['id_institute']);

    //     // Proses upload file jika ada
    //     if ($request->hasFile('file_permohonan')) {
    //         // hapus file lama (jika ada)
    //         if ($permohonan->file_permohonan) {
    //             Storage::disk('public')->delete($permohonan->file_permohonan);
    //         }
    //         $path = $request->file('file_permohonan')->store('permohonan', 'public');
    //     } else {
    //         $path = $permohonan->file_permohonan; // tetap pakai yang lama
    //     }

    //     // Update data permohonan
    //     $permohonan->update([
    //         'id_institute' => $institute->id,
    //         'no_surat' => $validated['no_surat'],
    //         'tgl_surat' => $validated['tgl_surat'],
    //         'tgl_mulai' => $validated['tgl_mulai'],
    //         'tgl_selesai' => $validated['tgl_selesai'],
    //         'pembimbing_sekolah' => $validated['pembimbing_sekolah'],
    //         'kontak_pembimbing' => $validated['kontak_pembimbing'],
    //         'jenis_magang' => $validated['jenis_magang'],
    //         'status' => $permohonan->status,
    //         'file_permohonan' => $path,
    //         'file_suratbalasan' => $path,
    //     ]);

    //     // Redirect dengan pesan sukses
    //     return redirect()->route('admin.permohonan.index')
    //         ->with('success', 'Permohonan berhasil diperbarui.');
    // }

    public function update(Request $request, Permohonan $permohonan)
    {
        $validated = $request->validate([
            'no_surat' => [
                'required',
                'string',
                'max:100',
                Rule::unique('permohonan', 'no_surat')->ignore($permohonan->id),
            ],
            'tgl_surat' => 'required|date',
            'id_institute' => 'required|exists:institutes,id',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'pembimbing_sekolah' => 'required|string|max:255',
            'kontak_pembimbing' => 'required|string|max:13',
            'jenis_magang' => 'required|in:Mandiri,MBKM,Sekolah',
            'file_permohonan' => 'nullable|file|mimes:pdf|max:5120',
            'file_suratbalasan' => 'nullable|file|mimes:pdf|max:5120',
            'catatan' => 'nullable|string|max:255',
        ]);

        $institute = Institute::findOrFail($validated['id_institute']);

        // objek file (boleh null)
        $filePermohonan = $request->file('file_permohonan');
        $fileSurat      = $request->file('file_suratbalasan');

        // path file permohonan
        if ($filePermohonan) {
            if ($permohonan->file_permohonan) {
                Storage::disk('public')->delete($permohonan->file_permohonan);
            }
            $permohonanPath = $filePermohonan->store('permohonan', 'public');
        } else {
            $permohonanPath = $permohonan->file_permohonan;
        }

        // path file surat balasan
        if ($fileSurat) {
            if ($permohonan->file_suratbalasan) {
                Storage::disk('public')->delete($permohonan->file_suratbalasan);
            }
            $suratBalasanPath = $fileSurat->store('permohonan', 'public');
        } else {
            $suratBalasanPath = $permohonan->file_suratbalasan;
        }

        $permohonan->update([
            'id_institute' => $institute->id,
            'no_surat' => $validated['no_surat'],
            'tgl_surat' => $validated['tgl_surat'],
            'tgl_mulai' => $validated['tgl_mulai'],
            'tgl_selesai' => $validated['tgl_selesai'],
            'pembimbing_sekolah' => $validated['pembimbing_sekolah'],
            'kontak_pembimbing' => $validated['kontak_pembimbing'],
            'jenis_magang' => $validated['jenis_magang'],
            'status' => $permohonan->status,

            'file_permohonan' => $permohonanPath,
            'file_suratbalasan' => $suratBalasanPath,

            // jika kamu simpan metadata di update juga, gunakan nullsafe
            // 'file_suratbalasan_nama_asli' => $fileSurat?->getClientOriginalName(),
            // dst...
            'catatan' => $validated['catatan'] ?? $permohonan->catatan,
        ]);

        return redirect()->route('admin.permohonan.index')
            ->with('success', 'Permohonan berhasil diperbarui.');
    }


    // public function store(Request $request)
    // {

    //     $validated = $request->validate(
    //         [
    //             'no_surat' => 'required|string|max:100|unique:permohonan,no_surat',
    //             'tgl_surat' => 'required|date',
    //             'id_institute' => 'required|exists:institutes,id',
    //             'tgl_mulai' => 'required|date',
    //             'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
    //             'pembimbing_sekolah' => 'required|string|max:255',
    //             'kontak_pembimbing' => 'required|string|max:13',
    //             'jenis_magang' => 'required|in:Mandiri,MBKM,Sekolah',
    //             'file_permohonan' => 'required|file|mimes:pdf|max:5120',
    //             'file_suratbalasan' => 'nullable|file|mimes:pdf|max:5120',
    //             'catatan' => 'nullable|string|max:255',
    //         ],
    //         [
    //             // required
    //             'no_surat.required' => 'Nomor surat wajib diisi.',
    //             'no_surat.unique' => 'Nomor surat sudah ada dalam database.',
    //             'tgl_surat.required' => 'Tanggal surat wajib diisi.',
    //             'id_institute.required' => 'Silakan pilih instansi.',
    //             'tgl_mulai.required' => 'Tanggal mulai wajib diisi.',
    //             'tgl_selesai.required' => 'Tanggal selesai wajib diisi.',
    //             'pembimbing_sekolah.required' => 'Nama pembimbing sekolah wajib diisi.',
    //             'kontak_pembimbing.required' => 'Kontak pembimbing wajib diisi.',
    //             'tgl_suratmasuk.required' => 'Tanggal surat masuk wajib diisi.',
    //             'jenis_magang.required' => 'Jenis magang wajib dipilih.',
    //             'file_permohonan.required' => 'File permohonan wajib diunggah.',

    //             // rule lain (opsional)
    //             'tgl_selesai.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
    //             'file_permohonan.mimes' => 'File permohonan harus berformat PDF.',
    //             'file_permohonan.max' => 'Ukuran file maksimal 5 MB.',
    //             'id_instansi.exists' => 'Instansi yang dipilih tidak ditemukan.',
    //             'tgl_surat.date' => 'Format tanggal surat tidak valid.',
    //             'file_suratbalasan.mimes' => 'File surat balasan harus berformat PDF.',
    //             'file_suratbalasan.max' => 'Ukuran file surat balasan maksimal 5 MB.',
    //             'catatan.max' => 'Catatan tidak boleh lebih dari 255 karakter.',
    //         ],
    //     );

    //     $institute = Institute::findOrFail($validated['id_institute']);

    //     $path = $request->file('file_permohonan')->store('permohonan', 'public');
    //     $suratBalasanPath = null;
    //     if ($request->hasFile('file_suratbalasan')) {
    //         $suratBalasanPath = $request->file('file_suratbalasan')->store('permohonan', 'public');
    //     }

    //     Permohonan::create([
    //         'id_institute' => $institute->id,
    //         'no_surat' => $validated['no_surat'],
    //         'tgl_surat' => $validated['tgl_surat'],
    //         'tgl_mulai' => $validated['tgl_mulai'],
    //         'tgl_selesai' => $validated['tgl_selesai'],
    //         'pembimbing_sekolah' => $validated['pembimbing_sekolah'],
    //         'kontak_pembimbing' => $validated['kontak_pembimbing'],
    //         'tgl_suratmasuk' => Carbon::now(),
    //         'jenis_magang' => $validated['jenis_magang'],
    //         'status' => 'Proses',
    //         'file_permohonan' => $path,
    //         'file_permohonan_nama_asli' => $request->file('file_permohonan')->getClientOriginalName(),
    //         'file_permohonan_size' => $request->file('file_permohonan')->getSize(),
    //         'file_permohonan_mime' => $request->file('file_permohonan')->getClientMimeType(),
    //         'file_suratbalasan' => $suratBalasanPath,
    //         'file_suratbalasan_nama_asli' => $request->file('file_suratbalasan')->getClientOriginalName() ?? null,
    //         'file_suratbalasan_size' => $request->file('file_suratbalasan')->getSize() ?? null,
    //         'file_suratbalasan_mime' => $request->file('file_suratbalasan')->getClientMimeType() ?? null,
    //         'catatan' => $validated['catatan'] ?? null,
    //     ]);

    //     return redirect()->route('admin.permohonan.index')
    //         ->with('success', 'Data permohonan berhasil ditambahkan.');
    // }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_surat' => 'required|string|max:100|unique:permohonan,no_surat',
            'tgl_surat' => 'required|date',
            'id_institute' => 'required|exists:institutes,id',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'pembimbing_sekolah' => 'required|string|max:255',
            'kontak_pembimbing' => 'required|string|max:13',
            'jenis_magang' => 'required|in:Mandiri,MBKM,Sekolah',
            'file_permohonan' => 'required|file|mimes:pdf|max:5120',
            'file_suratbalasan' => 'nullable|file|mimes:pdf|max:5120',
            'catatan' => 'nullable|string|max:255',
        ]);

        $institute = Institute::findOrFail($validated['id_institute']);

        // simpan objek file ke variabel
        $filePermohonan = $request->file('file_permohonan');           // required
        $fileSurat      = $request->file('file_suratbalasan');          // nullable

        // simpan ke storage
        $permohonanPath    = $filePermohonan->store('permohonan', 'public');
        $suratBalasanPath  = $fileSurat ? $fileSurat->store('permohonan', 'public') : null;

        Permohonan::create([
            'id_institute' => $institute->id,
            'no_surat' => $validated['no_surat'],
            'tgl_surat' => $validated['tgl_surat'],
            'tgl_mulai' => $validated['tgl_mulai'],
            'tgl_selesai' => $validated['tgl_selesai'],
            'pembimbing_sekolah' => $validated['pembimbing_sekolah'],
            'kontak_pembimbing' => $validated['kontak_pembimbing'],
            'tgl_suratmasuk' => Carbon::now(),
            'jenis_magang' => $validated['jenis_magang'],
            'status' => 'Proses',

            // file permohonan (wajib)
            'file_permohonan' => $permohonanPath,
            'file_permohonan_nama_asli' => $filePermohonan->getClientOriginalName(),
            'file_permohonan_size' => $filePermohonan->getSize(),
            'file_permohonan_mime' => $filePermohonan->getClientMimeType(),

            // file surat balasan (opsional) — gunakan nullsafe `?->`
            'file_suratbalasan' => $suratBalasanPath,
            'file_suratbalasan_nama_asli' => $fileSurat?->getClientOriginalName(),
            'file_suratbalasan_size' => $fileSurat?->getSize(),
            'file_suratbalasan_mime' => $fileSurat?->getClientMimeType(),

            'catatan' => $validated['catatan'] ?? null,
        ]);

        return redirect()->route('admin.permohonan.index')
            ->with('success', 'Data permohonan berhasil ditambahkan.');
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

        return $pdf->download('permohonan_' . now()->format('Ymd_His') . '.pdf');
    }
}
