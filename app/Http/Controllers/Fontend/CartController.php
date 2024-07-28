<?php

namespace App\Http\Controllers\Fontend;

use App\Models\Cart;
use App\Models\CartProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    public function index($id){
        $cart = Cart::where('user_id', auth()->id())->first();

        if (!$cart) {
            return response()->json(['message' => 'Không tìm thấy giỏ hàng cho người dùng này'], 404);
        }

        $cartProducts = CartProduct::where('cart_id', $cart->id)->get();

        // dd($cartProducts);
        return view('Fontend.user.cart.index', compact('cartProducts'));
    }

    public function store(Request $request, $id){
        // Tìm giỏ hàng của người dùng
        $cart = Cart::firstOrCreate(['user_id' => Auth::user()->id]);
        $quantity = $request->quantity;

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $cartProduct = CartProduct::where('cart_id', $cart->id)
                                ->where('product_id', $id)
                                ->first();

        if ($cartProduct) {
            // Nếu sản phẩm đã có trong giỏ hàng, tăng số lượng lên 1
            $cartProduct->quantity += $quantity;
        } else {
            // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới
            $cartProduct = new CartProduct;
            $cartProduct->cart_id = $cart->id;
            $cartProduct->product_id = $id;
            $cartProduct->quantity = $quantity; 
        }

        $cartProduct->save();

        // dd($cartProduct);

        return redirect()->back()->with(['message'=>'Đã thêm sản phẩm vào giỏ hàng thành công']);
    }
}
