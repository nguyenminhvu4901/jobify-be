<?php

use App\Http\Controllers\API\Profile\PersonalInfoController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => ['api', 'auth'],
        'prefix' => 'profile',
        'as' => 'profile.'
    ], function () {
        Route::get('/', [PersonalInfoController::class, 'index'])->name('index');

        Route::get('/current-user', [PersonalInfoController::class, 'getCurrentUser']);

        Route::post('update-personal-info', [PersonalInfoController::class, 'updateProfile'])
            ->name('updateProfile');
        Route::post('upload-avatar', [PersonalInfoController::class, 'uploadAvatar'])
            ->name('uploadAvatar');

});
