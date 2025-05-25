<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tema extends Model
{
    use HasFactory;

    protected $fillable = ['modul_id', 'judul_tema'];

    public function modul()
    {
        return $this->belongsTo(Modul::class);
    }

    public function materis()
    {
        return $this->hasMany(Materi::class);
    }
}
