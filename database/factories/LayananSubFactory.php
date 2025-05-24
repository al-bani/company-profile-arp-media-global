<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\layanan_sub>
 */
class LayananSubFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_layanan_sub' => 'LS-' . strtoupper(Str::random(8)),
            'tanggal'        => $this->faker->date('Y-m-d'),
            'deskripsi'      => $this->faker->optional()->paragraph(2),
            'foto'           => $this->faker->optional()->image('public/image', 800, 600, null, false),
        ];
    }
}
