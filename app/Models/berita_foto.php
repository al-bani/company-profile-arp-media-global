<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class berita_foto extends Model
{
    /** @use HasFactory<\Database\Factories\BeritaFotoFactory> */
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['foto'];
    public function berita_foto(){
        return $this->belongsTo(berita::class, 'id_berita', 'id_berita');
    }
}
