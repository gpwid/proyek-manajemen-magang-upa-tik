<?php

// app/Services/ParticipantService.php

namespace App\Services;

use App\Models\Participant;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParticipantService
{
    /**
     * Menyetujui peserta, membuat akun pengguna, dan mengembalikan password sementara.
     *
     * @return string Password acak yang baru dibuat.
     *
     * @throws \Exception
     */
    public function approveParticipant(Participant $participant): string
    {
        if ($participant->status === 'approved' || $participant->user_id) {
            throw new \Exception('Peserta ini sudah memiliki akun atau sudah disetujui.');
        }
        // 1. Hasilkan password acak yang aman
        $temporaryPassword = $participant->nisnim;

        // 2. Bungkus semua operasi database dalam satu transaksi
        DB::transaction(function () use ($participant, $temporaryPassword) {
            // 3. Buat user baru
            $user = User::create([
                'name' => $participant->nama,
                'email' => $participant->email,
                'nomor_unik' => 'magang_'.$participant->nisnim, // Pastikan peserta punya nisnim yang unik
                'password' => Hash::make($temporaryPassword),
                'role' => 'pemagang',
            ]);

            // 4. PERBAIKAN KRITIS: Update kolom `user_id` pada peserta, BUKAN `id` peserta.
            $participant->update([
                'status' => 'approved',
                'user_id' => $user->id, // Pastikan kolom ini ada di tabel participants
            ]);
        });

        // 5. Kembalikan password untuk ditampilkan (atau dikirim via email)
        return $temporaryPassword;
    }
}
