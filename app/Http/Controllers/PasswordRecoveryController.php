<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class PasswordRecoveryController extends Controller
{
    /*
    ----------------------------------
    |             Forgot password    |
    ---------------------------------- 
    */  

    public function showForgotPassword(){
        return view('auth.password_forgot');
    }

    public function handleForgotPassword(Request $request){
        $request->validate([
            'email' => ['required', 'email']
        ]);

        $status = Password::sendResetLink(
                $request->only('email')
        );

        // dd($status);

        if($status === Password::RESET_LINK_SENT)
        {
           return back()->with(['status' => __($status)]);
        }

        return back()->withErrors(['error' => __($status)]);
        
    }

    /*
    ----------------------------------
    |             Reset password     |
    ---------------------------------- 
    */

    public function showResetPassword(){
        return view('auth.reset_password');
    }

    public function handleResetPassword(Request $request){
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['min:8', 'confirmed']
        ]);

        $status = Password::reset(
            $request->only('token', 'email', 'password', 'password_confirmation'),
            function ($user, $password){
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);

                $user->save();
            }
        );

        if($status === Password::PASSWORD_RESET)
        {
            return redirect()->route('login');
        }

        return back()->withErrors(['error' => __($status)]);
    }
}
