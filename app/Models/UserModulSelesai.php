<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserModulSelesai extends Model
{
    use HasFactory;
    protected $table = 'user_modul_selesai';
    protected $fillable = [
        'user_id',
        'modul_id',
        'tanggal_selesai',
        'nilai',
        'created_at',
        'updated_at',
    ];

    public function modul()
    {
        return $this->belongsTo(Modul::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
