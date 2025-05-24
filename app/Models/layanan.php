<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class layanan extends Model
{
    /** @use HasFactory<\Database\Factories\LayananFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    public function perusahaan(){
        return $this->belongsTo(perusahaan::class, 'id_perusahaan', 'id_perusahaan');
    }

    public function layanan_sub(){
        return $this->belongsTo(layanan_sub::class, 'id_layanan', 'id_layanan');
    }
}
