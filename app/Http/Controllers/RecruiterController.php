<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecruiterController extends Controller
{
    
    public function showCreatedJobs() {
        $userId = Auth::user()->id;
        $jobs = Job::where('userId', $userId)
                    ->get();
  
        return view('user.created_jobs', [
            'jobs' => $jobs
        ]);
    } 

}
