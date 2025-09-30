<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInstituteRequest extends FormRequest
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
        $instituteId = request()->route('institute')?->id;

        return [
            // Semua aturan validasi dari controller dipindahkan ke sini.
            'nama_instansi' => ['required', 'string', 'max:50', Rule::unique('institutes')->ignore($instituteId)],
            'alamat' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_instansi.required' => 'Nama instansi wajib diisi.',
            'nama_instansi.string' => 'Nama instansi harus berupa teks.',
            'nama_instansi.max' => 'Nama instansi maksimal 50 karakter.',
            'nama_instansi.unique' => 'Nama instansi sudah digunakan.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.max' => 'Alamat maksimal 255 karakter.',
        ];
    }
}
