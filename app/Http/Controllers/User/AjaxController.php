<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    // return pizza api for ajax
    public function pizzaApi(Request $request)
    {
        // logger($request->status);
        if ($request->status == 'asc') {
            $data = Product::orderBy('created_at', 'asc')->get();
        } else {
            $data = Product::orderBy('created_at', 'desc')->get();
        }
        return response()->json($data);
    }

    // return success or not adding to cart
    public function addToCart(Request $request)
    {
        // logger($request);
        $data = $this->getDataFromRequest($request);
        Cart::create($data);
        $response = [
            'status' => 'success',
            'message' => 'Adding to cart is completed.'
        ];
        return response()->json($response, 200);
    }

    // order from cart
    public function order(Request $request)
    {
        $totalPrice = 0;
        foreach ($request->all() as $order) {
            $data = OrderList::create($order);
            $totalPrice += $order['total_price'];
        }
        Cart::where('user_id', Auth::user()->id)->delete();
        $orderSummary = $this->createOrderSummary($data, $totalPrice);
        $data = Order::create($orderSummary);
        return response()->json([
            'status' => 'success',
            'message' => 'Order is success!'
        ], 200);
    }

    // delete cart table specific row
    public function deleteRow(Request $request)
    {
        Cart::where('user_id', $request->userId)
            ->where('product_id', $request->productId)
            ->where('id', $request->cartId)
            ->delete();
    }

    // clear entire cart
    public function clearCart()
    {
        Cart::where('user_id', Auth::user()->id)->delete();
    }

    // increase view count
    public function increaseViewCount(Request $request)
    {
        $product = Product::where('id', $request->productId)->first();
        Product::where('id', $request->productId)->update([
            'view_count' => $product->view_count + 1
        ]);
    }

    // create data for order table
    private function createOrderSummary($data, $totalPrice)
    {
        return [
            'user_id' => $data->user_id,
            'order_code' => $data->order_code,
            'total_price' => $totalPrice + 500,
        ];
    }

    // get data from ajax request
    private function getDataFromRequest($request)
    {
        return [
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'quantity' => $request->orderCount,
        ];
    }
}
