<?php

namespace Database\Seeders;

use App\Models\berita;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        berita::factory()->count(10)->create();
    }
}
