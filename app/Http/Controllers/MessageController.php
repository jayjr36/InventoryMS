<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function fetchMessages()
    {
        $messages = Message::latest()->get();
        return view('admin.messages', compact('messages'));
    }
    public function sendMessageToAdmin(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'message' => 'required|string',
            'userId' => 'required|integer',
            'userName' => 'required|string',
            'userEmail' => 'required|email',
        ]);

        // Create a new message
        $message = new Message();
        $message->message = $request->message;
        $message->user_id = $request->userId;
        $message->user_name = $request->userName;
        $message->user_email = $request->userEmail;
        // You may need to adjust this according to your Message model attributes

        // Save the message
        $message->save();

        return response()->json(['success' => true]);
    }
}
