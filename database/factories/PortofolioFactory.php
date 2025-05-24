<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\portfolio>
 */
class PortofolioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
            'id_portofolio' => 'PF-' . strtoupper(Str::random(8)),
            'id_perusahaan' => 'PR-' . strtoupper(Str::random(8)), // sesuaikan dengan ID dari tabel perusahaan jika relasi
            'nama_project'  => $this->faker->bs(), // atau sentence() jika ingin judul lebih panjang
            'team'          => $this->faker->name(),
            'tempat'        => $this->faker->city(),
            'tanggal'       => $this->faker->date(),
            'waktu'         => $this->faker->time(),
            'deskripsi'     => $this->faker->paragraph(3),
        ];
    }
}
