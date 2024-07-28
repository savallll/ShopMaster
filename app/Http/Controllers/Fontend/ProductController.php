<?php

namespace App\Http\Controllers\Fontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    //
    public function index(Request $request, $id)
    {
        //
        $product = Product::find($id);
        // dd($product->category);
        
        return view('Fontend.product.product_detail', compact('product'));
    }
}
