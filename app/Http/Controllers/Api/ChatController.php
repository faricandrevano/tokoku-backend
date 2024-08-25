<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseFormatter;
use App\Models\Chat;
use App\Models\Room;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ChatController extends Controller
{
    public function room(Request $request)
    {
        try {
            $user = auth('api')->user();
            if ($user) {
                $limit = $request->input('limit', 10);

                $rooms = Room::with(['admin'])->where('user_id', $user->id);

                return ResponseFormatter::success(
                    $rooms->paginate($limit),
                    'Get chat rooms successfully',
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
                    'admin_id' => [
                        'required',
                        'string',
                        'max:255',
                        Rule::exists('users', 'id'),
                    ],
                ]);

                if ($validator->fails()) {
                    return ResponseFormatter::error(null, $validator->errors()->first());
                }

                $rooms = Room::with(['admin'])->where('user_id', $user->id);

                $room = $rooms->where('admin_id', $request->admin_id)->get();

                if ($room->isNotEmpty()) {
                    return ResponseFormatter::success(
                        $room->first(),
                        'Get detail room successfully',
                    );
                } else {
                    $new = Room::create([
                        'user_id' => $user->id,
                        'admin_id' => $request->admin_id,
                    ]);

                    $data = Room::with(['admin'])->find($new->id);

                    return ResponseFormatter::success(
                        $data,
                        'Create room successfully',
                    );
                }
            } else {
                return ResponseFormatter::error(null, 'Unauthorized', 401);
            }
        } catch (Exception $error) {
            return ResponseFormatter::error(null, $error->getMessage(), 500);
        }
    }

    public function chat($id, Request $request)
    {
        try {
            $user = auth('api')->user();
            if ($user) {
                $limit = $request->input('limit', 10);

                $chats = Chat::with(['user', 'product', 'product.galleries', 'product.category'])->where('room_id', $id);

                return ResponseFormatter::success(
                    $chats->paginate($limit),
                    'Get messages successfully',
                );
            } else {
                return ResponseFormatter::error(null, 'Unauthorized', 401);
            }
        } catch (Exception $error) {
            return ResponseFormatter::error(null, $error->getMessage(), 500);
        }
    }

    public function send($id, Request $request)
    {
        try {
            $user = auth('api')->user();
            if ($user) {
                $validator = Validator::make($request->all(), [
                    'message' => 'required|string',
                    'product_id' => [
                        'nullable',
                        'string',
                        'max:255',
                        Rule::exists('products', 'id'),
                    ],
                ]);

                if ($validator->fails()) {
                    return ResponseFormatter::error(null, $validator->errors()->first());
                }

                $validatedData = $validator->validate();

                $validatedData['type'] = 'USER';
                $validatedData['room_id'] = $id;
                $validatedData['user_id'] = $user->id;

                $chat = Chat::create($validatedData);

                return ResponseFormatter::success(
                    $chat,
                    'Send message successfully',
                );
            } else {
                return ResponseFormatter::error(null, 'Unauthorized', 401);
            }
        } catch (Exception $error) {
            return ResponseFormatter::error(null, $error->getMessage(), 500);
        }
    }
}
