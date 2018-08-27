<?php

namespace App\Modules;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //


    public function getSelfMessage()
    {
        return $this->sender_id === auth()->user()->id;
    }
}
