<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Materi;

class SubModul extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan di database
    protected $table = 'sub_moduls';

    // Kolom yang boleh diisi
    protected $fillable = [
        'modul_id', // foreign key
        'nama',
    ];

    // Relasi ke tabel Modul
    public function modul()
    {
        return $this->belongsTo(Modul::class);
    }

    // Relasi ke tabel Materi
    public function materis()
    {
        return $this->hasMany(Materi::class);
    }
}
