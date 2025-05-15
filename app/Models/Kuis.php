<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan di database
    protected $table = 'kuis';

    // Kolom yang boleh diisi
    protected $fillable = [
        'materi_id', // foreign key
        'soal',
        'jawaban',
        'opsi',
    ];

    // Relasi ke tabel Materi
    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}
