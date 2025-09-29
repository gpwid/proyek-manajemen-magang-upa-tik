<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSupervisorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Dapatkan ID supervisor dari route parameter
        $supervisorId = request()->route('supervisor')->id;

        return [
            'nama' => 'required|string|max:50',
            'nip' => ['required', 'string', 'max:30', Rule::unique('supervisors')->ignore($supervisorId)],
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
