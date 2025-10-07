<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];

        // Tambahkan aturan validasi ini HANYA jika pengguna adalah 'pemagang'
        if ($this->user()->role === 'pemagang') {
            $participantId = $this->user()->participant->id ?? null;
            $rules = array_merge($rules, [
                'nik' => ['required', 'string', 'digits:16', Rule::unique('participants')->ignore($participantId)],
                'jenis_kelamin' => ['required', 'in:L,P'],
                'jurusan' => ['required', 'string', 'max:50'],
                'kontak_peserta' => ['required', 'string', 'max:13'],
                'tahun_aktif' => ['required', 'digits:4'],
                'alamat_asal' => ['nullable', 'string', 'max:255'],
                'nama_wali' => ['nullable', 'string', 'max:50'],
                'kontak_wali' => ['nullable', 'string', 'max:13'],
            ]);
        }

        return $rules;
    }
}
