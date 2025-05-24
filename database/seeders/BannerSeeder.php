<?php

namespace Database\Seeders;

use App\Models\banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        banner::factory()->count(10)->create();
    }
}
