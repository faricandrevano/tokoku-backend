<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class GalleryController extends Controller
{
    public function index()
    {
        $search = request('search');

        $galleries = Gallery::latest()->with('product');

        if ($search) {
            $galleries->with('product')
                ->whereHas('product', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->orderByDesc('created_at');
        }

        $products = Product::all();

        return view('pages.gallery.index', [
            'title' => 'Gallery Product',
            'galleries' => $galleries->paginate(15),
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_id' => [
                'required',
                'string',
                'max:255',
                Rule::exists('products', 'id'),
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->route('product/gallery')->with('error', $validator->errors()->first());
        }

        $validatedData = $validator->validated();
        $request->file('url')->store('public/gallery');

        $validatedData['url'] = config('app.base_image') . $request->file('url')->store('gallery');

        Gallery::create($validatedData);

        return redirect()->route('product/gallery')->with('success', 'New gallery product created successfully.');
    }

    public function edit(Gallery $gallery)
    {
        $products = Product::all();

        return view('pages.gallery.update', [
            'title' => 'Update Gallery Product',
            'gallery' => $gallery,
            'products' => $products,
        ]);
    }

    public function update(Request $request, Gallery $gallery)
    {
        $rules = [
            'product_id' => [
                'required',
                'string',
                'max:255',
                Rule::exists('products', 'id'),
            ],
        ];

        if ($request->file('url')) {
            $rules['url'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('url')) {
            $url = $gallery->url;
            $desiredString = Str::after($url, 'storage/');
            Storage::delete($desiredString);
            $validatedData['url'] = config('app.base_image') . $request->file('url')->store('gallery');
        }

        $gallery->update($validatedData);

        return redirect()->route('product/gallery')->with('success', 'Gallery product updated successfully.');
    }

    public function delete(Request $request)
    {
        $gallery = Gallery::find($request->id);

        $url = $gallery->url;
        $desiredString = Str::after($url, 'storage/');
        Storage::delete($desiredString);

        Gallery::destroy($request->id);

        return redirect()->route('product/gallery')->with('success', 'Gallery success deleted.');
    }
}
