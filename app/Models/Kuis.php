<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kuis extends Model
{
    use HasFactory;

    protected $fillable = [
        'materi_id',
        'pertanyaan',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'jawaban_benar'
    ];

    public function modul()
    {
        return $this->belongsTo(Modul::class);
    }

    public function pilihanJawabans()
    {
        return $this->hasMany(PilihanJawaban::class);
    }

}
