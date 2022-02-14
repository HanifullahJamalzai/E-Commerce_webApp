<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ResetRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use DB;

class ResetController extends Controller
{
    public function ResetPassword(ResetRequest $request){
        $token= $request->token;
        $email = $request->email;
        $password = Hash::make($request->password);
       
        // Check token and email
        $emailCheck = DB::table('password_resets')->where('email', $email)->first();
        $tokenCheck = DB::table('password_resets')->where('token', $token)->first();

        if(!$emailCheck){
            return response([
                'message' => 'Email not found'
            ], 401);
        }else if(!$tokenCheck){
            return response([
                'message' => 'Pin code invalid'
            ], 401);
        }

        // Update password column
        DB::table('users')->where('email', $email)->update(['password' => $password]);
        // Delete row from password_resets table
        DB::table('password_resets')->where('email', $email)->delete();

        return response([
            'message' => "Password changed successfully"
        ], 200);

    } // End Method
}
