<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Institute;

class InstituteSeeder extends Seeder
{
    public function run(): void
    {
        $institusi = [
            ['nama_instansi' => 'Universitas Riau (UNRI)',              'alamat' => 'Pekanbaru, Riau'],
            ['nama_instansi' => 'UIN Sultan Syarif Kasim Riau (UIN SUSKA)','alamat' => 'Pekanbaru, Riau'],
            ['nama_instansi' => 'Universitas Islam Riau (UIR)',         'alamat' => 'Pekanbaru, Riau'],
            ['nama_instansi' => 'Universitas Lancang Kuning (UNILAK)',  'alamat' => 'Pekanbaru, Riau'],
            ['nama_instansi' => 'Universitas Muhammadiyah Riau (UMRI)', 'alamat' => 'Pekanbaru, Riau'],
            ['nama_instansi' => 'Politeknik Caltex Riau (PCR)',         'alamat' => 'Pekanbaru, Riau'],
            ['nama_instansi' => 'SMAN 1 Pekanbaru',                     'alamat' => 'Pekanbaru, Riau'],
            ['nama_instansi' => 'SMAN 5 Pekanbaru',                     'alamat' => 'Pekanbaru, Riau'],
            ['nama_instansi' => 'SMKN 1 Pekanbaru',                     'alamat' => 'Pekanbaru, Riau'],
            ['nama_instansi' => 'SMK Hasanah Pekanbaru',                'alamat' => 'Pekanbaru, Riau'],
        ];

        foreach ($institusi as $i) {
            Institute::updateOrCreate(
                ['nama_instansi' => $i['nama_instansi']],
                ['alamat' => $i['alamat']]
            );
        }
    }
}
