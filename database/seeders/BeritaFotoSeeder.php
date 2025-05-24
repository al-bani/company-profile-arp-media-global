<?php

namespace Database\Seeders;

use App\Models\berita_foto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BeritaFotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        berita_foto::factory()->count(10)->create();
    }
}
