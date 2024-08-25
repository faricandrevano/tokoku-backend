<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseFormatter;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionProduct;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function read(Request $request)
    {
        try {
            $user = auth('api')->user();
            if ($user) {
                $limit = $request->input('limit', 10);

                $transactions = Transaction::with([
                    'products', 'products.product', 'products.product.category', 'products.product.galleries'
                ])->where('user_id', $user->id);

                return ResponseFormatter::success(
                    $transactions->paginate($limit),
                    'Get transactions successfully',
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
                    'address' => 'required|string|max:255',
                    'total' => 'required|numeric',
                ]);

                if ($validator->fails()) {
                    return ResponseFormatter::error(null, $validator->errors()->first());
                }

                $carts = Cart::where('user_id', $user->id)->get();

                if ($carts->isNotEmpty()) {
                    $validatedData = $validator->validated();
                    $validatedData['user_id'] = $user->id;

                    $currentDateTime = now();
                    $dateString = $currentDateTime->format('YmdHis');
                    $transactionCode = 'TRX-' . $dateString . random_int(2, 5);

                    $validatedData['code'] = $transactionCode;

                    $transaction = Transaction::create($validatedData);

                    foreach ($carts as $item) {
                        TransactionProduct::create([
                            'transaction_id' => $transaction->id,
                            'product_id' => $item->product_id,
                            'qty' => $item->qty,
                            'user_id' => $user->id,
                        ]);
                    }

                    foreach ($carts as $item) {
                        Cart::destroy($item->id);
                    }

                    $data = Transaction::with(['products', 'products.product'])->find($transaction->id);

                    return ResponseFormatter::success(
                        $data,
                        'Create transaction successfully',
                    );
                } else {
                    return ResponseFormatter::error(
                        false,
                        'Cart is empty, please input product to cart!',
                    );
                }
            } else {
                return ResponseFormatter::error(null, 'Unauthorized', 401);
            }
        } catch (Exception $error) {
            return ResponseFormatter::error(null, $error->getMessage(), 500);
        }
    }
}
