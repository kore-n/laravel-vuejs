<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    // 全メッセージを取得
    public function index()
    {
        return Message::orderBy('created_at', 'asc')->get();
    }

    // 新しいメッセージを保存
    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $message = Message::create([
            'user' => $request->user,
            'message' => $request->message,
        ]);

        return response()->json($message, 201);
    }
}