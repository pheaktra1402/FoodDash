<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'product_code',
        'product_name',
        'category_id',
        'description',
        'cost_price',
        'selling_price',
        'stock_qty',
        'barcode',
        'image',
        'status',
    ];

    // Relationship to Category (if you have a Category model)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}