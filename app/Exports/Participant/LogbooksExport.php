<?php

namespace App\Exports\Participant;

use App\Models\Participant;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LogbooksExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(private Participant $participant) {}

    public function collection(): Collection
    {
        return $this->participant->logbooks()
            ->orderByDesc('date')->orderByDesc('id')
            ->get(['date', 'tasks_completed', 'description']);
    }

    public function headings(): array
    {
        return ['Tanggal', 'Tugas/Dikerjakan', 'Deskripsi'];
    }

    public function map($row): array
    {
        return [
            optional($row->date)->format('d-m-Y'),
            $row->tasks_completed,
            $row->description,
        ];
    }
}
