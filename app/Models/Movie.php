<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title', 
        'director', 
        'release_date', 
        'genre', 
        'duration', 
        'description',
        'showtimes',
        'image',
    ];

    function tickets()
    {
        return $this->hasMany(Ticket::class, 'movie_id');
    }

}
