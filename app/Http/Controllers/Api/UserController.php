<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseFormatter;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function profile()
    {
        try {
            $user = auth('api')->user();
            if ($user) {
                return ResponseFormatter::success($user, 'User retrieved successfully');
            } else {
                return ResponseFormatter::error(null, 'Unauthorized', 401);
            }
        } catch (Exception $error) {
            return ResponseFormatter::error(null, $error->getMessage(), 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $user = auth('api')->user();
            if ($user) {
                $rules = [
                    'name' => 'required|string|max:255',
                ];

                if ($request->username && $request->username != $user->username) {
                    $rules['username'] = 'required|string|max:255|unique:users';
                }
                if ($request->phone && $request->phone != $user->phone) {
                    $rules['phone'] = 'required|string|min:10|unique:users';
                }
                if ($request->file('image')) {
                    $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
                }

                $validatedData = $request->validate($rules);

                if ($request->file('image')) {
                    if ($user->image) {
                        $url = $user->image;
                        $desiredString = Str::after($url, 'storage/');
                        Storage::delete($desiredString);
                    }
                    $validatedData['image'] = config('app.base_image') . $request->file('image')->store('user');
                }

                User::where('id', $user->id)->update($validatedData);

                $updateData = User::find($user->id);

                return ResponseFormatter::success(
                    $updateData,
                    'User successfully updated',
                );
            } else {
                return ResponseFormatter::error(null, 'Unauthorized', 401);
            }
        } catch (Exception $error) {
            return ResponseFormatter::error(null, $error->getMessage(), 500);
        }
    }
}
