<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\ResponseFormatter;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'password']]);
    }

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users',
                'username' => 'required|string|unique:users',
                'password' => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
                return ResponseFormatter::error(null, $validator->errors()->first());
            }

            User::create(array_merge(
                $validator->validated(),
                ['password' => bcrypt($request->password)]
            ));

            if (!$token = auth('api')->attempt($validator->validated(), true)) {
                return ResponseFormatter::error(null, 'Unauthorized', 401);
            }

            return $this->createNewToken($token);
        } catch (Exception $error) {
            return ResponseFormatter::error(null, $error->getMessage(), 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email',
                'password' => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
                return ResponseFormatter::error(null, $validator->errors()->first(), 422);
            }

            $user = User::where('email', $request->email)->first();

            if ($user) {
                if ($user->password) {
                    if (!$token = auth('api')->attempt($validator->validated(), true)) {
                        return ResponseFormatter::error(null, 'Unauthorized', 401);
                    }

                    return $this->createNewToken($token);
                } else {
                    return ResponseFormatter::error(null, 'Silahkan login via google dan setup password', 401);
                }
            } else {
                return ResponseFormatter::error(null, 'Unauthorized', 401);
            }
        } catch (Exception $error) {
            return ResponseFormatter::error(null, $error->getMessage(), 500);
        }
    }

    public function createNewToken($token)
    {
        return ResponseFormatter::success(
            [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => auth('api')->user(),
            ],
            'Authentication successfully',
        );
    }

    public function logout()
    {
        try {
            auth('api')->logout();

            return ResponseFormatter::success(
                true,
                'User successfully logout',
            );
        } catch (Exception $error) {
            return ResponseFormatter::error(null, $error->getMessage(), 500);
        }
    }

    public function password(Request $request)
    {
        try {
            $user = auth('api')->user();
            if ($user) {
                $validatedData = $request->validate([
                    'old_password' => 'required|string|min:6',
                    'password' => 'required|string|min:6',
                ]);

                if (!Hash::check($validatedData['old_password'], $user->password)) {
                    return ResponseFormatter::error(null, 'Password lama tidak cocok', 422);
                }

                if ($validatedData['old_password'] == $validatedData['password']) {
                    return ResponseFormatter::error(null, 'Password harus berbeda dengan password lama', 404);
                }

                User::where('id', $user->id)->update(['password' => bcrypt($request->password)]);

                return ResponseFormatter::success(
                    null,
                    'Password successfully updated',
                );
            } else {
                return ResponseFormatter::error(null, 'Unauthorized', 401);
            }
        } catch (Exception $error) {
            return ResponseFormatter::error(null, $error->getMessage(), 500);
        }
    }
}
