<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\userController;
use App\Http\Middleware\RedirectIfAuthenticated;
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

    /* Create job */
// Show
Route::get('/jobs/create', [JobController::class, 'showCreateJob'])
        ->name('new_job');
// Handle
Route::post('/jobs/create', [JobController::class, 'handleCreateJob']);

    /* user created jobs */
Route::get('/user/jobs/created', [userController::class, 'showCreatedJobs'])
        ->name('user_created_jobs');
// Delete user created job
Route::post('/user/jobs/created/delete', [userController::class, 'deleteJob']);

    /* user favorited jobs */
// Show
Route::get('/user/jobs/favorited', [userController::class, 'showFavoritedJobs'])
        ->name('user_favorited_jobs');
// Add
Route::post('/user/jobs/favorited/add', [userController::class, 'addFavoritedJob']);
// Delete
Route::post('/user/jobs/favorited/remove', [userController::class, 'removeFavoritedJob']);

/* Apply to job */
Route::get('/jobs/{id}/apply', [userController::class, 'applyToJob']);
Route::post('/job/apply', [userController::class, 'applyToJobAjax']);
});

// Job controller
Route::controller(JobController::class)->group(function() {

    /* Home page */ 
 Route::get('/', 'index')
        ->name('home');
 
    /* single job page */
// Show
Route::get('/jobs/{id}', 'show')
        ->name('show_job');
});



/*
-----------------------
|       User          |
-----------------------
*/

Route::controller(userController::class)->group(function () {

  /* Signup page */
// Show
Route::get('/signup','showSignup')
        ->name('signup');
// Handle
Route::post('/signup', 'handleSignup');

 /* Login page */
// Show
Route::get('/login', 'showLogin')
        ->name('login');
// Handle
Route::post('/login', 'handleLogin');

 /* Logout */
Route::get('/logout', 'logout')
        ->name('logout');

 /* User account */
// Show
Route::get('/user/account', 'showAccount')
        ->name('user_account');
// Handle
Route::post('/user/account', 'handleAccountInfoChange');

/* Send password reset */
// Show
Route::get('/forgot_password', 'showForgotPassword')
        ->name('forgot_password');
// Handle
Route::post('/forgot_password', 'handleForgotPassword');

/* Reset password */
// Show
Route::get('/reset_password', 'showResetPassword')
        ->name('password.reset');
// Handle
Route::post('/reset_password', 'handleResetPassword');

});

Route::get('/about', function () {
    return view('about');
})->name('about');







