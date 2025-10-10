<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use App\Models\Participant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ParticipantRegistrationController extends Controller
{
    /**
     * Menampilkan halaman formulir pendaftaran peserta.
     */
    public function create()
    {
        $institutes = Institute::all();

        return view('auth.register-participant', compact('institutes'));
    }

    /**
     * Menyimpan data peserta baru dari formulir pendaftaran publik.
     */
    public function store(Request $request)
    {
        // Validasi semua data yang dibutuhkan untuk tabel Participant
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nisnim' => ['required', 'string', 'max:20', 'unique:participants,nisnim'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:participants,email'],
            'nik' => ['required', 'string', 'digits:16', 'unique:participants,nik'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'institute_id' => ['nullable', 'exists:institutes,id'],
            'jurusan' => ['required', 'string', 'max:50'],
            'kontak_peserta' => ['required', 'string', 'max:13'],
            'alamat_asal' => ['nullable', 'string', 'max:255'],
            'nama_wali' => ['nullable', 'string', 'max:255'],
            'kontak_wali' => ['nullable', 'string', 'max:13'],
        ]);

        // Buat data Participant baru dengan status 'pending'
        // Tidak ada pembuatan akun User di sini
        Participant::create([
            'nama' => $validated['nama'],
            'nisnim' => $validated['nisnim'],
            'email' => $validated['email'],
            'nik' => $validated['nik'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'institute_id' => $validated['institute_id'] ?? null,
            'alamat_asal' => $validated['alamat_asal'] ?? null,
            'nama_wali' => $validated['nama_wali'] ?? null,
            'kontak_wali' => $validated['kontak_wali'] ?? null,
            'jurusan' => $validated['jurusan'],
            'kontak_peserta' => $validated['kontak_peserta'],
            'tahun_aktif' => Carbon::now()->year,
            'status' => 'pending', // Status awal, menunggu persetujuan admin
        ]);

        // Arahkan ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Data Anda akan segera ditinjau oleh admin.');
    }
}
