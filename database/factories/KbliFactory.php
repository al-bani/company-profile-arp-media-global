<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\kbli>
 */
class KbliFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_kbli' => $this->faker->unique()->regexify('[0-9]{5}'),
            'judul' => $this->faker->sentence(3),
            'deskripsi' => $this->faker->paragraph(3),
            'kategori' => $this->faker->randomElement(['Pertanian', 'Industri', 'Jasa', 'Perdagangan', 'Konstruksi']),
        ];
    }
}