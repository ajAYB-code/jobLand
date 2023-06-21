<?php

namespace App\Http\Controllers;

use App\Models\favoritedJobs;
use App\Models\Job;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteJobController extends Controller
{

    public function index() {
        $userId = Auth::user()->id;
        $jobs = User::find($userId)->favoritedJobs;

        return view('user.favorited_jobs', [
            'jobs' => $jobs
        ]);
    }

    public function addFavorite(Request $request) {
        
        $jobId = $request->jobId;
        $userId = $request->userId;

        favoritedJobs::create([
            'userId' => $userId,
            'jobId' => $jobId
        ]);

        return Response()->json();
  
    }

    public function removeFavorite(Request $request) {
        
        $jobId = $request->jobId;
        $userId = $request->userId;

        favoritedJobs::where(
            [
                ['userId', '=', $userId],
                ['jobId', '=', $jobId]
            ]
        )->delete();
    
        return Response()->json();
    }

}
