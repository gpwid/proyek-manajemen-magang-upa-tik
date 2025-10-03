<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreSupervisorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check(); // ganti sesuai kebijakan auth kamu
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:50'],
            'nip'  => ['required', 'string', 'max:30', 'unique:supervisors,nip'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'nip.required'  => 'NIP wajib diisi.',
            'nip.unique'    => 'NIP sudah terdaftar.',
        ];
    }
}
