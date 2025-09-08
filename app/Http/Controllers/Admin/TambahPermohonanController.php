<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\Instansi;
use App\Models\Permohonan;
use Illuminate\Http\Request;

class TambahPermohonanController extends Controller
{
    public function index()
    {
        $tempatinstansis = \App\Models\Instansi::all();
        return view('admin.permohonan.tambah', compact('tempatinstansis'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate(
            [
                'tgl_surat' => 'required|date',
                'id_instansi' => 'required|exists:instansi,id',
                'tgl_mulai' => 'required|date',
                'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
                'pembimbing_sekolah' => 'required|string|max:255',
                'kontak_pembimbing' => 'required|string|max:13',
                'tgl_suratmasuk' => 'required|date',
                'jenis_magang' => 'required|in:Mandiri,MBKM,Sekolah',
                'file_permohonan' => 'required|file|mimes:pdf|max:5120',
            ],
            [
                // required
                'tgl_surat.required'           => 'Tanggal surat wajib diisi.',
                'id_instansi.required'         => 'Silakan pilih instansi.',
                'tgl_mulai.required'           => 'Tanggal mulai wajib diisi.',
                'tgl_selesai.required'         => 'Tanggal selesai wajib diisi.',
                'pembimbing_sekolah.required'  => 'Nama pembimbing sekolah wajib diisi.',
                'kontak_pembimbing.required'   => 'Kontak pembimbing wajib diisi.',
                'tgl_suratmasuk.required'      => 'Tanggal surat masuk wajib diisi.',
                'jenis_magang.required'        => 'Jenis magang wajib dipilih.',
                'file_permohonan.required'     => 'File permohonan wajib diunggah.',

                // rule lain (opsional)
                'tgl_selesai.after_or_equal'   => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
                'file_permohonan.mimes'        => 'File permohonan harus berformat PDF.',
                'file_permohonan.max'          => 'Ukuran file maksimal 5 MB.',
                'id_instansi.exists'           => 'Instansi yang dipilih tidak ditemukan.',
                'tgl_surat.date'               => 'Format tanggal surat tidak valid.',
            ],
        );

        $instansi = Instansi::findOrFail($validated['id_instansi']);

        $path = $request->file('file_permohonan')->store('permohonan', 'public');

        Permohonan::create([
            'id_instansi' => $instansi->id,
            'instansi' => $instansi->nama_instansi,
            'tgl_surat' => $validated['tgl_surat'],
            'tgl_mulai' => $validated['tgl_mulai'],
            'tgl_selesai' => $validated['tgl_selesai'],
            'pembimbing_sekolah' => $validated['pembimbing_sekolah'],
            'kontak_pembimbing' => $validated['kontak_pembimbing'],
            'tgl_suratmasuk' => $validated['tgl_suratmasuk'],
            'jenis_magang' => $validated['jenis_magang'],
            'status' => 'Proses',
            'file_permohonan' => $path,
            'file_permohonan_nama_asli' => $request->file('file_permohonan')->getClientOriginalName(),
            'file_permohonan_size' => $request->file('file_permohonan')->getSize(),
            'file_permohonan_mime' => $request->file('file_permohonan')->getClientMimeType(),
        ]);

        return redirect()->route('admin.permohonan.index')
            ->with('success', 'Data permohonan berhasil ditambahkan.');
    }
}
