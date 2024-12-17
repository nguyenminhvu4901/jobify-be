<?php

use App\Http\Controllers\API\Profile\PersonalInfoController;
use App\Http\Controllers\API\Profile\UserExperienceController;
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

        Route::group(['prefix' => 'user-experience', 'as' => 'user-experience.'], function() {
            Route::post('/', [UserExperienceController::class, 'store']);
            Route::get('/list-experience-current-user', [UserExperienceController::class,
                'getListExperienceCurrentUser']);

            Route::put('/{user_slug}/{user_experience}', [UserExperienceController::class, 'update']);
        });
});
