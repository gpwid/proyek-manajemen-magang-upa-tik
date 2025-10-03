<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1 akun admin jelas
        User::factory()
            ->admin()
            ->create([
                'name'     => 'Admin',
                'email'    => 'admin@unri.ac.id',
                'password' => bcrypt('admin123'),
            ]);

        // Seeder lain
        $this->call([
            InstituteSeeder::class,
            SupervisorSeeder::class,  // akan membuat user2 dengan role 'pembimbing'
            ParticipantSeeder::class,
        ]);
    }
}
