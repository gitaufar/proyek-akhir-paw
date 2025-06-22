<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'post_id',
        'user_id',
        'content',
    ];

    // --- DEFINISI RELASI ---

    /**
     * Relasi many-to-one: Sebuah Comment dimiliki oleh satu User (Author).
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi many-to-one: Sebuah Comment milik satu Post.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}