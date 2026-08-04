<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class Order extends Model
{
use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'total_price',
        'shipping_address',
        'payment_method',
        'status',
        'payment_proof', // 👈 Make sure this is added
        'telegram_notified',
    ];
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}