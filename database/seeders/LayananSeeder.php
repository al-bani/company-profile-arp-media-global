<?php

namespace Database\Seeders;

use App\Models\layanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        layanan::factory()->count(10)->create();
    }
}
