<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('participants')->insert([
            'nama' => 'Gusti',
            'nik' => '1471027777770001',
            'nisnim' => '2407117832',
            'jenis_kelamin' => 'L',
            'jurusan' => 'S1 Teknik Informatika',
            'kontak_peserta' => '081234567890',
            'keterangan' => 'Well behaved',
        ]);

    }
}
