<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\perusahaan>
 */
class PerusahaanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_perusahaan'   => 'PR-' . strtoupper(str::random(8)),
            'nama_perusahaan' => $this->faker->company(),
            'logo'            => $this->faker->imageUrl(200, 200, 'business', true, 'logo'),
            'nib'             => strtoupper(Str::random(13)),
            'notaris'         => $this->faker->name() . ', S.H., M.Kn.',
            'npwp'            => $this->faker->unique()->numerify('##.###.###.#-###.###'),
            'deskripsi'       => $this->faker->paragraph(),
            'alamat'          => $this->faker->address(),
            'email'           => $this->faker->unique()->companyEmail(),
            'no_telpon'       => $this->faker->phoneNumber(),
            'instagram'       => $this->faker->optional()->userName(),
            'facebook'        => $this->faker->optional()->userName(),
            'tiktok'          => $this->faker->optional()->userName(),
            'twitter'         => $this->faker->optional()->userName(),
            'moto'            => $this->faker->optional()->catchPhrase(),
            'visi'            => $this->faker->optional()->paragraph(),
            'misi'            => $this->faker->optional()->paragraph(),
            'status'          => $this->faker->optional()->randomElement(['Aktif', 'Tidak Aktif', 'Menunggu Verifikasi']),
        ];
    }
}
