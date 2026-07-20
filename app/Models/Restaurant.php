<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'name', 'imageUrl', 'rating', 'deliveryTime', 'distance', 'deliveryFee', 'categories'
    ];

    protected $casts = [
        'categories' => 'array',
    ];
}
