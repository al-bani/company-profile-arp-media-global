<?php

namespace Database\Seeders;

use App\Models\portofolio;
use App\Models\portofolio_foto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortofolioFotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        portofolio_foto::factory()->count(10)->create();
    }
}
