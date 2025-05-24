<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\berita_foto>
 */
class BeritaFotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_berita_foto' => 'BF-' . strtoupper(Str::random(8)),
            'judul_foto'     => $this->faker->sentence(3),
            'foto'           => $this->faker->image('public/image', 800, 600, null, false),
        ];
    }
}
