<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'subject' => ['nullable'],
            'email' => ['required', 'email'],
            'message' => ['required']
        ]);

        Mail::send('email.contactUs',
                    ['msg' => $request->message],
                    function ($mail) use ($request){
                        $mail->to(config('mail.from.contactAdress'));
                        $mail->from($request->email);
                        $mail->subject($request->subject);
                    }
                );
    }
       
}
