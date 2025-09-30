<?php

namespace App\Http\Controllers\Atasan;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Participant;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ParticipantsExport;
use Barryvdh\DomPDF\Facade\Pdf;

class ParticipantController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total'      => Participant::count(),
            'laki_laki'  => Participant::where('jenis_kelamin', 'L')->count(),
            'perempuan'  => Participant::where('jenis_kelamin', 'P')->count(),
        ];

        // daftar tahun untuk dropdown (distinct & desc)
        $years = Participant::whereNotNull('tahun_aktif')
            ->select('tahun_aktif')
            ->distinct()
            ->orderByDesc('tahun_aktif')
            ->pluck('tahun_aktif');

        return view('atasan.peserta.index', compact('stats', 'years'));
    }

    public function data(Request $request)
    {
        $query = Participant::query();

        // Filter Jenis Kelamin
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Filter Tahun Aktif
        if ($request->filled('tahun_aktif')) {
            $query->where('tahun_aktif', (int) $request->tahun_aktif);
        }

        // Filter Search Custom
        if ($request->filled('searchbox')) {
            $search = $request->searchbox;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nisnim', 'like', "%{$search}%")
                  ->orWhere('jurusan', 'like', "%{$search}%")
                  ->orWhere('kontak_peserta', 'like', "%{$search}%")
                  ->orWhere('tahun_aktif', 'like', "%{$search}%");
            });
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('actions', function ($p) {
                return view('atasan.peserta.actions', compact('p'))->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function show(Participant $participant): View
    {
        return view('atasan.peserta.detail', compact('participant'));
    }

    public function exportExcel(Request $request)
    {
        // ParticipantsExport kamu sudah menerima $request → biarkan
        // (pastikan di export memperhatikan 'tahun_aktif' juga)
        $filename = 'peserta_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new ParticipantsExport($request), $filename);
    }

    public function exportPdf(Request $request)
    {
        $q = Participant::query();

        $gender = $request->get('jenis_kelamin');
        $year   = $request->get('tahun_aktif');
        $search = $request->get('search');

        if ($gender) {
            $q->where('jenis_kelamin', $gender);
        }
        if ($year) {
            $q->where('tahun_aktif', (int) $year);
        }
        if ($search) {
            $q->where(function ($x) use ($search) {
                $x->where('nama', 'like', "%{$search}%")
                  ->orWhere('nisnim', 'like', "%{$search}%")
                  ->orWhere('jurusan', 'like', "%{$search}%")
                  ->orWhere('kontak_peserta', 'like', "%{$search}%")
                  ->orWhere('tahun_aktif', 'like', "%{$search}%");
            });
        }

        $data = $q->orderBy('nama')->get();

        $subtitle = [];
        if ($gender) $subtitle[] = 'Jenis kelamin: ' . ($gender === 'L' ? 'Laki-laki' : 'Perempuan');
        if ($year)   $subtitle[] = 'Tahun aktif: ' . $year;
        if ($search) $subtitle[] = 'Pencarian: "' . $search . '"';
        $subtitle = implode(' · ', $subtitle);

        $pdf = Pdf::loadView('atasan.peserta.pdf', compact('data', 'subtitle'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('peserta_' . now()->format('Ymd_His') . '.pdf');
    }
}
