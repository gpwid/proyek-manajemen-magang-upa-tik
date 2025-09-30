<?php

// app/Http/Requests/UpdateUserRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = request()->route('user')->id; // Dapatkan ID user dari route

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($userId)],
            // Password hanya divalidasi jika diisi
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'role' => ['required', 'in:admin,atasan,pembimbing,pemagang'],
            'nip' => ['nullable', 'string', 'max:30', Rule::unique('users')->ignore($userId), 'required_if:role,admin,atasan,pembimbing'],
            'nisnim' => ['nullable', 'string', 'max:20', Rule::unique('users')->ignore($userId), 'required_if:role,pemagang'],
        ];
    }
}
