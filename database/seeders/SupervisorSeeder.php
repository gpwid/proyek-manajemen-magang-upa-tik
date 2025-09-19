<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supervisor;

class SupervisorSeeder extends Seeder
{
    public function run(): void
    {
        Supervisor::factory()->count(15)->create();
    }
}
