<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseFormatter;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::latest();

            return ResponseFormatter::success(
                $categories->get(),
                'Categories retrieved successfully',
            );
        } catch (Exception $error) {
            return ResponseFormatter::error(null, $error->getMessage(), 500);
        }
    }

    public function show($id, Request $request)
    {
        try {
            $limit = $request->input('limit', 10);
            $category = Category::find($id);

            if ($category) {
                $products = Product::with(['category', 'galleries'])->where('category_id', $category->id);

                return ResponseFormatter::success(
                    $products->paginate($limit),
                    'Products retrieved successfully',
                );
            } else {
                return ResponseFormatter::error(null, 'Data not found!', 404);
            }
        } catch (Exception $error) {
            return ResponseFormatter::error(null, $error->getMessage(), 500);
        }
    }
}
