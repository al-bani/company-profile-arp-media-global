<?php

namespace Database\Seeders;

use App\Models\portofolio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortofolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        portofolio::factory()->count(10)->create();
    }
}
