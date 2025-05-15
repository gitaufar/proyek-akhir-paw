<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan di database
    protected $table = 'materis';

    // Kolom yang boleh diisi
    protected $fillable = [
        'judul_materi_id',
        'judul',
        'isi_materi',
        'created_at',
        'updated_at'
    ];

    // Relasi ke tabel SubModul
    public function subModul()
    {
        return $this->belongsTo(SubModul::class);
    }

    // Relasi ke tabel Kuis
    public function kuis()
    {
        return $this->hasMany(Kuis::class);
    }
}
