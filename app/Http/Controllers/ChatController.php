<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function index()
    {
        $search = request('search');

        $rooms = Room::latest()->with('user');

        if ($search) {
            $rooms->with('user')
                ->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->orderByDesc('created_at');
        }

        return view('pages.chat.index', [
            'title' => 'All Chat',
            'rooms' => $rooms->paginate(15),
        ]);
    }

    public function show(Room $room)
    {
        $chats = Chat::where('room_id', $room->id)->orderBy('created_at', 'asc')->get();

        return view('pages.chat.show', [
            'title' => 'Chat by ' . $room->user->name,
            'room' => $room,
            'chats' => $chats,
        ]);
    }

    public function send(Room $room, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $validatedData = $validator->validated();

        $validatedData['type'] = 'ADMIN';
        $validatedData['room_id'] = $room->id;
        $validatedData['user_id'] = auth()->user()->id;

        Chat::create($validatedData);

        return redirect()->route('chat/show', $room->id)->with('success', 'New message send successfully.');
    }
}
