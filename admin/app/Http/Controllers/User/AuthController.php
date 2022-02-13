<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class AuthController extends Controller
{
    public function Login(Request $request){
        try{
            if(Auth::attempt($request->only('email', 'password'))){
                $user = Auth::user();
                $token = $user->createToken('app')->accessToken;

                return response([
                    'message' => "Successfully Logged in",
                    'token' => $token,
                    'user' => $user
                ],200);
            }
        }catch(Exception $exception){
            return response([
                'message' => $exception->getMessage(),
            ],400);
        }
        return response([
            'message' => 'Invalid Email or Password'
        ],401);
    }
} //End Method
