<?php

namespace Database\Seeders;

use App\Models\perusahaan;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('perusahaans')->insert([
            'id_perusahaan' => 'induk_ARP Global Media_2102220087754',
            'nama_perusahaan' => 'ARP Global Media',
            'logo' => 'image/upload/logo/1748180731_logo-AGM.png',
            'nib' => '2102220087754',
            'notaris' => 'Risdiyani Tandi, S.H.',
            'npwp' => '95.562.129.7-429.000',
            'deskripsi' => 'PT. ARP Global Media merupakan salah satu badan usaha yang bergerak di bidang Periklanan. Aktivitas Remediasi dan Pengelolaan Limbah dan Sampah Lainnya',
            'alamat' => 'Jl. Senam II No. 8 Kota Bandung',
            'email' => 'example@gmail.com',
            'no_telpon' => '62895337126202',
            'instagram' => '-',
            'facebook' => '-',
            'tiktok' => '-',
            'twitter' => '-',
            'moto' => 'Perusahaan kami berkomitmen untuk menjadi mitra terbaik bagi perusahaan anda melalui solusi kreatif dan inovatif',
            'visi' => '-',
            'misi' => '-',
            'status' => 'induk',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
