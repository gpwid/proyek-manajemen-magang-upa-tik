<?php

// app/Http/Requests/StoreUserRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => ['required', 'in:admin,atasan,pembimbing,pemagang'],
            // Wajib diisi jika role bukan pemagang, dan harus unik
            'nip' => ['nullable', 'string', 'max:30', 'unique:users,nip', 'required_if:role,admin,atasan,pembimbing'],
            // Wajib diisi jika role adalah pemagang, dan harus unik
            'nisnim' => ['nullable', 'string', 'max:20', 'unique:users,nisnim', 'required_if:role,pemagang'],
        ];
    }
}
