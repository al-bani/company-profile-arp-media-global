<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    /** @use HasFactory<\Database\Factories\FaqFactory> */
    use HasFactory;

    protected $table = 'faqs';

    protected $fillable = [
        'pertanyaan',
        'jawaban',
        'id_perusahaan'
    ];

    public function perusahaan()
    {
        return $this->belongsTo(perusahaan::class, 'id_perusahaan', 'id_perusahaan');
    }
}
