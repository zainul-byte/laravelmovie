<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'ratings';

    protected $fillable = [
        'user_id',
        'movie_id',
        'comment',
        'rate'
    ];

    // Define the user relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
