<?php

// app/Services/InternshipService.php

namespace App\Services;

use App\Models\Internship;
use App\Models\Participant;
use Illuminate\Support\Facades\DB;

class InternshipService
{
    /**
     * Membuat data magang baru beserta pesertanya.
     * Dibungkus dalam transaction untuk menjaga integritas data.
     *
     * @param  array  $validatedData  Data yang sudah tervalidasi dari Form Request.
     */
    public function createInternship(array $validatedData): Internship
    {
        return DB::transaction(function () use ($validatedData) {
            $internship = Internship::create([
                'id_pembimbing' => $validatedData['id_pembimbing'],
                'id_permohonan' => $validatedData['id_permohonan'],
                'status_magang' => 'Aktif',
            ]);

            $internship->participants()->attach($validatedData['id_peserta']);
            $existingParticipants = Participant::where('permohonan_id', $validatedData['id_permohonan'])
                ->whereNotIn('id', $validatedData['id_peserta'])
                ->pluck('id')
                ->toArray();

            if (! empty($existingParticipants)) {
                $internship->participants()->attach($existingParticipants);
            }
            $permohonan = \App\Models\Permohonan::find($validatedData['id_permohonan']);
            $instituteId = $permohonan ? $permohonan->id_institute : null;

            Participant::whereIn('id', $validatedData['id_peserta'])
                ->update(['permohonan_id' => $validatedData['id_permohonan'],
                    'institute_id' => $instituteId,
                ]);

            return $internship;
        });
    }

    /**
     * Memperbarui data magang beserta pesertanya.
     * Dibungkus dalam transaction.
     *
     * @param  Internship  $internship  Model Internship yang akan diupdate.
     * @param  array  $validatedData  Data yang sudah tervalidasi.
     */
    public function updateInternship(Internship $internship, array $validatedData): Internship
    {
        return DB::transaction(function () use ($internship, $validatedData) {
            $internship->update([
                'id_permohonan' => $validatedData['id_permohonan'],
                'id_pembimbing' => $validatedData['id_pembimbing'],
                'status_magang' => $validatedData['status_magang'],
            ]);

            $changes = $internship->participants()->sync($validatedData['id_peserta']);

            // Update permohonan_id untuk peserta baru
            if (! empty($changes['attached'])) {
                Participant::whereIn('id', $changes['attached'])
                    ->update(['permohonan_id' => $validatedData['id_permohonan']]);
            }

            // Kosongkan permohonan_id untuk peserta yang dilepas
            if (! empty($changes['detached'])) {
                Participant::whereIn('id', $changes['detached'])
                    ->where('permohonan_id', $internship->id_permohonan) // Hanya jika menunjuk ke permohonan lama
                    ->update(['permohonan_id' => null]);
            }

            return $internship;
        });
    }
}
