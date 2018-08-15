<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 8/15/2018
 * Time: 1:39 PM
 */

namespace App\Modules\User;


use App\SocialUser;
use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialUserService
{
    public $socialUser;
    public $userService;

    public function __construct()
    {
        $this->socialUser = new SocialUser();
        $this->userService = new UserService();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $suser = Socialite::driver($provider)->user();

        $user=$this->userService->isEmailExist($suser->getEmail());
        if(!$user){
            //create user
            $user=$this->createUserFromSocialuser($suser,$provider);
        }

        //check if socialuser exist for the provider
        if(!$this->isSocialExist($suser->getEmail(),$provider)){
            //create Socialuser
            $dbsuser=$this->createSocialuser($suser,$provider);
        }

//        Auth::guard()->logout();
        //log user
        Auth::guard()->login($user, true);

        return redirect()->intended();
    }







    private function createUserFromSocialuser($suser){
        $user=new User;
        $user->name= $suser->getName();
        $user->email= $suser->getEmail();
        $user->password= str_random(16);
        $user->avatar= $suser->getAvatar();

        return $this->userService->storeUser($user);
        //        $user->notify(New UserRegistered($user))
    }

    private function createSocialUser($suser,$social){
        $user=new SocialUser;
        $user->social_id=$suser->getId();
        $user->name= $suser->getName();
        $user->email= $suser->getEmail();
        $user->avatar= $suser->getAvatar();
        $user->social=$social;
        $user->access_token=$suser->token;
        $user->refresh_token=$suser->refreshToken;
        $user->save();
        return $user;
    }

    public function isSocialExist($email,$provider){
        return $this->socialUser
            ->where('email','=',$email)
            ->where('social','=',$provider)
            ->first();
    }
}





// // OAuth Two Providers
// $token = $user->token;
// $refreshToken = $user->refreshToken; // not always provided
// $expiresIn = $user->expiresIn;

// // OAuth One Providers
// $token = $user->token;
// $tokenSecret = $user->tokenSecret;

// All Providers
// $user->getId();
// $user->getNickname();
// $user->getName();
// $user->getEmail();
// $user->getAvatar();

// //get user from valid token OAUTH2
// //$user = Socialite::driver('github')->userFromToken($token);

// $user = Socialite::driver('twitter')->userFromTokenAndSecret($token, $secret); //OAUTH1

//The stateless method may be used to disable session state verification. This is useful when adding social authentication to an API:
//return Socialite::driver('google')->stateless()->user();