<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipantFactory extends Factory
{
    public function definition(): array
    {
        $jk  = $this->faker->randomElement(['L','P']);
        $jur = $this->faker->randomElement([
            'RPL','TKJ','Sistem Informasi','Teknik Informatika','Multimedia','Akuntansi'
        ]);

        return [
            'permohonan_id'  => null, // biarkan null agar bisa independen
            'nama'           => $this->faker->name($jk === 'L' ? 'male' : 'female'),
            'nik'            => $this->faker->numerify(str_repeat('#', 16)),
            'nisnim'         => $this->faker->numerify(str_repeat('#', 10)),
            'jenis_kelamin'  => $jk,
            'jurusan'        => $jur,
            // No HP format Indonesia 08xxxxxxxxxx (11–13 digit)
            'kontak_peserta' => '08' . $this->faker->numerify(str_repeat('#', $this->faker->numberBetween(9,11))),
            'keterangan'     => $this->faker->optional()->sentence(6),
        ];
    }
}
