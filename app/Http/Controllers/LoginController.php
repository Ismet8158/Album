<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticate(Request $request)
    {
        if (Auth::attempt(['login' => $request->login, 'password' => $request->password], $request->remember))
        {
            $token = Auth::user()->createToken(config('app.name'))->accessToken;
            return response(["token" => $token]);
        }
        else return response("Такого пользователя не существует");
    }

    public function isAuthenticated(){
        return response(Auth::viaRemember());
    }
}
