<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Modul extends Model
{
    use HasFactory;

    protected $fillable = ['level_id', 'nama_modul', 'deskripsi', 'created_by'];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function temas()
    {
        return $this->hasMany(Tema::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_modul_selesai')
            ->withPivot('tanggal_selesai', 'nilai')
            ->withTimestamps();
    }
}