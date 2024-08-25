<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('pages.profile.index', [
            'title' => $user->name,
            'user' => $user,
        ]);
    }
    public function userShow () {
        return view('pages.user.index',[
            'title' => 'List User',
            'user' => User::paginate(15),
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();
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

        return redirect()->route('profile')->with('success', 'Your account updated successfully.');
    }
}
