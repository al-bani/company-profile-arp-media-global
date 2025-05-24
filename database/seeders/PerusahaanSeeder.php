<?php

namespace Database\Seeders;

use App\Models\perusahaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        perusahaan::factory()->count(10)->create();
    }
}
