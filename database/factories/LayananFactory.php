<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\layanan>
 */
class LayananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
          return [
            'id_layanan'    => 'LY-' . strtoupper(Str::random(8)),
            'id_perusahaan' => 'PR-' . strtoupper(Str::random(6)), // bisa disesuaikan jika ingin ambil dari tabel perusahaan
            'nama_layanan'  => $this->faker->words(3, true),
            'deskripsi'     => $this->faker->paragraph(3),
        ];
    }
}
