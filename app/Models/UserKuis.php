<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;  
class UserKuis extends Model
{
     use HasFactory;
    protected $fillable = [
        'user_id','kuis_id','jawaban_user','is_benar','created_at','updated_at'
    ];

    public function kuis()
    {
        return $this->belongsTo(Kuis::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}