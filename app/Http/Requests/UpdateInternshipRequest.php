<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
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

        $internshipId = $this->internship->id;

        return [
            'id_permohonan' => [
                'required',
                'integer',
                Rule::exists('permohonan', 'id')->where(fn ($query) => $query->where('status', 'Aktif')),
            ],
            'id_pembimbing' => 'required|integer|exists:supervisors,id',
            'status_magang' => ['required', Rule::in(['Aktif', 'Nonaktif', 'Tidak Selesai'])],
            'id_peserta' => 'nullable|array',
            'id_peserta.*' => [
                'integer',
                'exists:participants,id',
                // Validasi kustom: pastikan peserta ini tidak ada di magang aktif LAINNYA
                function ($attribute, $value, $fail) use ($internshipId) {
                    $isAssignedLain = DB::table('internship_participant')
                        ->join('internship', 'internship_participant.internship_id', '=', 'internship.id')
                        ->where('internship_participant.participant_id', $value)
                        ->where('internship.status_magang', 'Aktif')
                        ->where('internship.id', '!=', $internshipId) // <-- Pengecualian
                        ->exists();

                    if ($isAssignedLain) {
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
