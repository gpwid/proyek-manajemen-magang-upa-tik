<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class StoreTugasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            // Tabel kamu: internship (singular). Kalau nanti tabelnya jamak, ubah ke internships.
            'internship_id' => ['required', 'integer', 'exists:internship,id'],
            'title'         => ['required', 'string', 'max:200'],
            'description'   => ['required', 'string'], // TIDAK nullable di migrasi
            'task_date'     => ['required', 'date'],   // TIDAK nullable di migrasi
            'status'        => ['required', Rule::in(['Selesai','Dikerjakan','Revisi'])],
            'feedback'      => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'internship_id.required' => 'Pilih internship terkait.',
            'internship_id.exists'   => 'Internship tidak ditemukan.',
            'description.required'   => 'Deskripsi wajib diisi.',
            'task_date.required'     => 'Tanggal tugas wajib diisi.',
        ];
    }
}
