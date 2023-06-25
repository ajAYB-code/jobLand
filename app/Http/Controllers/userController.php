<?php

namespace App\Http\Controllers;

use App\Models\favoritedJobs;
use App\Models\Job;
use App\Mail\jobApply;
use App\Models\User;
use Facade\FlareClient\Http\Response as HttpResponse;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;
use Swift_TransportException;

class userController
{

    /*
    ----------------------------------
    |             signup              |
    ---------------------------------- 
    */
    
    public function showSignup() {
        return view('auth.signup');
    }

    public function handleSignup(Request $request) {
       $formData = $request->validate(
        [
            'firstName' => ['required'],
            'lastName' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed']
        ]
        );

        // Hash the password
        $formData['password'] = bcrypt($formData['password']);

        // Create new user
        User::create($formData);
        return redirect(route('login'));
    }

    /*
    ----------------------------------
    |             account              |
    ---------------------------------- 
    */  
    
    public function showAccount() {
        return view('user.account');
    }

    public function handleAccountInfoChange(Request $request) {
        $formData = $request->validate(
            [
                'firstName' => ['required'],
                'lastName' => ['required'],
                'email' => ['required', 'email', Rule::unique('users', 'email')],
            ]
            );

            $user = User::find(Auth::user()->id);
            $user->forceFill($formData);
            $user->save();

            return redirect(route('login'));
    }

      

  
    /* 
    --------------------------------
    |          Apply to job        |
    --------------------------------
    */

    public function applyToJob(Request $request){
     $data = $request->validate(
        [
            'cvFile' => ['mimes:pdf,docx,doc']
        ]
        );

        $cvFile = $data['cvFile'];

        // Get user email and fullName
        $fullName = Auth::user()->fullName;
        $userEmail = Auth::user()->email;

        // Company email
        $jobId = $request->jobId;
        $companyEmail = Job::find($jobId)->companyEmail;

        // Email message
        Mail::send('email.applyJob', ['fullName' => $fullName, 'userEmail' => $userEmail], function($message) use($cvFile, $companyEmail) {
              $message->to($companyEmail)->subject('apply to job');
              $message->attach($cvFile->getRealPath(), array(
                                            'as' => 'CV',
                                            'mime' => $cvFile->getMimeType()
                                        )
                        );
        });
        
        
    }
}
