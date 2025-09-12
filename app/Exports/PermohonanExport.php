<?php
namespace App\Exports;

use App\Models\Permohonan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class PermohonanExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(private Request $request) {}

    public function collection(): Collection
    {
        $query = Permohonan::query()
            ->select([
                'id',
                'id_institute',
                'tgl_surat',
                'tgl_mulai',
                'tgl_selesai',
                'pembimbing_sekolah',
                'kontak_pembimbing',
                'tgl_suratmasuk',
                'jenis_magang',
                'status'
            ]);

        if ($this->request->filled('q')) {
            $query->where(function($q) {
                $q->where('pembimbing_sekolah', 'like', "%{$this->request->q}%")
                  ->orWhere('kontak_pembimbing', 'like', "%{$this->request->q}%");
            });
        }

        if ($this->request->filled('status')) {
            $query->where('status', $this->request->status);
        }

        if ($this->request->filled('jenis_magang')) {
            $query->where('jenis_magang', $this->request->jenis_magang);
        }

        return $query->with('institute')->orderBy('tgl_suratmasuk', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal Surat',
            'Tanggal Surat Masuk',
            'Instansi',
            'Jenis Magang',
            'Pembimbing Sekolah',
            'Kontak Pembimbing',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Status'
        ];
    }

    // public function map($permohonan): array
    // {
    //     static $no = 0;
    //     $no++;

    //     return [
    //         $no,
    //         $permohonan->tgl_surat?->format('d/m/Y'),
    //         $permohonan->tgl_suratmasuk?->format('d/m/Y'),
    //         $permohonan->institute?->nama ?? '-',
    //         $permohonan->jenis_magang,
    //         $permohonan->pembimbing_sekolah,
    //         $permohonan->kontak_pembimbing,
    //         $permohonan->tgl_mulai?->format('d/m/Y'),
    //         $permohonan->tgl_selesai?->format('d/m/Y'),
    //         $permohonan->status
    //     ];
    // }

    public function map($permohonan): array
{
    static $no = 0;
    $no++;

    return [
        $no,
        $permohonan->tgl_surat?->format('d/m/Y'),
        $permohonan->tgl_suratmasuk?->format('d/m/Y'),
        $permohonan->institute->nama_instansi ?? '-', // Changed from nama to nama_instansi
        $permohonan->jenis_magang,
        $permohonan->pembimbing_sekolah,
        $permohonan->kontak_pembimbing,
        $permohonan->tgl_mulai?->format('d/m/Y'),
        $permohonan->tgl_selesai?->format('d/m/Y'),
        $permohonan->status
    ];
}
}
