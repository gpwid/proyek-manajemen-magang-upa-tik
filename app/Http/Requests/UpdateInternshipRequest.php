<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInternshipRequest extends FormRequest
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
            'id_permohonan' => [
                'required',
                'integer',
                Rule::exists('permohonan', 'id')->where(fn ($query) => $query->where('status', 'Aktif')),
            ],
            'id_pembimbing' => 'required|integer|exists:supervisors,id',
            'status_magang' => ['required', Rule::in(['Aktif', 'Nonaktif', 'Tidak Selesai'])],
            'id_peserta' => 'nullable|array',
            'id_peserta.*' => 'integer|exists:participants,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id_permohonan.exists' => 'Permohonan yang dipilih harus berstatus Aktif.',
            'id_pembimbing' => 'Harus ada pembimbing magang!',
            'id_peserta.required' => 'Anda harus memilih setidaknya satu peserta.',
        ];
    }
}
