<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class struktur extends Model
{
    /** @use HasFactory<\Database\Factories\StrukturFactory> */
    use HasFactory;

    protected $fillable = [
        'nama',
        'jabatan',
        'foto',
        'id_perusahaan',
        'atasan'
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan', 'id_perusahaan');
    }
}