<?php

namespace App\Http\Controllers;

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
            'total' => Participant::count(),
            'laki_laki' => Participant::where('jenis_kelamin', 'L')->count(),
            'perempuan' => Participant::where('jenis_kelamin', 'P')->count(),
        ];

        return view('admin.peserta.index', compact('stats'));
    }

    public function data(Request $request)
    {
        $query = Participant::query();

        // Filter Jenis Kelamin
        if ($request->jenis_kelamin) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Filter Search Custom
        if ($request->searchbox) {
            $search = $request->searchbox;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nisnim', 'like', "%{$search}%")
                  ->orWhere('jurusan', 'like', "%{$search}%")
                  ->orWhere('kontak_peserta', 'like', "%{$search}%");
            });
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('actions', function ($p) {
                return view('admin.peserta.actions', compact('p'))->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function show(Participant $participant): View
    {
        return view('admin.peserta.detail', compact('participant'));
    }

    public function create()
    {
        return view('admin.peserta.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'nik' => 'required|string|max:16',
            'nisnim' => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:L,P',
            'jurusan' => 'required|string|max:50',
            'kontak_peserta' => 'required|string|max:13',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Participant::create($request->only([
            'nama','nik','nisnim','jenis_kelamin','jurusan','kontak_peserta','keterangan'
        ]));

        return redirect()->route('admin.peserta.index')->with('sukses', 'Data Disimpan');
    }

    public function edit(Participant $participant): View
    {
        return view('admin.peserta.edit', compact('participant'));
    }

    public function update(Request $request, Participant $participant): RedirectResponse
    {
        $request->validate([
            'nama' => 'required|string|max:50',
            'nik' => 'required|string|max:16',
            'nisnim' => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:L,P',
            'jurusan' => 'required|string|max:50',
            'kontak_peserta' => 'required|string|max:13',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $participant->update($request->only([
            'nama','nik','nisnim','jenis_kelamin','jurusan','kontak_peserta','keterangan'
        ]));

        return redirect()->route('admin.peserta.index')->with('sukses', 'Data berhasil diperbarui');
    }

    public function exportExcel(Request $request)
    {
        $filename = 'peserta_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new ParticipantsExport($request), $filename);
    }

    public function exportPdf(Request $request)
    {
        $q = Participant::query();

        if ($gender = $request->get('jenis_kelamin')) {
            $q->where('jenis_kelamin', $gender);
        }
        if ($search = $request->get('search')) {
            $q->where(function($x) use ($search) {
                $x->where('nama','like',"%{$search}%")
                  ->orWhere('nisnim','like',"%{$search}%")
                  ->orWhere('jurusan','like',"%{$search}%")
                  ->orWhere('kontak_peserta','like',"%{$search}%");
            });
        }

        $data = $q->orderBy('nama')->get();
        $subtitle = [];
        if ($gender) $subtitle[] = 'Jenis kelamin: ' . ($gender === 'L' ? 'Laki-laki' : 'Perempuan');
        if ($search) $subtitle[] = 'Pencarian: "' . $search . '"';
        $subtitle = implode(' · ', $subtitle);

        $pdf = Pdf::loadView('admin.peserta.pdf', compact('data','subtitle'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('peserta_'.now()->format('Ymd_His').'.pdf');
    }
}
