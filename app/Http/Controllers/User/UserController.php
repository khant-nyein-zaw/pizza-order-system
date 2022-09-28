<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // direct user home page
    public function home()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        $categories = Category::select('id', 'name')->get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $orders = Order::where('user_id', Auth::user()->id)->get();
        // dd($products->toArray(), $categories->toArray(), count($cart));
        return view('user.main.home', compact('products', 'categories', 'cart', 'orders'));
    }

    // direct user home page with categories filtered
    public function filter($categoryId)
    {
        $products = Product::where('category_id', $categoryId)->orderBy('created_at', 'desc')->get();
        $categories = Category::select('id', 'name')->get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $orders = Order::where('user_id', Auth::user()->id)->get();
        return view('user.main.home', compact('products', 'categories', 'cart', 'orders'));
    }

    // direct product details
    public function details($id, $categoryId)
    {
        $product = Product::where('id', $id)->first();
        $productList = Product::where('category_id', $categoryId)->get();
        // dd($productList->toArray());
        return view('user.main.productDetails', compact('product', 'productList'));
    }

    // direct user account info edit page
    public function editPage()
    {
        return view('user.profile.account');
    }

    // direct password change page
    public function passwordchangePage()
    {
        return view('user.profile.changePassword');
    }

    // accout info edit
    public function edit($id, Request $request)
    {
        $this->validateRequest($request);
        $updatedData = $this->getData($request);

        if ($request->hasFile('image')) {
            $oldFileName = User::where('id', $id)->pluck('image')->first();
            if ($oldFileName != null) {
                Storage::delete('public/' . $oldFileName);
            }
            $newFileName = uniqid() . "_" . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $newFileName);
            $updatedData['image'] = $newFileName;
        }

        User::where('id', $id)->update($updatedData);
        return back()->with(['updateSuccess' => 'Your account is updated.']);
    }

    // password update
    public function changePassword(Request $request)
    {
        $this->validatePassword($request);
        $user = User::where('id', Auth::user()->id)->first();
        $hashedCurrentPassword = $user->password;
        if (Hash::check($request->oldPassword, $hashedCurrentPassword)) {
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword)
            ]);
            return back()->with(['updateSuccess' => 'Your password is updated.']);
        }
        return back()->with(['errorMsg' => 'The provided password does not match your current password.']);
    }

    // get data from request
    private function getData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
        ];
    }

    // account info validation
    private function validateRequest($request)
    {
        Validator::make($request->all(), [
            'name' => 'required|min:6',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::user()->id,
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'image' => 'file|mimes:jpg,jpeg,png,webp',
        ])->validate();
    }

    // password validation
    private function validatePassword($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required|string',
            'newPassword' => 'required|string|min:6',
            'passwordConfirmation' => 'required|string|min:6|same:newPassword',
        ])->validate();
    }
}
