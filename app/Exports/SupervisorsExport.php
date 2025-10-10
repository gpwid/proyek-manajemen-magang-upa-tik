<?php

namespace App\Exports;

use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SupervisorsExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(private Request $request) {}

    public function collection()
    {
        $q = Supervisor::query();

        if ($search = $this->request->get('searchbox')) {
            $q->where(function($x) use ($search) {
                $x->where('nama','like',"%{$search}%")
                  ->orWhere('nip','like',"%{$search}%")
                  ->orWhere('email','like',"%{$search}%");
            });
        }

        return $q->orderBy('nama')->get();
    }

    public function headings(): array
    {
        return ['No', 'Nama', 'Email', 'NIP'];
    }

    public function map($p): array
    {
        static $no = 0; $no++;
        return [
            $no,
            $p->nama,
            $p->email,
            $p->nip,
        ];
    }
}
