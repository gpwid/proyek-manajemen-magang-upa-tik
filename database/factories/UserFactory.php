<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'              => fake()->name(),
            'email'             => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => bcrypt('password'),
            'remember_token'    => Str::random(10),
            // Jangan default 'admin' — biarkan netral
            'role'              => null,
        ];
    }

    // State helper: admin
    public function admin(): self
    {
        return $this->state(fn () => ['role' => 'admin']);
    }

    // State helper: pembimbing
    public function pembimbing(): self
    {
        return $this->state(fn () => ['role' => 'pembimbing']);
    }
}
