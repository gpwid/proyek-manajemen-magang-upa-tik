<?php

// app/Http/Requests/StoreSupervisorRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupervisorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:50',
            'nip' => 'required|string|max:30|unique:supervisors,nip',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama pembimbing wajib diisi.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP ini sudah terdaftar di sistem.',
        ];
    }
}
