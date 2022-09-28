<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // direct pizza product list page
    public function list()
    {
        $products = Product::select('products.*', 'categories.name as category_name')
            ->when(request('searchKey'), fn ($query) => $query->where('products.name', 'LIKE', '%' . request('searchKey') . '%'))
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->orderBy('products.created_at', 'desc')
            ->paginate(3);
        // dd($products->tosArray());
        $products->appends(request()->all());
        return view('admin.product.list', compact('products'));
    }

    // direct create product page
    public function createPage()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.create', compact('categories'));
    }

    // product creation
    public function create(Request $request)
    {
        $this->validateRequest($request, false);
        $data = $this->getDataFromRequest($request);

        $filename = uniqid() . '_' . $request->file('productImage')->getClientOriginalName();
        $request->file('productImage')->storeAs('public', $filename);
        $data['image'] = $filename;

        Product::create($data);
        return redirect()->route('product#list')->with(['createSuccess' => 'Product is created successfully.']);
    }

    // direct product details
    public function viewMore($id)
    {
        $product = Product::select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('products.id', $id)->first();
        // dd($product->toArray());
        return view('admin.product.viewMore', compact('product'));
    }

    // direct edit product details page
    public function editPage($id)
    {
        $product = Product::where('id', $id)->first();
        $categories = Category::get();
        // dd($categories->toArray());
        return view('admin.product.edit', compact('product', 'categories'));
    }

    // edit product
    public function edit(Request $request)
    {
        $this->validateRequest($request, true);
        $updatedData = $this->getDataFromRequest($request);

        if ($request->hasFile('productImage')) {
            $currentFileName = Product::where('id', $request->id)->pluck('image')->first();
            if ($currentFileName != null) {
                Storage::delete('public/' . $currentFileName);
            }
            $newFileName = uniqid() . '_' . $request->file('productImage')->getClientOriginalName();
            $request->file('productImage')->storeAs('public', $newFileName);
            $updatedData['image'] = $newFileName;
        }

        Product::where('id', $request->id)->update($updatedData);
        return redirect()->route('product#list')->with(['updateSuccess' => 'Your product info is updated.']);
    }

    // delete product
    public function delete($id)
    {
        $product = Product::where('id', $id)->first();
        $currentFileName = $product->image;
        if ($currentFileName != null) {
            Storage::delete('public/' . $currentFileName);
        }
        Product::where('id', $id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess' => 'Your selected product is deleted.']);
    }

    // product validation
    private function validateRequest($request, $editStatus)
    {
        $rules = [
            'productName' => 'required|string|min:4|unique:products,name,' . $request->id,
            'productCategory' => 'required|string',
            'productDescription' => 'required|string|min:10',
            'productWaitingTime' => 'required',
            'productPrice' => 'required',
        ];

        $rules['productImage'] = !$editStatus ? 'required|file|mimes:jpg,jpeg,png,webp' : 'file|mimes:jpg,jpeg,png,webp';

        Validator::make($request->all(), $rules)->validate();
    }

    // get product from request
    private function getDataFromRequest($request)
    {
        return [
            'category_id' => $request->productCategory,
            'name' => $request->productName,
            'description' => $request->productDescription,
            'price' => $request->productPrice,
            'waiting_time' => $request->productWaitingTime,
        ];
    }
}
