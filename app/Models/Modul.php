<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Modul extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan di database
    protected $table = 'moduls';

    // Kolom yang boleh diisi
    protected $fillable = [
        'nama',
    ];

    // Relasi ke tabel SubModul
    public function subModuls()
    {
        return $this->hasMany(SubModul::class);
    }
}
