<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    use HasFactory;

    /**
     * Tabel ini tidak menggunakan 'updated_at'.
     */
    const UPDATED_AT = null;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'post_id',
    ];

    // --- DEFINISI RELASI ---

    /**
     * Relasi many-to-one: Sebuah Like diberikan oleh satu User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi many-to-one: Sebuah Like diberikan pada satu Post.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}