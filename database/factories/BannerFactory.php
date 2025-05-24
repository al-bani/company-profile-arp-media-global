<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\banner>
 */
class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_banner' => 'BN-' . strtoupper(Str::random(8)),
            'banner1'   => $this->faker->optional()->image('public/image', 1200, 400, null, false),
            'banner2'   => $this->faker->optional()->image('public/image', 1200, 400, null, false),
            'banner3'   => $this->faker->optional()->image('public/image', 1200, 400, null, false),
            'banner4'   => $this->faker->optional()->image('public/image', 1200, 400, null, false),
            'banner5'   => $this->faker->optional()->image('public/image', 1200, 400, null, false),
        ];
    }
}
