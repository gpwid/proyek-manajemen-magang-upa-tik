<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'internship_id' => ['required', 'integer', 'exists:internship,id'],
            'participant_id' => ['required', 'integer', 'exists:participants,id'],
            'title' => ['required', 'string', 'max:200'],
            'description' => ['required', 'string'], // TIDAK nullable di migrasi
            'task_date' => ['required', 'date'],   // TIDAK nullable di migrasi
            'status' => ['required', Rule::in(['Selesai', 'Dikerjakan', 'Revisi'])],
            'feedback' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'internship_id.required' => 'Pilih internship terkait.',
            'internship_id.exists' => 'Internship tidak ditemukan.',
            'description.required' => 'Deskripsi wajib diisi.',
            'task_date.required' => 'Tanggal tugas wajib diisi.',
        ];
    }
}
