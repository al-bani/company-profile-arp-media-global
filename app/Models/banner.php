<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class banner extends Model
{
    /** @use HasFactory<\Database\Factories\BannerFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    public function perusahaan(){
        return $this->belongsTo(perusahaan::class, 'id_perusahaan', 'id_perusahaan');
    }
}
