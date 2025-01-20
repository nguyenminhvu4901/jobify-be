<?php

use App\Http\Controllers\API\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api', 'prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login')
        ->middleware('guest');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')
        ->middleware('auth');
    Route::post('/job-seeker-register', [AuthController::class, 'jobSeekerRegister'])
        ->name('jobSeekerRegister')->middleware('guest');
    Route::post('/recruiter-register', [AuthController::class, 'recruiterRegister'])
        ->name('recruiterRegister')->middleware('guest');
    Route::get('/unauthorized', [AuthController::class, 'unauthorized'])->name('unauthorized');

    Route::patch('/change-password', [AuthController::class, 'changePassword'])
        ->name('changePassword')->middleware('auth');
});

Route::group(['middleware' => 'api'], function () {
    Route::post('/forgot-password', [AuthController::class, 'sendForgotPassword'])
        ->name('forgotPassword')->middleware('guest');

    Route::post('/reset-password', [AuthController::class, 'resetPassword'])
        ->name('password.reset');
});

