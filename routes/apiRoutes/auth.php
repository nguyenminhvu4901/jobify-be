<?php

use App\Http\Controllers\API\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api', 'prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login')
        ->middleware('guest');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')
        ->middleware('auth');
    Route::post('/job-seeker-register', [AuthController::class, 'jobSeekerRegister'])
        ->name('job-seeker-register')->middleware('guest');
    Route::post('/recruiter-register', [AuthController::class, 'recruiterRegister'])
        ->name('recruiter-register')->middleware('guest');
    Route::get('/unauthorized', [AuthController::class, 'unauthorized'])->name('unauthorized');

    Route::patch('/change-password', [AuthController::class, 'changePassword'])
        ->name('changePassword')->middleware('auth');
});

