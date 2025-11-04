<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class StoreInternshipRequest extends FormRequest
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
            'id_pembimbing' => 'nullable|integer|exists:supervisors,id',
            'id_peserta' => 'nullable|array|',
            'id_peserta.*' => [ // Cek setiap peserta yang dipilih
                'integer',
                'exists:participants,id',
                // Validasi kustom: pastikan peserta ini tidak ada di magang aktif lainnya
                function ($attribute, $value, $fail) {
                    $isAssigned = DB::table('internship_participant')
                        ->join('internship', 'internship_participant.internship_id', '=', 'internship.id')
                        ->where('internship_participant.participant_id', $value)
                        ->where('internship.status_magang', 'Aktif')
                        ->exists();

                    if ($isAssigned) {
                        $fail('Salah satu peserta yang dipilih sudah terdaftar di sesi magang aktif lainnya.');
                    }
                },
            ],
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
