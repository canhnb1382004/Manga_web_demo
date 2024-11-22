<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    // Lấy tất cả tin nhắn
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    // Gửi tin nhắn
    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($message->load('user')))->toOthers();

        return $message;
    }
}
