<?php

// app/Services/PermohonanService.php

namespace App\Services;

use App\Models\Permohonan;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PermohonanService
{
    /**
     * Menangani pembuatan data permohonan baru termasuk upload file.
     */
    public function createPermohonan(array $data, ?UploadedFile $filePermohonan, ?UploadedFile $fileSurat): Permohonan
    {
        // Simpan file ke storage dan dapatkan path-nya
        $permohonanPath = $filePermohonan->store('permohonan', 'public');
        $suratBalasanPath = $fileSurat ? $fileSurat->store('permohonan', 'public') : null;

        // Siapkan data untuk dimasukkan ke database
        $dbData = array_merge($data, [
            'status' => 'Proses',
            'tgl_suratmasuk' => now(),
            'file_permohonan' => $permohonanPath,
            'file_permohonan_nama_asli' => $filePermohonan->getClientOriginalName(),
            'file_permohonan_size' => $filePermohonan->getSize(),
            'file_permohonan_mime' => $filePermohonan->getClientMimeType(),
            'file_suratbalasan' => $suratBalasanPath,
            'file_suratbalasan_nama_asli' => $fileSurat?->getClientOriginalName(),
            'file_suratbalasan_size' => $fileSurat?->getSize(),
            'file_suratbalasan_mime' => $fileSurat?->getClientMimeType(),
        ]);

        return Permohonan::create($dbData);
    }

    /**
     * Menangani pembaruan data permohonan termasuk upload file.
     */
    public function updatePermohonan(Permohonan $application, array $data, ?UploadedFile $filePermohonan, ?UploadedFile $fileSurat): bool
    {
        $permohonanPath = $application->file_permohonan;
        if ($filePermohonan) {
            // Hapus file lama jika ada
            if ($application->file_permohonan) {
                Storage::disk('public')->delete($application->file_permohonan);
            }
            // Simpan file baru
            $permohonanPath = $filePermohonan->store('permohonan', 'public');
        }

        $suratBalasanPath = $application->file_suratbalasan;
        if ($fileSurat) {
            if ($application->file_suratbalasan) {
                Storage::disk('public')->delete($application->file_suratbalasan);
            }
            $suratBalasanPath = $fileSurat->store('permohonan', 'public');
        }

        $dbData = array_merge($data, [
            'file_permohonan' => $permohonanPath,
            'file_suratbalasan' => $suratBalasanPath,
        ]);

        return $application->update($dbData);
    }
}
