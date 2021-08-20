<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    public $successStatus = 200;

    /**
    * login api
    * login api
    * @return \Illuminate\Http\Response
    */
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['access_token'] =  $user->createToken('BulletinBoard Password Grant Client')->accessToken;
            $success['token_type']= 'Bearer';
            $success['data'] = $user;

            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error'=>'Unauthorized'], 401);
        }
    }
    public function logout(Request $request)
    {
        Auth::user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return response()->json('Successfully logged out');
    }
}
