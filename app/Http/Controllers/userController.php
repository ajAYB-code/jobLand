<?php

namespace App\Http\Controllers;

use App\Models\favoritedJobs;
use App\Models\Job;
use App\Mail\jobApply;
use App\Models\User;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class userController
{
    
    /*
    ----------------------------------
    |             login              |
    ---------------------------------- 
    */

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
            return redirect()->intended('/');
        }

        return redirect('/login')->withErrors(['formError' => 'Your data is not valid']);
    }

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
        return redirect('/login');
    }

    /*
    ----------------------------------
    |             logout              |
    ---------------------------------- 
    */    

    public function logout() {
       Auth::logout();
       return redirect('/');
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
                'email' => ['required', 'email'],
            ]
            );

            // Check if there is any change
            $dataChanged = false;
            foreach($formData as $key => $value)
            {
                if(Auth::user()->{$key} !== $value)
                {
                    $dataChanged = true;
                    break;
                }
            }

            if($dataChanged == true)
            {
                $userDetails = Auth::user();
                $user = User::find($userDetails->id);
                foreach($formData as $key => $value)
                {
                    $user->{$key} = $value;
                }
                $user->save();
                return redirect('user/account');
            }
    }

    /*
    ----------------------------------
    |             created jobs       |
    ---------------------------------- 
    */  

    public function showCreatedJobs() {
        $userId = Auth::user()->id;
        $jobs = Job::where('userId', $userId)
                    ->get();
  
        return view('user.created_jobs', [
            'jobs' => $jobs
        ]);
    }

    public function deleteJob(Request $request) {
        
        $jobId = $request->id;
        Job::where('id', $jobId)->delete();
    
        return Response()->json();
    }    

        /*
    ----------------------------------
    |             Favorited jobs       |
    ---------------------------------- 
    */  

    public function showFavoritedJobs() {
        $userId = Auth::user()->id;
        $jobsIds = favoritedJobs::select('jobId')->where('userId', $userId)
                                ->get();
        $jobs = Job::whereIn('id', $jobsIds)
                    ->get();
  
        return view('user.favorited_jobs', [
            'jobs' => $jobs
        ]);
    }

    public function addFavoritedJob(Request $request) {
        
        $jobId = $request->id;
        
        // Check if the job exist in the database
        $job = Job::find($jobId);

        if(empty($job))
        {
            return Response()->json(
                [
                    "error" => "job doesn't exist"
                ]
            );
        }

        $userId = Auth::user()->id;
        favoritedJobs::create([
            'userId' => $userId,
            'jobId' => $jobId
        ]);
        return Response()->json();
    }

    public function removeFavoritedJob(Request $request) {
        
        $jobId = $request->id;
        $userId = Auth::user()->id;
        favoritedJobs::where(
            [
                ['userId', '=', $userId],
                ['jobId', '=', $jobId]
            ]
        )->delete();
    
        return Response()->json();
    }

    /* 
    --------------------------------
    |          Apply to job        |
    --------------------------------
    */
    
    // This is when the user tries to send cv without
    // Authenticating, So we redirect the request to 
    // /jobs/{id}/apply which is under 'auth' middleware
    // and then we redirect it back to /job/{id}

    public function applyToJob(Request $request){
     $jobId = $request->id;
     return redirect("/jobs/$jobId");
    }

    public function applyToJobAjax(Request $request){
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
