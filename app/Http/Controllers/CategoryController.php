<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $search = request('search');

        $categories = Category::latest();

        if ($search) {
            $categories->where('name', 'like', '%' . $search . '%');
        }

        return view('pages.category.index', [
            'title' => 'Category Product',
            'categories' => $categories->paginate(15),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('product/category')->with('error', $validator->errors()->first());
        }

        $validatedData = $validator->validated();

        Category::create($validatedData);

        return redirect()->route('product/category')->with('success', 'New category product created successfully.');
    }

    public function edit(Category $category)
    {
        return view('pages.category.update', [
            'title' => 'Update Category Product',
            'category' => $category,
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
        ]);

        $category->update($validatedData);

        return redirect()->route('product/category')->with('success', 'Category product updated successfully.');
    }

    public function delete(Request $request)
    {
        Category::destroy($request->id);

        return redirect()->route('product/category')->with('success', 'Category success deleted.');
    }
}
