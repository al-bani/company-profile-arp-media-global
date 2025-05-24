<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class layanan_sub extends Model
{
    /** @use HasFactory<\Database\Factories\LayananSubFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    public function layanan(){
        return $this->belongsTo(layanan::class, 'id_layanan', 'id_layanan');
    }


}
