<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use http\Client\Curl\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function keycloak(Request $request)
    {
        return Socialite::driver('keycloak')->redirect();
    }

    public function keycloakCallback(Request $request)
    {
        // TODO Will get the error for this step because application ran in docker.
        //      So, can not url KEYCLOAK_BASE_URL in .env.
        //      ===> Need to deploy Identity (Keycloak) server to internet.
        $user = Socialite::driver('keycloak')->user();
        dump($user);

        /*$user = User::firstOrCreate([
            'email' => $user->getEmail(),
        ], [
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'social_id' => $user->getId(),
        ]);

        Auth::login($user, true);
        return redirect('/home');*/
    }
}
