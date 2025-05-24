<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\partner>
 */
class PartnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_partner'   => 'PT-' . strtoupper(Str::random(8)),
            'nama_partner' => $this->faker->company(),
            'email'        => $this->faker->unique()->safeEmail(),
            'foto'         => $this->faker->optional()->image('public/image', 400, 400, null, false),
        ];
    }
}
