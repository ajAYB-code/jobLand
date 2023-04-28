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
        $jobs = Job::all();
        
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

    public function create(Request $request) {

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

       
            if($request->file('companyLogo'))
            {
                $data['companyLogo'] = $request->file('companyLogo')->store('companiesLogos');
            }

            $data['userId'] = Auth::user()->id;

            Job::create($data);

            return redirect('/');
            
    }

    public function edit(Request $request){
        $jobId = $request->jobId;
        $job = Job::find($jobId);

        return view('job.edit', [
            'job' => $job
        ]);
    }

    public function update(Request $request){
        $data = $request->validate([
            'title' => ['required'],
            'companyName' => ['required'],
            'companyEmail' => ['required', 'email'],
            'employmentType' => [Rule::in(['full-time', 'remote', 'partial'])],
            'jobDescription' => ['required'],
            'salary' => [],
            'companyLogo' => ['nullable', 'max:4000', 'mimes:png,jpg'],
            'tags' => [new Tags],
            'location' => ['required']
        ]);

        $job = Job::find($request->jobId);

        // Delete old company logo image file

        Storage::disk()->delete($job->companyLogo);

        if($request->has('companyLogo'))
        {
            $data['companyLogo'] = $request->file('companyLogo')->store('companiesLogos');
        }
        

        $job->forceFill($data);
        $job->save();

        return redirect(route('home'));
    }

    public function delete(Request $request) {
        
        $jobId = $request->jobId;
        Job::find($jobId)->delete();
    
        return Response()->json();
    }
}
