<?php

namespace Database\Factories;

use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SupervisorFactory extends Factory
{
    protected $model = Supervisor::class;

    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'nip'  => $this->faker->numerify(str_repeat('#', 18)),
            // 'email' dan 'user_id' akan diisi di afterCreating()
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Supervisor $s) {
            // Bentuk email dari nama -> nama@unri.ac.id
            $local = Str::of($s->nama)->lower()->replaceMatches('/[^a-z0-9]+/i', '')->limit(64, '');
            $local = $local->isEmpty() ? 'user' : (string) $local;
            $base  = $local . '@unri.ac.id';

            // Pastikan unik di users
            [$loc, $dom] = explode('@', $base, 2);
            $email = $base; $n = 1;
            while (User::where('email', $email)->exists()) {
                $n++;
                $email = $loc . $n . '@' . $dom;
            }

            // Buat user dengan role 'pembimbing' dan password awal = NIP
            $user = User::create([
                'name'     => $s->nama,
                'email'    => $email,
                'password' => bcrypt($s->nip),
                'role'     => 'pembimbing',
            ]);

            // (Jika pakai Spatie Permission, tetap aman)
            if (method_exists($user, 'assignRole')) {
                $user->assignRole('pembimbing');
            }

            // Update supervisor: link ke user + simpan email
            $s->update([
                'email'   => $email,
                'user_id' => $user->id,
            ]);
        });
    }
}
