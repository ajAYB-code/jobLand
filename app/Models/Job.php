<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Job extends Model
{
    use HasFactory;
    protected $table = 'job';

    protected $fillable = [
        'title',
        'userId',
        'companyName',
        'companyEmail',
        'salary',
        'jobDescription',
        'employmentType',
        'companyLogoImagePath',
        'tags',
        'location'
    ];    

    protected function getTagsAttribute($value) {
         $tags = explode(',', $value);
         foreach($tags as $tag)
         {
            trim($tag);
         }
         return $tags;
    }


    // Accessors

    protected function getIsFavoritedAttribute() {
        $jobId = $this->id;
        $userId = Auth::user()->id ?? false;
        if(!$userId)
        {
            return false;
        }
        $favoritedJobs = favoritedJobs::where(
                ['userId' => $userId, 'jobId' => $jobId]
        )->get();

        if(count($favoritedJobs) == 0)
        {
            return false;
        } 
        return true;
    }

    protected function getCompanyLogoAttribute() {
     return asset('storage/' . ($this->companyLogoImagePath ? $this->companyLogoImagePath : 'companiesLogos/default_logo.jpg'));
    }

    protected function getSalaryFormattedAttribute() {
        $amount = $this->salary;
        if(!$amount)
        {
            return 'undefined';
        }
       if($amount >= 1000)
       {
        return '$' . $amount / 1000 . 'k';
       }
       return '$' . $amount;
    }

    // Filters

    public function scopeFilter($query){

        // Filter jobs by (location, search_query, tags)
        
        $search_for = request()->search_for;
        $location = request()->location;
        $tag = request()->tag;
        $employment_types = request()->employment_type ?? Job::select('employmentType')->get();
        
        $query->where(function ($query) use($search_for) {
            $query->where('title', 'like', "%$search_for%")
                    ->orWhere('tags', 'like', "%$search_for%");
        })
        ->where('tags', 'like', "%$tag%")
        ->where('location', 'like', "%$location%")
        ->whereIn('employmentType', $employment_types);
    }
}
