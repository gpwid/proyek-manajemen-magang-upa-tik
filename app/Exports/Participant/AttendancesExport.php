<?php

namespace App\Exports\Participant;

use App\Models\Participant;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AttendancesExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(private Participant $participant) {}

    public function collection(): Collection
    {
        return $this->participant->attendances()
            ->orderByDesc('date')->orderByDesc('id')
            ->get([
                'date',
                'status',
                'note',
                'check_in_time',
                'check_out_time',
                'check_in_ip_address',
                'check_out_ip_address',
            ]);
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Status',
            'Check-in',
            'Check-out',
            'IP Masuk',
            'IP Pulang',
            'Keterangan',
        ];
    }

    public function map($row): array
    {
        $wibIn  = $row->check_in_time  ? Carbon::parse($row->check_in_time)->timezone('Asia/Jakarta')->format('H:i:s')  : '-';
        $wibOut = $row->check_out_time ? Carbon::parse($row->check_out_time)->timezone('Asia/Jakarta')->format('H:i:s') : '-';

        return [
            optional($row->date)->format('d-m-Y'),
            (string)($row->status ?? '-'),
            $wibIn,
            $wibOut,
            $row->check_in_ip_address ?: '-',
            $row->check_out_ip_address ?: '-',
            $row->note ?: '-',
        ];
    }
}
