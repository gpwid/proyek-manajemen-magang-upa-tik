<?php

namespace Database\Factories;

use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupervisorFactory extends Factory
{
    protected $model = Supervisor::class;

    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'nip'  => $this->faker->unique()->numerify(str_repeat('#', 18)),
            'email'=> $this->faker->unique()->safeEmail(),
            // user_id akan diisi setelah membuat User
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Supervisor $s) {
            // Buat user dengan email yang sama, role 'pembimbing', password awal = NIP
            $user = User::create([
                'name'     => $s->nama,
                'email'    => $s->email,
                'password' => bcrypt($s->nip),
                'role'     => 'pembimbing',
            ]);

            if (method_exists($user, 'assignRole')) {
                $user->assignRole('pembimbing');
            }

            $s->update(['user_id' => $user->id]);
        });
    }
}
