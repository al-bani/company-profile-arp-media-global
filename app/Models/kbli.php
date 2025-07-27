<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kbli extends Model
{
    /** @use HasFactory<\Database\Factories\KbliFactory> */
    use HasFactory;

    protected $fillable = [
        'kode_kbli',
        'judul',
        'deskripsi',
        'kategori',
        'id_perusahaan'
    ];

    public function perusahaan()
    {
        return $this->belongsTo(perusahaan::class, 'id_perusahaan');
    }
}
