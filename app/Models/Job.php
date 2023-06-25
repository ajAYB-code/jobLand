<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\VarDumper;

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
        'companyLogo',
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

        $jobs = favoritedJobs::where(
                ['userId' => $userId, 'jobId' => $jobId]
        )->get();

        if(count($jobs) > 0)
        {
            return true;
        } 

        return false;
    }

    // protected function getCompanyLogoAttribute() {
    //  return asset('storage/' . ($this->companyLogoImagePath ? $this->companyLogoImagePath : 'companiesLogos/default_logo.jpg'));
    // }

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

        // Filter by searching title
        if(request()->has('search_for'))
        {
            $query->where('title', 'LIKE', '%' . request()->search_for . '%');
        }

        // Filter by searching location
        if(request()->has('location'))
        {
            $query->where('location', 'LIKE', request()->location);
        }

        // Filter by tags
        if(request()->has('tag'))
        {
            $query->where('tags', 'LIKE', request()->tag);
        }

        // Filter by employment type (Remote, full time..)
        if(request()->has('employment_type'))
        {
            $query->whereIn('employmentType', request()->employment_type);
        }

        // Filter by post date (last [day, month..])
        if(request()->has('post_date'))
        {
            switch(request()->post_date)
            {
                case 'last_day': $query->lastDay(); break;
                case 'last_week': $query->lastWeek(); break;
                case 'last_month': $query->lastMonth(); break;
            }
        }

    }

    public function scopeLastDay($query){
        $query->whereBetween('created_at', [Carbon::now()->subDay(), Carbon::now()]);
    }

    public function scopeLastWeek($query){
        $query->whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()]);
    }

    public function scopeLastMonth($query){
        $query->whereBetween('created_at', [Carbon::now()->subMonth(), Carbon::now()]);
    }

}
