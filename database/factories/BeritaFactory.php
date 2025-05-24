<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\berita>
 */
class BeritaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
            'id_berita' => 'BR-' . strtoupper(Str::random(8)),
            'id_perusahaan' => 'BR-' . strtoupper(Str::random(8)),
            'judul'     => $this->faker->sentence(6),
            'tanggal'   => $this->faker->date('Y-m-d'),
            'konten'    => $this->faker->paragraphs(3, true), // Gabungkan 3 paragraf jadi 1 string
            'penulis'   => $this->faker->name(),
        ];
    }
}
