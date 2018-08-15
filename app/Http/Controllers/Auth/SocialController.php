<?php

namespace App\Http\Controllers\Auth;

use App\Modules\User\SocialUserService;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;


class SocialController extends LoginController
{
    public $socialUserService;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest')->except('logout');
        $this->socialUserService = new SocialUserService();
    }

    /**
     * Redirect the user to the Provider authentication page.
     *
     * @param Provider
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        return $this->socialUserService->handleProviderCallback($provider);
    }

}
