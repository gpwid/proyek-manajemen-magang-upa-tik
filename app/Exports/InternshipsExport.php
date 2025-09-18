<?php

namespace App\Exports;

use App\Models\Internship;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InternshipsExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(private Request $request) {}

    public function collection(): Collection
    {
        $q = Internship::with(['permohonan.institute','supervisor','participants']);

        if ($this->request->filled('status_magang')) {
            $q->where('status_magang',$this->request->status_magang);
        }
        if ($this->request->filled('id_institute')) {
            $q->whereHas('permohonan', fn($x)=>$x->where('id_institute',$this->request->id_institute));
        }

        return $q->latest('created_at')->get();
    }

    public function headings(): array
    {
        return ['No','No. Surat','Instansi','Pembimbing','Peserta','Status','Tgl Mulai','Tgl Selesai'];
    }

    public function map($i): array
    {
        static $no = 0; $no++;
        return [
            $no,
            $i->permohonan?->no_surat ?? '-',
            $i->permohonan?->institute?->nama_instansi ?? '-',
            $i->supervisor?->nama ?? '-',
            $i->participants->pluck('nama')->join(', '),
            $i->status_magang,
            optional($i->permohonan?->tgl_mulai)->format('d/m/Y'),
            optional($i->permohonan?->tgl_selesai)->format('d/m/Y'),
        ];
    }
}

