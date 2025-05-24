<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class berita extends Model
{
    /** @use HasFactory<\Database\Factories\BeritaFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    public function perusahaan(){
        return $this->belongsTo(perusahaan::class, 'id_perusahaan', 'id_perusahaan');
    }
    public function berita_foto(){
        return $this->hasMany(berita_foto::class, 'id_berita', 'id_berita');
    }
}
