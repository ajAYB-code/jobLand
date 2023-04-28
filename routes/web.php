<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FavoriteJobController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PasswordRecoveryController;
use App\Http\Controllers\RecruiterController;
use App\Http\Controllers\userController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\Job;
use App\Models\User;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




/*
-------------------------------------------
|  Routes that require authenticated user |
-------------------------------------------
*/

Route::middleware('auth')->group(function () {

        /* Job crud */

        Route::controller(JobController::class)->group(function (){
                Route::get('/jobs/create', 'showCreateJob')
                        ->name('new_job');
                Route::post('/jobs/create', 'create');

                Route::get('/job/{jobId}/edit', 'edit')
                        ->name('job.edit');        
                Route::post('/job/{jobId}/edit', 'update');   
                Route::post('/job/{jobId}/delete', 'delete');   
        });
      
        
        Route::get('/user/jobs/created', [RecruiterController::class, 'showCreatedJobs'])
                ->name('user_created_jobs');

        /* Favorite job */

        Route::controller(FavoriteJobController::class)->group(function (){
                Route::get('/user/favorited_jobs', 'index')
                        ->name('user_favorited_jobs');
                Route::post('/user/jobs/favorited/add','addFavorite');
                Route::post('/user/jobs/favorited/remove', 'removeFavorite');
        });

        
        Route::controller(userController::class)->group(function (){

                /* User account */

                Route::get('/user/account', 'showAccount')
                        ->name('user_account');
                Route::post('/user/account', 'handleAccountInfoChange');

                /* Apply to job */

                Route::get('/jobs/{id}/apply', 'applyToJob');
                Route::post('/job/apply', 'applyToJobAjax');
        });
     
});


Route::controller(JobController::class)->group(function() {
        Route::get('/', 'index')
                ->name('home');
        Route::get('/jobs/{id}', 'show')
                ->name('show_job');
});



/*
-----------------------
|       User          |
-----------------------
*/

Route::controller(userController::class)->group(function () {

Route::get('/signup','showSignup')
        ->name('signup');
Route::post('/signup', 'handleSignup');


});

Route::get('/about', function () {
    return view('about');
})->name('about');


/* Auth */

Route::controller(AuthController::class)->group(function (){

        Route::get('/login', 'showLogin')
                ->name('login');
        Route::post('/login', 'handleLogin');
        Route::get('/logout', 'logout')
                ->name('logout');
});

/* Password Recovery */

Route::controller(PasswordRecoveryController::class)->group(function (){
        Route::get('/forgot_password', 'showForgotPassword')
                ->name('forgot_password');
        Route::post('/forgot_password', 'handleForgotPassword');
        Route::get('/reset_password', 'showResetPassword')
                ->name('password.reset');
        Route::post('/reset_password', 'handleResetPassword');
});



/* Contact Us */

Route::post('/about/contact_us', ContactController::class);





