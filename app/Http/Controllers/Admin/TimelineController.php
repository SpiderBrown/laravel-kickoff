<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TimelineController extends Controller
{
    public function index(){
        $user = Auth::user();
        $notifications = $user->notifications;
        foreach ($notifications as $notification){
            $notification->markAsRead();
        }
        return view('admin.timeline.timeline_index',['notifications' => $notifications,]);
    }

    public function type($type){
        $user = Auth::user();
        $notifications = $user->notifications;
        return view('admin.timeline.timeline_index',['noties' => $notifications,'type'=>$type]);
    }

    //just for test
    public function add(){
        $user=Auth::user();
        $timeline=new \App\Modules\Timeline();
        $timeline->title=Auth::user()->name;
        $timeline->title_info=" Happy Birthday";
        $timeline->icon="fa fa-car bg-yellow";
//        $timeline->content='<h1>Custom Header</h1> again and again';
//        $timeline->title_link=route('users.show',Auth::user()->id);
//        $timeline->button_text='OK';
//        $timeline->button_class="btn btn-sm btn-warning";
//        $timeline->button_link=route('users.show',$user->id);

        $user->notify(new \App\Notifications\CustomTimelineNotification($timeline));
        return redirect()->route('timeline.index');
    }
    //just for test
    public function welcome(){
        Auth::user()->notify(new \App\Notifications\WelcomeMessage());
        return 1;
    }
}
