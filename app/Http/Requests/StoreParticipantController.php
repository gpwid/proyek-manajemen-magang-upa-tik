<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreParticipantController extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'permohonan_id' => 'nullable|exists:permohonan,id',
            'nama' => 'required|string|max:50',
            'nik' => 'required|string|max:16|unique:participants,nik',
            'nisnim' => 'required|string|max:20|unique:participants,nisnim',
            'jenis_kelamin' => 'required|in:L,P',
            'jurusan' => 'required|string|max:50',
            'kontak_peserta' => 'required|string|max:13',
            'tahun_aktif' => 'required|digits:4',
            'keterangan' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'permohonan_id.exists' => 'Permohonan tidak ditemukan.',
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama maksimal 50 karakter.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.string' => 'NIK harus berupa teks.',
            'nik.max' => 'NIK maksimal 16 karakter.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nisnim.required' => 'NIS/NIM wajib diisi.',
            'nisnim.string' => 'NIS/NIM harus berupa teks.',
            'nisnim.max' => 'NIS/NIM maksimal 20 karakter.',
            'nisnim.unique' => 'NIS/NIM sudah terdaftar.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',
            'jurusan.required' => 'Jurusan wajib diisi.',
            'jurusan.string' => 'Jurusan harus berupa teks.',
            'jurusan.max' => 'Jurusan maksimal 50 karakter.',
            'kontak_peserta.required' => 'Kontak peserta wajib diisi.',
            'kontak_peserta.string' => 'Kontak peserta harus berupa teks.',
            'kontak_peserta.max' => 'Kontak peserta maksimal 13 karakter.',
            'tahun_aktif.required' => 'Tahun aktif wajib diisi.',
            'tahun_aktif.digits' => 'Tahun aktif harus berupa 4 digit angka.',
            'keterangan.string' => 'Keterangan harus berupa teks.',
            'keterangan.max' => 'Keterangan maksimal 255 karakter.',
        ];
    }
}
