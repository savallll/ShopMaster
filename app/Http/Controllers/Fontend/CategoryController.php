<?php

namespace App\Http\Controllers\Fontend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //
    public function index(Request $request, $id)
    {
        //
        $category = Category::find($id);
        // dd($category);
        $products = Product::where('category_id', $id)->get();
        return view('Fontend.category.index',compact('category','products'));
    }
}
