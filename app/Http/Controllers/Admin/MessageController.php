<?php

namespace App\Http\Controllers\Admin;

use App\Events\AdminBroadcastMessage;
use App\Events\AdminPrivateMessage;
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
    public function sendPrivate($id)
    {
        $user=User::find($id);
        $message=[
            'message' => "Hello ".$user->name.", Lets have a coffee.",
        ];

        event(new AdminPrivateMessage($message,$user));
        echo 'sent private';
    }
}
