<?php

namespace App\Http\Controllers\Fontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    //
    public function getSearch(Request $request){
        $products = Product::whereIn('status', [Product::STATUS_SUCCESS]) ;
        if($request->key ){
            $products->where('name', 'like', '%'.$request->key.'%' );
        }
        $products = $products->orderByDesc('id')->paginate(18);
        
        return view('Fontend.search.index',compact('products'));
    }
}
