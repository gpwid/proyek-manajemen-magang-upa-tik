<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SupervisorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'nip'  => $this->faker->numerify(str_repeat('#', 18)),
        ];
    }
}
