<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderList;
use Carbon\Carbon;

class RouteController extends Controller
{
    // read
    public function products()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return response()->json($products, 200);
    }

    public function categories()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return response()->json($categories, 200);
    }

    public function users()
    {
        $users = User::get();
        return response()->json($users, 200);
    }

    public function orders()
    {
        $orders = Order::get();
        return response()->json($orders);
    }

    public function contacts()
    {
        $contacts = Contact::get();
        return response()->json($contacts, 200);
    }

    public function orderList()
    {
        $orderList = OrderList::get();
        return response()->json($orderList, 200);
    }

    public function categoryDetails($id)
    {
        $category = Category::where('id', $id)->first();
        if (isset($category)) {
            return response()->json($category, 200);
        }
        return response()->json([
            'status' => 'category not found'
        ], 404);
    }

    public function productDetails($id)
    {
        $product = Product::where('id', $id)->first();
        if (isset($product)) {
            return response()->json($product, 200);
        }
        return response()->json([
            'status' => 'product not found'
        ], 404);
    }

    public function userDetails($id)
    {
        $user = User::where('id', $id)->first();
        if (isset($user)) {
            return response()->json($user, 200);
        }
        return response()->json([
            'status' => 'user not found'
        ], 404);
    }

    // create
    public function createCategory(Request $request)
    {
        $data = [
            'name' => $request->category_name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        Category::create($data);
        return response()->json($data);
    }

    // update
    public function updateCategory(Request $request)
    {
        $data = Category::where('id', $request->category_id)->first();
        if (isset($data)) {
            Category::where('id', $request->category_id)->update([
                'name' => $request->category_name,
                'updated_at' => Carbon::now()
            ]);
            return response()->json($data, 200);
        }
        return response()->json([
            'status' => 'There\'s no category to update.'
        ], 404);
    }

    // delete
    public function deleteCategory($id)
    {
        $data = Category::where('id', $id)->first();
        if (isset($data)) {
            Category::where('id', $id)->delete();
            return response()->json($data, 200);
        }
        return response()->json([
            'Status' => 'There\'s no category to delete.'
        ], 404);
    }

    public function deleteProduct($id)
    {
        $data = Product::where('id', $id)->first();
        if (isset($data)) {
            Product::where('id', $id)->delete();
            return response()->json($data, 200);
        }
        return response()->json([
            'Status' => 'There\'s no product to delete.'
        ], 404);
    }
}
