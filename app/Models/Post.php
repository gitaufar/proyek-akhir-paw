<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    // Tambahkan baris ini! Ini adalah kunci untuk memperbaiki error.
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'content',
    ];

    /**
     * Tentukan atribut yang akan di-cast ke tipe data tertentu.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // --- DEFINISI RELASI ---

    /**
     * Relasi many-to-one: Sebuah Post dimiliki oleh satu User (Author).
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi one-to-many: Sebuah Post memiliki banyak Comment.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Relasi one-to-many: Sebuah Post memiliki banyak Like.
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }
}