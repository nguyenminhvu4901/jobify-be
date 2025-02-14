<?php

use App\Http\Controllers\API\Profile\PersonalInfoController;
use App\Http\Controllers\API\Profile\UserCertificationController;
use App\Http\Controllers\API\Profile\UserEducationController;
use App\Http\Controllers\API\Profile\UserExperienceController;
use App\Http\Controllers\API\Profile\UserSkillController;
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
                'getDetailListOfUserExperience'])->name('detailListOfUserExperience');

            Route::get('/detail-list-user-experience-by-user-slug', [UserExperienceController::class,
                'getDetailListOfUserExperienceByUserSlug'])->name('detailListOfUserExperienceByUserSlug');

            Route::post('/update-experience', [UserExperienceController::class, 'update'])
                ->name('updateExperience');

            Route::delete('/', [UserExperienceController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'user-certification', 'as' => 'userCertification.'], function (){
            Route::get('/list-certification-current-user', [UserCertificationController::class,
                'getListCertificationCurrentUser']);

            Route::post('/', [UserCertificationController::class, 'store'])->name('store');

            Route::get('/complete-list-user-certification', [UserCertificationController::class,
                'getCompleteListOfUserCertification']);

            Route::get('/detail-list-user-certification', [UserCertificationController::class,
                'getDetailListOfUserCertification'])->name('detailListOfUserCertification');

            Route::get('/detail-list-user-certification-by-user-slug', [UserCertificationController::class,
                'getDetailListOfUserCertificationByUserSlug'])->name('detailListOfUserCertificationByUserSlug');

            Route::post('/update-certification', [UserCertificationController::class, 'update'])
                ->name('updateCertification');

            Route::delete('/', [UserCertificationController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'user-education', 'as' => 'userEducation.'], function() {
            Route::get('/list-education-current-user', [UserEducationController::class,
                'getListEducationCurrentUser'])->name('listEducationCurrentUser');

            Route::post('/', [UserEducationController::class, 'store'])->name('store');

            Route::get('/complete-list-user-education', [UserEducationController::class,
                'getCompleteListOfUserEducation']);

            Route::get('/detail-list-user-education', [UserEducationController::class,
                'getDetailListOfUserEducation'])->name('detailListOfUserEducation');

            Route::get('/detail-list-user-education-by-user-slug', [UserEducationController::class,
                'getDetailListOfUserEducationByUserSlug'])->name('detailListOfUserEducationByUserSlug');

            Route::put('/', [UserEducationController::class, 'update'])->name('updateEducation');

            Route::delete('/', [UserEducationController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'user-skill', 'as' => 'userSkill.'], function() {
            Route::get('/list-skill-current-user', [UserSkillController::class,
                'getListSkillCurrentUser'])->name('listSkillCurrentUser');

           Route::post('/', [UserSkillController::class, 'store'])->name('store');

            Route::get('/complete-list-user-skill', [UserSkillController::class,
                'getCompleteListOfUserSkill'])->name('completeListOfUserSkill');

            Route::get('/detail-list-user-skill', [UserSkillController::class,
                'getDetailListOfUserSkill'])->name('detailListOfUserSkill');

            Route::get('/detail-list-user-skill-by-user-slug', [UserSkillController::class,
                'getDetailListOfUserSkillByUserSlug'])->name('detailListOfUserSkillByUserSlug');

            Route::put('/', [UserSkillController::class, 'update'])->name('updateSkill');

            Route::delete('/', [UserSkillController::class, 'destroy'])->name('destroy');
        });
});
