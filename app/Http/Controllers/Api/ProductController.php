<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseFormatter;
use App\Models\Product;
use Illuminate\Http\Request;
use Exception;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        try {
            $is_new = $request->input('is_new');
            $is_popular = $request->input('is_popular');

            $products = Product::with(['category', 'galleries'])->where('is_publish', 1)->latest();

            if ($is_new) {
                $products->where('is_new', $is_new);
            }

            if ($is_popular) {
                $products->where('is_popular', $is_popular);
            }

            return ResponseFormatter::success(
                $products->get(),
                'Products retrieved successfully',
            );
        } catch (Exception $error) {
            return ResponseFormatter::error(null, $error->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $product = Product::with(['category', 'galleries'])->find($id);

            if ($product) {
                return ResponseFormatter::success(
                    $product,
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
