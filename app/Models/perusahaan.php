<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perusahaan extends Model
{
    /** @use HasFactory<\Database\Factories\PerusahaanFactory> */
    use HasFactory;
    protected $guarded = ['id'];

}
