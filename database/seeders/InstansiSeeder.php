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
            $now = Carbon::now();

            DB::table('instansi')->insert([
                [
                    'nama_instansi' => 'UPA TIK UNRI',
                    'alamat'        => 'Jl. HR. Soebrantas Km. 12,5, Panam, Pekanbaru',
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ],
                [
                    'nama_instansi' => 'Fakultas Teknik UNRI',
                    'alamat'        => 'Kampus Bina Widya, Panam, Pekanbaru',
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ],
                [
                    'nama_instansi' => 'Diskominfo Pekanbaru',
                    'alamat'        => 'Jl. Jend. Sudirman, Pekanbaru',
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ],
                [
                    'nama_instansi' => 'SMK Negeri 1 Pekanbaru',
                    'alamat'        => 'Jl. Dr. Sutomo No. 42, Pekanbaru',
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ],
                [
                    'nama_instansi' => 'PT Riau Digital',
                    'alamat'        => 'Jl. Tuanku Tambusai, Pekanbaru',
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ],
            ]);
        }
}
