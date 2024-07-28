<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;
    protected $table = 'cart_products';
    public $timestamps = false;
    protected $fillable=[
        'id',
        'quantity',
        'cart_id',
        'product_id',
    ];

    public function product(){
        return $this->hasOne(Product::class,'id', 'product_id');
    }
}
