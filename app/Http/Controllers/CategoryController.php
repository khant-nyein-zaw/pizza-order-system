<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // direct list page
    public function list()
    {
        $categories = Category::when(request('searchKey'), fn ($query) => $query->where('name', 'LIKE', '%' . request('searchKey') . '%'))
            ->orderBy('id', 'desc')
            ->paginate(3);
        $categories->appends(request()->all());
        return view('admin.category.list', compact('categories'));
    }

    // direct create page
    public function createPage()
    {
        return view('admin.category.create');
    }

    // direct edit page
    public function editPage($id)
    {
        $category = Category::where('id', $id)->first();
        return view('admin.category.edit', compact('category'));
    }

    // create new category
    public function create(Request $request)
    {
        $this->validateRequest($request);
        $data = $this->getDataFromRequest($request);
        Category::create($data);
        return redirect()->route('category#list')->with(['createSuccess' => 'Your category is successfully created...']);
    }

    // update category
    public function update(Request $request)
    {
        $this->validateRequest($request);
        $updatedData = $this->getDataFromRequest($request);
        Category::where('id', $request->categoryId)->update($updatedData);
        return redirect()->route('category#list')->with(['updateSuccess' => 'Your Category is successfully updated...']);
    }

    // delete category
    public function delete($id)
    {
        Category::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Category is successfully deleted.']);
    }

    // validation for category
    private function validateRequest($request)
    {
        Validator::make($request->all(), [
            'categoryName' => 'required|unique:categories,name,' . $request->categoryId,
        ])->validate();
    }

    // get request data for category
    private function getDataFromRequest($request)
    {
        return [
            'name' => $request->categoryName,
        ];
    }
}
