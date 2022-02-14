<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Mail\ForgetMail;
use DB;
use App\Http\Requests\ForgetRequest;
use App\Models\User;


class ForgetController extends Controller
{
    public function ForgetPassword(ForgetRequest $request){
        $email = $request->email;
        // Check if email exist in User DB
        if(User::where('email',$email)->doesntExist()){
            return response([
                'message' => 'Email Is Invalid'
            ]);
        }
        // Token generate
        $token = rand(10,1000000);

        try{
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
            ]);

            // Mail send to user
            Mail::to($email)->send(new ForgetMail($token));

            // Success response
            return response([
                'message' => 'Reset Password has been sent to your email'
            ]);

            // if any error
        }catch(Exception $exception){
            return response([
                'message'=> $exception->getMessage()
            ]);
        }

    }
}
