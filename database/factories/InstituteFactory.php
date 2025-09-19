<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InstituteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama_instansi' => $this->faker->unique()->company(),
            'alamat'        => $this->faker->streetAddress().', '.$this->faker->city(),
        ];
    }
}
