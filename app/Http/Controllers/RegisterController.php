<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'login' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
        ]);
    }

    protected function create(Request $request)
    {
        $validator = $this->validator([ 'login' => $request->login, 'password' => $request->password, 'password_confirmation' => $request->confirmedPassword ]);
        if($validator->fails()){
            return response($validator->errors());
        }
        $user = User::create([   
            'login' => $request->login,
            'password' => Hash::make($request->password)
        ]);
        $token = $user->createToken(config("app.name"))->accessToken;
        return response(["token" => $token]);
    }
}
