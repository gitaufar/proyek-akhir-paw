<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = ['tema_id', 'judul_materi', 'isi_materi'];

    public function tema()
    {
        return $this->belongsTo(Tema::class);
    }

    public function kuis()
    {
        return $this->hasMany(Kuis::class);
    }
}
