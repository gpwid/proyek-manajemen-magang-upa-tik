<?php

// app/Http/Requests/StoreTaskRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'internship_id' => 'required|exists:internship,id',
            'participant_id' => 'required|exists:participants,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'task_date' => 'required|date',
            'status' => 'required|in:Dikerjakan,Revisi,Selesai',
        ];
    }

    public function messages(): array
    {
        return [
            'internship_id.required' => 'Sesi magang wajib dipilih.',
            'participant_id.required' => 'Peserta wajib dipilih.',
            'title.required' => 'Judul tugas wajib diisi.',
            'description.required' => 'Deskripsi tugas wajib diisi.',
            'task_date.required' => 'Tanggal tugas wajib diisi.',
            'status.required' => 'Status tugas wajib dipilih.',
        ];
    }
}
