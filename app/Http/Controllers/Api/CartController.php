<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseFormatter;
use App\Models\Cart;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CartController extends Controller
{
    public function read()
    {
        try {
            $user = auth('api')->user();
            if ($user) {
                $carts = Cart::with(['product', 'product.galleries', 'product.category'])->where('user_id', $user->id)->get();

                return ResponseFormatter::success(
                    $carts,
                    'Cart get all successfully',
                );
            } else {
                return ResponseFormatter::error(null, 'Unauthorized', 401);
            }
        } catch (Exception $error) {
            return ResponseFormatter::error(null, $error->getMessage(), 500);
        }
    }

    public function create(Request $request)
    {
        try {
            $user = auth('api')->user();
            if ($user) {
                $validator = Validator::make($request->all(), [
                    'qty' => 'required|numeric',
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

                $carts = $customer->carts()->where('product_id', $request->product_id)->get();

                if ($carts->isNotEmpty()) {
                    $item = $carts->first->get();

                    $item->update(['qty' => $item->qty + $request->qty]);

                    $cart = Cart::with(['product', 'product.galleries', 'product.category'])->find($item->id);
                } else {
                    $item = Cart::create(array_merge(
                        $validator->validated(),
                        ['user_id' => $user->id]
                    ));

                    $cart = Cart::with(['product', 'product.galleries', 'product.category'])->find($item->id);
                }

                return ResponseFormatter::success(
                    $cart,
                    'Cart add successfully',
                );
            } else {
                return ResponseFormatter::error(null, 'Unauthorized', 401);
            }
        } catch (Exception $error) {
            return ResponseFormatter::error(null, $error->getMessage(), 500);
        }
    }

    public function delete(Request $request)
    {
        try {
            $user = auth('api')->user();
            if ($user) {
                $cart = Cart::find($request->cart_id);

                if ($cart) {
                    if ($cart->user_id == $user->id) {
                        Cart::destroy($request->cart_id);

                        return ResponseFormatter::success(
                            true,
                            'Cart deleted successfully',
                        );
                    } else {
                        return ResponseFormatter::error(null, 'Data not found!', 404);
                    }
                } else {
                    return ResponseFormatter::error(null, 'Data not found!', 404);
                }
            } else {
                return ResponseFormatter::error(null, 'Unauthorized', 401);
            }
        } catch (Exception $error) {
            return ResponseFormatter::error(null, $error->getMessage(), 500);
        }
    }

    public function increment(Request $request)
    {
        try {
            $user = auth('api')->user();
            if ($user) {
                $cart = Cart::find($request->cart_id);

                if ($cart) {
                    if ($cart->user_id == $user->id) {
                        $cart->update(['qty' => $cart->qty + 1]);

                        return ResponseFormatter::success(
                            true,
                            'Cart increment successfully',
                        );
                    } else {
                        return ResponseFormatter::error(null, 'Data not found!', 404);
                    }
                } else {
                    return ResponseFormatter::error(null, 'Data not found!', 404);
                }
            } else {
                return ResponseFormatter::error(null, 'Unauthorized', 401);
            }
        } catch (Exception $error) {
            return ResponseFormatter::error(null, $error->getMessage(), 500);
        }
    }

    public function decrement(Request $request)
    {
        try {
            $user = auth('api')->user();
            if ($user) {
                $cart = Cart::find($request->cart_id);

                if ($cart) {
                    if ($cart->user_id == $user->id) {
                        if ($cart->qty <= 1) {
                            Cart::destroy($request->cart_id);

                            return ResponseFormatter::success(
                                true,
                                'Cart deleted successfully',
                            );
                        } else {
                            $cart->update(['qty' => $cart->qty - 1]);

                            return ResponseFormatter::success(
                                true,
                                'Cart decrement successfully',
                            );
                        }
                    } else {
                        return ResponseFormatter::error(null, 'Data not found!', 404);
                    }
                } else {
                    return ResponseFormatter::error(null, 'Data not found!', 404);
                }
            } else {
                return ResponseFormatter::error(null, 'Unauthorized', 401);
            }
        } catch (Exception $error) {
            return ResponseFormatter::error(null, $error->getMessage(), 500);
        }
    }
}
