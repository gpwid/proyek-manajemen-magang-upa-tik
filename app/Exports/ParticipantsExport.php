<?php
// app/Exports/ParticipantsExport.php
namespace App\Exports;

use App\Models\Participant;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class ParticipantsExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(private Request $request) {}

    public function collection()
    {
        $q = Participant::query();

        if ($gender = $this->request->get('jenis_kelamin')) {
            $q->where('jenis_kelamin', $gender);
        }

        if ($search = $this->request->get('search')) {
            $q->where(function($x) use ($search) {
                $x->where('nama','like',"%{$search}%")
                  ->orWhere('nik','like',"%{$search}%")
                  ->orWhere('nisnim','like',"%{$search}%")
                  ->orWhere('jurusan','like',"%{$search}%")
                  ->orWhere('kontak_peserta','like',"%{$search}%")
                  ->orWhere('keterangan','like',"%{$search}%");
            });
        }

        return $q->orderBy('nama')->get();
    }

    public function headings(): array
    {
        return ['No', 'Nama', 'NIK', 'NISN/NIM', 'Jenis Kelamin', 'Jurusan', 'Kontak', 'Keterangan'];
    }

    public function map($p): array
    {
        static $no = 0; $no++;
        return [
            $no,
            $p->nama,
            $p->nik,
            $p->nisnim,
            $p->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan',
            $p->jurusan,
            $p->kontak_peserta,
            $p->keterangan,
        ];
    }
}
