<?php

namespace App\Http\Controllers\Admin;

use App\Events\AdminBroadcastMessage;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MessageController extends Controller
{

    public function index()
    {
        return view('admin.chat.chat_index');
    }

    public function sendBroadcast()
    {
        $message=[
            'message' => "Hello Users, Server will be down at 12 for maintenance!",
        ];

        event(new AdminBroadcastMessage($message));
        echo 'sent';
    }
}
