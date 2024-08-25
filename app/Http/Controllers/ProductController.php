<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        $search = request('search');

        $products = Product::latest();

        if ($search) {
            $products->where('name', 'like', '%' . $search . '%');
        }

        $categories = Category::all();

        return view('pages.product.index', [
            'title' => 'List Product',
            'products' => $products->paginate(15),
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'desc' => 'required|string',
            'category_id' => [
                'required',
                'string',
                'max:255',
                Rule::exists('categories', 'id'),
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->route('product')->with('error', $validator->errors()->first());
        }

        $validatedData = $validator->validated();

        if ($request->is_popular) {
            $validatedData['is_popular'] = 1;
        } else {
            $validatedData['is_popular'] = 0;
        }

        if ($request->is_new) {
            $validatedData['is_new'] = 1;
        } else {
            $validatedData['is_new'] = 0;
        }

        if ($request->is_publish) {
            $validatedData['is_publish'] = 1;
        } else {
            $validatedData['is_publish'] = 0;
        }

        $validatedData['user_id'] = auth()->user()->id;

        Product::create($validatedData);

        return redirect()->route('product')->with('success', 'New product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('pages.product.update', [
            'title' => 'Update Product',
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'desc' => 'nullable|string',
            'category_id' => [
                'required',
                'string',
                'max:255',
                Rule::exists('categories', 'id'),
            ],
        ]);

        if ($request->is_popular) {
            $validatedData['is_popular'] = 1;
        } else {
            $validatedData['is_popular'] = 0;
        }

        if ($request->is_new) {
            $validatedData['is_new'] = 1;
        } else {
            $validatedData['is_new'] = 0;
        }

        if ($request->is_publish) {
            $validatedData['is_publish'] = 1;
        } else {
            $validatedData['is_publish'] = 0;
        }

        $product->update($validatedData);

        return redirect()->route('product')->with('success', 'Product updated successfully.');
    }

    public function delete(Request $request)
    {
        Product::destroy($request->id);

        return redirect()->route('product')->with('success', 'Product success deleted.');
    }
}
