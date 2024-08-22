<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Snack extends Model
{
    protected $fillable = [
        'name', 
        'type', 
        'price', 
        'description', 
        'quantity'
    ];
}
