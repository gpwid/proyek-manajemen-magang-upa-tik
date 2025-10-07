<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Participant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Menampilkan form profil pengguna berdasarkan perannya.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $role = $user->role;

        // Tentukan view mana yang akan ditampilkan berdasarkan role
        $view = match ($role) {
            'admin' => 'admin.profile.edit',
            'atasan' => 'atasan.profile.edit',
            'pembimbing' => 'pembimbing.profile.edit',
            'pemagang' => 'pemagang.profile.edit',
            default => 'profile.edit', // Fallback
        };

        return view($view, [
            'user' => $user,
        ]);
    }

    /**
     * Memperbarui informasi profil pengguna.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Update data di tabel 'users'
        $user->fill($request->validated());
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        $user->profile_completed = true;
        $user->save();

        // --- LOGIKA BARU UNTUK DATA PESERTA ---
        if ($user->role === 'pemagang') {
            Participant::updateOrCreate(
                ['user_id' => $user->id], // Cari berdasarkan user_id
                [
                    // Isi atau perbarui data dari request
                    'nama' => $user->name,
                    'nisnim' => $user->nisnim,
                    'email' => $user->email,
                    'nik' => $request->input('nik'),
                    'jenis_kelamin' => $request->input('jenis_kelamin'),
                    'jurusan' => $request->input('jurusan'),
                    'kontak_peserta' => $request->input('kontak_peserta'),
                    'tahun_aktif' => $request->input('tahun_aktif'),
                    'alamat_asal' => $request->input('alamat_asal'),
                    'nama_wali' => $request->input('nama_wali'),
                    'kontak_wali' => $request->input('kontak_wali'),
                ]
            );
        }
        // --- AKHIR LOGIKA BARU ---

        return Redirect::route($user->role.'.profile.edit')->with('status', 'profile-updated');
    }
}
