<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @method \Illuminate\Http\UploadedFile|null file(string $key = null)
 */
class UpdatePermohonanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Dapatkan ID permohonan dari route
        $applicationId = request()->route('application')->id;

        return [
            'no_surat' => ['required', 'string', 'max:100', Rule::unique('permohonan', 'no_surat')->ignore($applicationId)],
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
        ];
    }

    // Anda juga bisa menambahkan method `messages()` di sini jika perlu
}
