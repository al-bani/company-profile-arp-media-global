<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class portofolio extends Model
{
    /** @use HasFactory<\Database\Factories\PortfolioFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    public function perusahaan(){
        return $this->belongsTo(perusahaan::class, 'id_perusahaan', 'id_perusahaan');
    }
    public function portofolio_foto(){
        return $this->hasMany(portofolio_foto::class, 'id_portofolio', 'id_portofolio');
    }
    public function portofolio_timeline(){
        return $this->hasMany(timelinePortofolio::class, 'id_portofolio', 'id_portofolio');
    }
    public function teams(){
        return $this->hasMany(team::class, 'id_portofolio', 'id_portofolio');
    }
}