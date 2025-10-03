<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supervisor;

class SupervisorSeeder extends Seeder
{
    public function run(): void
    {
        // Factory Supervisor akan otomatis buat user role 'pembimbing'
        Supervisor::factory()->count(15)->create();
    }
}
