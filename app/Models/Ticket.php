<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    // Los atributos que son asignables en masa.
    protected $fillable = [
        'movie_id',
        'quantity',
        'showtime',
        'seats',
        'showdate',
        'snacks',
        'client_id',
        'snack_total',
    ];

    // Definir la relación con la película.
    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
    
}
