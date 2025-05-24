<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class portofolio_foto extends Model
{
    /** @use HasFactory<\Database\Factories\PortfolioFotoFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    public function portofolio(){
        return $this->belongsTo(portofolio::class, 'id_portofolio', 'id_portofolio');
    }
}
