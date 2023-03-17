<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Rules\Tags;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

use function GuzzleHttp\Promise\all;

class JobController extends Controller
{
    // Show jobs
    public function index() {
        $jobs = Job::filter()->get();
        
        return view('job.index', [
            'jobs' => $jobs
        ]);
    }

    public function show(Request $request){
        $jobId = $request->id;
        $job = Job::find($jobId);
        return view('job.show', [
            'job' => $job
        ]);

    }

    // Show create job page
    public function showCreateJob(Request $request) {
            return view('job.create');
    }

    // Handle create job page
    public function handleCreateJob(Request $request) {

        // Check if there is a company logo input
        // Other wise set it to null
        // Because laravel will raise an excception when validating the data

        $data = $request->validate(
            [
               'title' => ['required'],
               'companyName' => ['required'],
               'companyEmail' => ['required', 'email'],
               'employmentType' => [Rule::in(['full-time', 'remote', 'partial'])],
               'jobDescription' => ['required'],
               'salary' => [],
               'companyLogo' => ['nullable', 'max:4000', 'mimes:png,jpg'],
               'tags' => [new Tags],
               'location' => ['required']
            ]
            );
       
            // Store the company logo image and 
            // Get it's path to store in the database
            $logoImagePath = null;
            if($request->file('companyLogo'))
            {
                $logoImagePath = $request->file('companyLogo')->store('companiesLogos');
            }

            // Create the job
            Job::create(
                [
                    'userId' => Auth::user()->id,
                    'title' => $request->title,
                    'companyName' => $request->companyName,
                    'companyEmail' => $request->companyEmail,
                    'employmentType' => $request->employmentType,
                    'salary' => $request->salary,
                    'jobDescription' => $request->jobDescription,
                    'companyLogoImagePath' =>  $logoImagePath,
                    'tags' => $request->tags,
                    'location' => $request->location
                ]
            );

            return redirect('/');
            
    }
}
