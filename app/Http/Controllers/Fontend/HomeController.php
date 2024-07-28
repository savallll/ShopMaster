<?php

namespace App\Http\Controllers\Fontend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        $products = Product::orderByDesc('id')->where('status', 2)->limit('5')->get();
        $categories = Category::all();
        return view('Fontend.home.index',compact('products','categories'));
    }
}
