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
                Route::name('job.')->group(function (){
                        Route::get('/jobs/create', 'showCreateJob')
                                ->name('create');
                        Route::post('/jobs/create', 'create');

                        Route::get('/job/{jobId}/edit', 'edit')
                                ->name('edit');        
                        Route::post('/job/{jobId}/edit', 'update')
                                ->name('update');   
                        Route::post('/job/{jobId}/delete', 'delete')
                                ->name('delete');
                });   
        });
      
        
        Route::get('/user/jobs/created', [RecruiterController::class, 'showCreatedJobs'])
                ->name('user-created-jobs.show');

        /* Favorite job */

        Route::controller(FavoriteJobController::class)->group(function (){
                Route::get('/user/favorited_jobs', 'index')
                        ->name('user-favorited-jobs.show');
                Route::post('/user/jobs/favorited/add','addFavorite')
                        ->name('user-favorited-jobs.add');
                Route::post('/user/jobs/favorited/remove', 'removeFavorite')
                        ->name('user-favorited-jobs.remove');
        });

        
        Route::controller(userController::class)->group(function (){

                /* User account */

                Route::get('/user/account', 'showAccount')
                        ->name('user-account');
                Route::post('/user/account', 'handleAccountInfoChange')
                        ->name('user-account.update');

                /* Apply to job */

                Route::get('/jobs/{id}/apply', 'applyToJob')
                        ->name('job.apply');
                Route::post('/job/apply', 'applyToJobAjax');
        });
     
});


Route::controller(JobController::class)->group(function() {
        Route::get('/', 'index')
                ->name('home');
        Route::get('/jobs/{id}', 'show')
                ->name('job.show');
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





