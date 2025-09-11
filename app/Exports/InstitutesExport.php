<?php
namespace App\Exports;

use App\Models\Institute;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class InstitutesExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(private Request $request) {}

    public function collection()
    {
        $q = Institute::query();

        if ($search = $this->request->get('search')) {
            $q->where(function($x) use ($search) {
                $x->where('nama_instansi','like',"%{$search}%")
                  ->orWhere('alamat','like',"%{$search}%");
            });
        }

        return $q->orderBy('nama_instansi')->get();
    }

    public function headings(): array
    {
        return ['No', 'Nama Instansi', 'Alamat'];
    }

    public function map($p): array
    {
        static $no = 0; $no++;
        return [
            $no,
            $p->nama_instansi,
            $p->alamat,
        ];
    }
}
