<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class team extends Model
{
    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'team_id',
        'id_portofolio',
        'team',
        'anggota'
    ];

    /**
     * Get the portofolio that owns the team.
     */
    public function portofolio()
    {
        return $this->belongsTo(portofolio::class, 'id_portofolio', 'id_portofolio');
    }
}