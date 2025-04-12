<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class portfolio_foto extends Model
{
    /** @use HasFactory<\Database\Factories\PortfolioFotoFactory> */
    use HasFactory;
    protected $guarded = ['id'];
}
