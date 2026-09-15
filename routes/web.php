<?php

use App\Http\Controllers\ProfileController;                                                                          
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobListingController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/jobs', [JobListingController::class, 'index'])
    ->name('jobs.index');

Route::get('/jobs/{slug}', [JobListingController::class, 'show'])
    ->name('jobs.show');

Route::get('/jobs/{slug}/apply', [JobListingController::class, 'apply'])->name('jobs.apply'); 

Route::post('/jobs/{slug}/apply', [JobListingController::class,                                                    
 'storeApplication'])->name('jobs.store-application');  


/*
|--------------------------------------------------------------------------
| Guest routes
|--------------------------------------------------------------------------
| Only users who are NOT logged in can access these.
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.post');
});


/*
|--------------------------------------------------------------------------
| Authenticated routes
|--------------------------------------------------------------------------
| Only logged-in users can access these.
*/

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/post-job', [JobListingController::class, 'create'])
        ->name('post-job');

    Route::post('/post-job', [JobListingController::class, 'store'])
        ->name('post-job.store');

    // Edit Page (GET)
   Route::get('/jobs/{id}/edit', [JobListingController::class, 'edit'])
       ->name('jobs.edit');

    // Update Job (PUT - Spoofed)
   Route::put('/jobs/{id}', [JobListingController::class, 'update'])
       ->name('jobs.update');

    // Delete Job (DELETE - Spoofed)
   Route::delete('/jobs/{id}', [JobListingController::class, 'destroy'])
       ->name('jobs.destroy');

   Route::get('/dashboard', [DashboardController::class, 'index'])
       ->name('dashboard');

   Route::get('/applications/{id}', [JobListingController::class, 'showApplication'])
       ->name('applications.show');

   Route::patch('/applications/{id}/status', [JobListingController::class, 'updateStatus'])
       ->name('applications.update-status');
    
    Route::get('/my-applications', [JobListingController::class, 'myApplications'])               
    ->name('my-applications'); 
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');                              
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');  
});