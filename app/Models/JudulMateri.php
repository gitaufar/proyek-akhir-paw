<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JudulMateri extends Model
{
    use HasFactory;
    protected $table = 'judul_materis';

    // Kolom yang boleh diisi
    protected $fillable = [
        'sub_modul_id',
        'judul',
        'created_at',
        'updated_at',
    ];

    // Relasi ke tabel SubModul
    public function subModul()
    {
        return $this->belongsTo(SubModul::class);
    }

    // Relasi ke tabel Kuis
    public function materis()
    {
        return $this->hasMany(Materi::class);
    }
}
