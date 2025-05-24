<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perusahaan extends Model
{
    /** @use HasFactory<\Database\Factories\PerusahaanFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    public function partner(){
        return $this->hasMany(partner::class, 'id_perusahaan', 'id_perusahaan');
    }
    public function berita(){
        return $this->hasMany(berita::class, 'id_perusahaan', 'id_perusahaan');
    }
    public function layanan(){
        return $this->hasMany(layanan::class, 'id_perusahaan', 'id_perusahaan');
    }
    public function banner(){
        return $this->hasMany(banner::class, 'id_perusahaan', 'id_perusahaan');
    }
    public function portofolio(){
        return $this->hasMany(portofolio::class, 'id_perusahaan', 'id_perusahaan');
    }
    public function admin(){
        return $this->belongsTo(admin::class, 'id_perusahaan', 'id_perusahaan');
    }

}
