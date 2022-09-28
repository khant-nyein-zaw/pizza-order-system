<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // For user routes
    // return direct cart list page
    public function cartList()
    {
        $cartList = Cart::select('carts.*', 'products.name as product_name', 'products.price as product_price', 'products.image as product_image')
            ->leftJoin('products', 'carts.product_id', 'products.id')
            ->where('carts.user_id', Auth::user()->id)
            ->get();
        $subTotal = 0;
        foreach ($cartList as $cartItem) {
            $subTotal += $cartItem->product_price * $cartItem->quantity;
        }
        return view('user.cart.list', compact('cartList', 'subTotal'));
    }
}
