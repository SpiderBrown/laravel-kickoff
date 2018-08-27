<?php

namespace App\Http\Controllers\Admin;

use App\Events\AdminBroadcastMessage;
use App\Events\AdminPrivateMessage;
use App\Modules\Message;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MessageController extends Controller
{

    public function index()
    {
        $users=User::all();
        return view('admin.chat.chat_index',['users'=>$users]);
    }

    public function messages($id)
    {

        $messages=Message::where([['sender_id',$id],['reciever_id',\Auth::user()->id]])
            ->orWhere([['reciever_id',$id],['sender_id',\Auth::user()->id]])->get();

        echo $messages;
    }

    public function sendBroadcast()
    {
        $message=[
            'message' => "Hello Users, Server will be down at 12 for maintenance!",
        ];

        event(new AdminBroadcastMessage($message));
        echo 'sent';
    }

    public function sendPrivatePost($id,Request $request)
    {
        $user=User::find($id);
        $message=new Message();
        $message->body=$request->message;
        $message->sender_id=$request->sender_id;
        $message->reciever_id=$request->reciever_id;
        $message->save();
        event(new AdminPrivateMessage($message,$user));
        echo $message;
    }
}
