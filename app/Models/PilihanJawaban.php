<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PilihanJawaban extends Model
{
    use HasFactory;

    protected $fillable = [
        'kuis_id',
        'teks_pilihan',
        'is_benar'
    ];

    public function kuis()
    {
        return $this->belongsTo(Kuis::class);
    }
}
