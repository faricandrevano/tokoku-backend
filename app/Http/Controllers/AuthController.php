<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('pages.auth.login', [
            'title' => 'Sign In',
        ]);
    }

    public function authentication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email|required|exists:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        if (Auth::attempt(
            array('email' => $validated['email'], 'password' => $validated['password']),
            $request->remember,
        )) {
            return redirect()->route('home')->with(
                'success',
                'Welcome! You have successfully logged in.',
            );
        } else {
            $validator->errors()->add(
                'password',
                'The password does not match with email'
            );
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function register()
    {
        return view('pages.auth.register', [
            'title' => 'Create new account',
        ]);
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|max:255|unique:users',
            'password' => 'required|string|min:6',
            'terms' => 'required',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'username' => $validatedData['username'],
            'password' => $validatedData['password'],
        ]);

        auth()->login($user);

        return redirect()->route('home')->with(
            'success',
            'Welcome! You have successfully logged in.',
        );
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
