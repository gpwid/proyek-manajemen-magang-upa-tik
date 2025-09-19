<?php
// database/seeders/InstituteSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Institute;

class InstituteSeeder extends Seeder
{
    public function run(): void
    {
        // contoh pakai factory
        Institute::factory()->count(5)->create();
    }
}

