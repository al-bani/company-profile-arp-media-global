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
            'logo_website' => 'image/upload/logo/1748180731_logo-AGM.png',
            'logo_utama' => 'image/upload/logo/1748180731_logo-AGM.png',
            'nib' => '2102220087754',
            'maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.580496655258!2d107.6218472750902!3d-6.940634293059432!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e862553b7bf3%3A0x7b959ac165b2bdc7!2sJl.%20Zamrud%20No.19%2C%20Cijagra%2C%20Kec.%20Lengkong%2C%20Kota%20Bandung%2C%20Jawa%20Barat%2040265!5e0!3m2!1sid!2sid!4v1742114960647!5m2!1sid!2sid',
            'notaris' => 'Risdiyani Tandi, S.H.',
            'npwp' => '95.562.129.7-429.000',
            'deskripsi' => 'PT. ARP Global Media merupakan salah satu badan usaha yang bergerak di bidang Periklanan. Aktivitas Remediasi dan Pengelolaan Limbah dan Sampah Lainnya',
            'alamat_perusahaan' => 'Jl. Senam II No. 8 Kota Bandung',
            'alamat_kantor' => 'Jl. Senam II No. 8 Kota Bandung',
            'email' => 'example@gmail.com',
            'no_telpon' => '62895337126202',
            'instagram' => '-',
            'facebook' => '-',
            'tiktok' => '-',
            'twitter' => '-',
            'moto' => 'Perusahaan kami berkomitmen untuk menjadi mitra terbaik bagi perusahaan anda melalui solusi kreatif dan inovatif',
            'visi' => 'Menjadi perusahaan periklanan terdepan di Asia Tenggara.',
            'misi' => 'Menyediakan solusi kreatif dan layanan terbaik melalui inovasi, integritas, dan kolaborasi.',
            'status' => 'induk',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
