<?php

use App\Http\Controllers\API\Profile\PersonalInfoController;
use App\Http\Controllers\API\Profile\UserCertificationController;
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

        Route::group(['prefix' => 'user-experience', 'as' => 'userExperience.'], function() {
            Route::post('/', [UserExperienceController::class, 'store'])->name('store');

            Route::get('/list-experience-current-user', [UserExperienceController::class,
                'getListExperienceCurrentUser']);

            Route::get('/complete-list-user-experience', [UserExperienceController::class,
                'getCompleteListOfUserExperience']);

            Route::get('/detail-list-user-experience', [UserExperienceController::class,
                'getDetailListOfUserExperience'])->name('DetailListOfUserExperience');

            Route::get('/detail-list-user-experience-by-user-slug', [UserExperienceController::class,
                'getDetailListOfUserExperienceByUserSlug'])->name('DetailListOfUserExperienceByUserSlug');

            Route::post('/update-experience', [UserExperienceController::class, 'update'])
                ->name('updateExperience');

            Route::delete('/', [UserExperienceController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'user-certification', 'as' => 'userCertification.'], function (){
            Route::get('/list-certification-current-user', [UserCertificationController::class,
                'getListCertificationCurrentUser']);
        });
});
