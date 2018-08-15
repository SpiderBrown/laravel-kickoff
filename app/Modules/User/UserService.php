<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 8/15/2018
 * Time: 1:39 PM
 */

namespace App\Modules\User;


use App\User;

class UserService
{
    public $user;

    public function __construct()
    {
        $this->user=new User();
    }

    public function isEmailExist($email){
       return $this->user->where('email','=',$email)->first();
    }

    public function storeUser($user){
        $this->user=$user;
        $this->user->uuid       = str_random(16);
        $this->user->password   = bcrypt($user->password);
        $this->user->save();
    }
}