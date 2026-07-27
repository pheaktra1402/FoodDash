<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'shipping_address',
        'latitude',
        'longitude',
        'payment_method',
        'payment_receipt',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}