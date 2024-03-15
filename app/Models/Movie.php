<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movies';

    protected $fillable = [
        'title',
        'slug',
        'release_date',
        'length',
        'description',
        'mpaa_rating',
        'image',
        'genre',
        'genre1',
        'genre2',
        'director',
        'performer',
        'performer1',
        'performer2',
        'language',
    ];

    protected $casts = [
        'release_date' => 'date',
    ];
}
