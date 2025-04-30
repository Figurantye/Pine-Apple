<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'name',
        'price',
        'quantity',
        'brand',
        'model',
        'desc'
    ];



    public function product(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function ShoppingCart(){
        return $this->hasMany(ShoppingCart::class, 'product_id');
    }
}
