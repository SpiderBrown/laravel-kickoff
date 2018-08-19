<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 8/15/2018
 * Time: 1:39 PM
 */

namespace App\Modules\User;


use App\User;
use Illuminate\Support\Facades\Hash;

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
        $this->user->password   = Hash::make($user->password);
        $this->user->save();
    }
}