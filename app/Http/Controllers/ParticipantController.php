<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use App\Models\Participant;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ParticipantController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total' => Participant::count(),
            'laki_laki' => Participant::where('jenis_kelamin', 'L')->count(),
            'perempuan' => Participant::where('jenis_kelamin', 'P')->count(),
        ];

        $data=Participant::all();
        return view('admin.peserta.index', compact('data', 'stats'));
    }

    public function data()
    {
        return DataTables::of(Participant::query())->toJson();
    }

    public function show(Participant $participant): \Illuminate\View\View
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

        $data = $request->only([
            'nama',
            'nik',
            'nisnim',
            'jenis_kelamin',
            'jurusan',
            'kontak_peserta',
            'keterangan',
        ]);

        Participant::create($data);

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
}
