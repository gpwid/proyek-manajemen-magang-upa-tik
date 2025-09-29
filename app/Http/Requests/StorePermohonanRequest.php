<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @method \Illuminate\Http\UploadedFile|null file(string $key = null)
 */
class StorePermohonanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'no_surat' => 'required|string|max:100|unique:permohonan,no_surat',
            'tgl_surat' => 'required|date',
            'id_institute' => 'required|exists:institutes,id',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'pembimbing_sekolah' => 'required|string|max:255',
            'kontak_pembimbing' => 'required|string|max:13',
            'jenis_magang' => 'required|in:Mandiri,MBKM,Sekolah',
            'file_permohonan' => 'required|file|mimes:pdf|max:5120', // max 5MB
            'file_suratbalasan' => 'nullable|file|mimes:pdf|max:5120', // max 5MB
            'catatan' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'no_surat.required' => 'Nomor surat wajib diisi.',
            'no_surat.unique' => 'Nomor surat ini sudah terdaftar.',
            'tgl_surat.required' => 'Tanggal surat wajib diisi.',
            'id_institute.required' => 'Instansi wajib dipilih.',
            'tgl_mulai.required' => 'Tanggal mulai magang wajib diisi.',
            'tgl_selesai.required' => 'Tanggal selesai magang wajib diisi.',
            'tgl_selesai.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
            'pembimbing_sekolah.required' => 'Nama pembimbing sekolah wajib diisi.',
            'kontak_pembimbing.required' => 'Kontak pembimbing wajib diisi.',
            'jenis_magang.required' => 'Jenis magang wajib dipilih.',
            'file_permohonan.required' => 'File surat permohonan wajib diunggah.',
            'file_permohonan.mimes' => 'File permohonan harus berformat PDF.',
            'file_permohonan.max' => 'Ukuran file permohonan maksimal 5MB.',
            'file_suratbalasan.mimes' => 'File surat balasan harus berformat PDF.',
            'file_suratbalasan.max' => 'Ukuran file surat balasan maksimal 5MB.',
        ];
    }
}
