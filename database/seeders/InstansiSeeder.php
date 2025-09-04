<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class InstansiSeeder extends Seeder
{
    public function run(): void
        {
            DB::table('permohonan')->truncate();
            $now = Carbon::now();

            DB::table('instansi')->insert([
                [
                    'nama_instansi' => 'SMK Negeri 5 Pekanbaru',
                    'alamat'        => 'Jl. HR. Soebrantas Km. 12,5, Panam, Pekanbaru',
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ],
                [
                    'nama_instansi' => 'SMK Negeri 1 Pekanbaru',
                    'alamat'        => 'Kampus Bina Widya, Panam, Pekanbaru',
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ],
                [
                    'nama_instansi' => 'SMK Telkom Pekanbaru',
                    'alamat'        => 'Jl. Jend. Sudirman, Pekanbaru',
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ],
                [
                    'nama_instansi' => 'SMK Negeri 4 Pekanbaru',
                    'alamat'        => 'Jl. Dr. Sutomo No. 42, Pekanbaru',
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ],
                [
                    'nama_instansi' => 'SMK Muhammadiyah Pekanbaru',
                    'alamat'        => 'Jl. Tuanku Tambusai, Pekanbaru',
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ],
            ]);
        }
}
