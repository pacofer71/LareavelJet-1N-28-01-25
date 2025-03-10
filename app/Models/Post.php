<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    protected $fillable=['titulo', 'contenido', 'estado', 'imagen', 'user_id'];

    //Relacion 1:N con Post
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
