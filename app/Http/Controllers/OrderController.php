<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // user
    // direct order history page
    public function history()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(5);
        return view('user.cart.order', compact('orders'));
    }

    // admin
    // order list
    public function orderList()
    {
        $orders = Order::select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->orderBy('orders.created_at', 'desc')
            ->get();
        return view('admin.order.list', compact('orders'));
    }

    // direct order details
    public function orderDetails($orderCode)
    {
        $totalPrice = Order::where('order_code', $orderCode)->pluck('total_price')->first();
        $orderDetails = OrderList::select('order_lists.*', 'users.name as user_name', 'users.image as user_image', 'products.name as product_name', 'products.image as product_image')
            ->leftJoin('users', 'order_lists.user_id', 'users.id')
            ->leftJoin('products', 'order_lists.product_id', 'products.id')
            ->where('order_lists.order_code', $orderCode)
            ->get();
        return view('admin.order.details', compact('orderDetails', 'totalPrice'));
    }

    // order filter with status
    public function orderFilter(Request $request)
    {
        $orders = Order::select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->orderBy('orders.created_at', 'desc');
        if ($request->orderStatus != null) {
            $orders = $orders->where('orders.status', $request->orderStatus)->get();
        } else {
            $orders = $orders->get();
        }
        return view('admin.order.list', compact('orders'));
    }

    // order status change with ajax
    public function changeStatus(Request $request)
    {
        if ($request->status != null) {
            Order::where('id', $request->orderId)->update([
                'status' => $request->status,
            ]);
        }
        return response(200);
    }
}
