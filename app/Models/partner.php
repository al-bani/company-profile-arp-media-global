<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class partner extends Model
{
    /** @use HasFactory<\Database\Factories\PartnerFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    public function perusahaan(){
        return $this->belongsTo(perusahaan::class, 'id_perusahaan', 'id_perusahaan');
    }
}
