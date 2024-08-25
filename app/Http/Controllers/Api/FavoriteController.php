<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseFormatter;
use App\Models\Favorite;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FavoriteController extends Controller
{
    public function read(Request $request)
    {
        try {
            $user = auth('api')->user();
            if ($user) {
                $limit = $request->input('limit', 10);

                $carts = Favorite::with(['product', 'product.galleries', 'product.category'])->where('user_id', $user->id);

                return ResponseFormatter::success(
                    $carts->paginate($limit),
                    'Get favorite product successfully',
                );
            } else {
                return ResponseFormatter::error(null, 'Unauthorized', 401);
            }
        } catch (Exception $error) {
            return ResponseFormatter::error(null, $error->getMessage(), 500);
        }
    }

    public function action(Request $request)
    {
        try {
            $user = auth('api')->user();
            if ($user) {
                $validator = Validator::make($request->all(), [
                    'product_id' => [
                        'required',
                        'string',
                        'max:255',
                        Rule::exists('products', 'id'),
                    ],
                ]);

                if ($validator->fails()) {
                    return ResponseFormatter::error(null, $validator->errors()->first());
                }

                $customer = User::find($user->id);

                $favorites = $customer->favorites()->where('product_id', $request->product_id)->get();

                if ($favorites->isNotEmpty()) {
                    $item = $favorites->first->get();

                    $item->destroy($item->id);

                    return ResponseFormatter::success(
                        false,
                        'Remove favorite product successfully',
                    );
                } else {
                    Favorite::create(array_merge(
                        $validator->validated(),
                        ['user_id' => $user->id]
                    ));

                    return ResponseFormatter::success(
                        true,
                        'Add favorite product successfully',
                    );
                }
            } else {
                return ResponseFormatter::error(null, 'Unauthorized', 401);
            }
        } catch (Exception $error) {
            return ResponseFormatter::error(null, $error->getMessage(), 500);
        }
    }

    public function check(Request $request)
    {
        try {
            $user = auth('api')->user();
            if ($user) {
                $product_id = $request->input('product_id');

                if ($product_id) {
                    $customer = User::find($user->id);

                    $favorites = $customer->favorites()->where('product_id', $request->product_id)->get();

                    if ($favorites->isNotEmpty()) {
                        return ResponseFormatter::success(
                            true,
                            'Product found in favorite',
                        );
                    } else {
                        return ResponseFormatter::success(
                            false,
                            'Product not found in favorite',
                        );
                    }
                } else {
                    return ResponseFormatter::error(null, 'Please input product_id to check!', 404);
                }
            } else {
                return ResponseFormatter::error(null, 'Unauthorized', 401);
            }
        } catch (Exception $error) {
            return ResponseFormatter::error(null, $error->getMessage(), 500);
        }
    }
}
