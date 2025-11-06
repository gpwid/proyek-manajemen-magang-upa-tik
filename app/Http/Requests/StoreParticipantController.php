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
            'nisnim' => 'nullable|string|max:20',
            'jenis_kelamin' => 'required|in:L,P',
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
            'tahun_aktif.required' => 'Tahun aktif wajib diisi.',
            'tahun_aktif.digits' => 'Tahun aktif harus berupa 4 digit angka.',
            'keterangan.string' => 'Keterangan harus berupa teks.',
            'keterangan.max' => 'Keterangan maksimal 255 karakter.',
        ];
    }
}
