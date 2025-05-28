<?php

namespace Database\Seeders;

use App\Models\admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'id_admin' => 'ADM001',
            'id_perusahaan' => 'induk_ARP Global Media_2102220087754',
            'nama_admin' => 'Admin Super',
            'role' => 'superAdmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('12345678'),
            'no_telepon' => '6281234567890',
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('admins')->insert([
            'id_admin' => 'ADM002',
            'id_perusahaan' => 'induk_ARP Global Media_2102220087754',
            'nama_admin' => 'Admin',
            'role' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'no_telepon' => '6281234567890',
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
