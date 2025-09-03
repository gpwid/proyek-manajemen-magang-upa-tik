<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermohonanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permohonan')->insert([
            [
                'id_instansi'        => 1,
                'tgl_surat'          => Carbon::parse('2025-01-10')->toDateString(),
                'instansi'           => 'SMK Negeri 1 Pekanbaru',
                'tgl_mulai'          => Carbon::parse('2025-02-01')->toDateString(),
                'tgl_selesai'        => Carbon::parse('2025-04-30')->toDateString(),
                'pembimbing_sekolah' => 'Budi Santoso',
                'kontak_pembimbing'  => '081234567890',
                'tgl_suratmasuk'     => Carbon::parse('2025-01-12')->toDateString(),
                'jenis_magang'       => 'Sekolah',
                'status'             => 'Pending',
                'file_permohonan'    => 'permohonan_smk1.pdf',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'id_instansi'        => 2,
                'tgl_surat'          => Carbon::parse('2025-01-15')->toDateString(),
                'instansi'           => 'Universitas Riau',
                'tgl_mulai'          => Carbon::parse('2025-03-01')->toDateString(),
                'tgl_selesai'        => Carbon::parse('2025-06-01')->toDateString(),
                'pembimbing_sekolah' => 'Dewi Lestari',
                'kontak_pembimbing'  => '089876543210',
                'tgl_suratmasuk'     => Carbon::parse('2025-01-16')->toDateString(),
                'jenis_magang'       => 'MBKM',
                'status'             => 'Aktif',
                'file_permohonan'    => 'permohonan_unri.pdf',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'id_instansi'        => 3,
                'tgl_surat'          => Carbon::parse('2025-02-01')->toDateString(),
                'instansi'           => 'PT Telekomunikasi Indonesia',
                'tgl_mulai'          => Carbon::parse('2025-04-01')->toDateString(),
                'tgl_selesai'        => Carbon::parse('2025-07-30')->toDateString(),
                'pembimbing_sekolah' => 'Rahmat Hidayat',
                'kontak_pembimbing'  => '082134567891',
                'tgl_suratmasuk'     => Carbon::parse('2025-02-05')->toDateString(),
                'jenis_magang'       => 'Mandiri',
                'status'             => 'Selesai',
                'file_permohonan'    => 'permohonan_telkom.pdf',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
        ]);
    }
}
