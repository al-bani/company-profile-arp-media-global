<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_admin'     => 'ADM-' . strtoupper(Str::random(8)),
            'id_perusahaan' => 'PR-' . strtoupper(Str::random(6)), // disesuaikan jika relasi ke tabel perusahaan
            'nama_admin'   => $this->faker->name(),
            'email'        => $this->faker->unique()->safeEmail(),
            'password'     => bcrypt('password123'), // atau Hash::make('password123')
            'no_telepon'   => $this->faker->phoneNumber(),
            'status'       => $this->faker->randomElement(['aktif', 'tidak aktif']),
        ];
    }
}
