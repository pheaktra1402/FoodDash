<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Add 'user_id' (and any other columns you are saving) to the fillable array
    protected $fillable = [
        'user_id',
        'total_price',
        'shipping_address',
        'status',
    ];
}