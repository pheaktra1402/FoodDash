<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = [
        'restaurantId', 'name', 'description', 'imageUrl', 'price', 'oldPrice', 'rating', 'ingredients', 'extraToppings'
    ];

    protected $casts = [
        'ingredients' => 'array',
        'extraToppings' => 'array',
    ];
}
