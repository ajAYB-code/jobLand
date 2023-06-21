<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function showLogin() {
        return view('auth.login');
    }

    public function handleLogin(Request $request) {

      $formData = $request->validate(
        [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]
        );

        if(Auth::attempt($formData))
        {
            return redirect()->intended(route('home'));
        }

        return redirect(route('login'))->withErrors(['formError' => 'Your data is not valid']);
        return back()->withInput()
                    ->withErrors(['formError' => 'Your data is not valid']);
    }

    public function logout() {
        Auth::logout();
        return redirect(route('home'));
     }

}
