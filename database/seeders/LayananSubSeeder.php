<?php

namespace Database\Seeders;

use App\Models\layanan_sub;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LayananSubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        layanan_sub::factory()->count(10)->create();
    }
}
