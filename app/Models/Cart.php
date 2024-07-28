<?php

namespace App\Models;

use App\Models\CartProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    public $timestamps = false;
    protected $fillable=[
        'id',
        'user_id',
    ];

    public function cartProduct(){
        return $this->hasMany(CartProduct::class, 'cart_id');
    }
}
