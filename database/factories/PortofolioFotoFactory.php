<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\portfolio_foto>
 */
class PortofolioFotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_portofolio_foto' => 'PFF-' . strtoupper(Str::random(8)),
            'nama_project'       => $this->faker->words(3, true),
            'judul_foto'         => $this->faker->sentence(3),
            'foto'               => $this->faker->image('public/image', 640, 480, null, false),
        ];
    }
}
