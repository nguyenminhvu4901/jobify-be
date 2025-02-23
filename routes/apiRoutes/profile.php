<?php

use App\Http\Controllers\API\Profile\PersonalInfoController;
use App\Http\Controllers\API\Profile\UserActivityController;
use App\Http\Controllers\API\Profile\UserCertificationController;
use App\Http\Controllers\API\Profile\UserCourseController;
use App\Http\Controllers\API\Profile\UserEducationController;
use App\Http\Controllers\API\Profile\UserExperienceController;
use App\Http\Controllers\API\Profile\UserPrizeController;
use App\Http\Controllers\API\Profile\UserProductController;
use App\Http\Controllers\API\Profile\UserProjectController;
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

        Route::group(['prefix' => 'user-course', 'as' => 'userCourse.'], function () {
            Route::get('/list-course-current-user', [UserCourseController::class,
                'getListCourseCurrentUser'])->name('listCourseCurrentUser');

            Route::get('/complete-list-user-course', [UserCourseController::class,
                'getCompleteListOfUserCourse'])->name('completeListOfUserCourse');

            Route::get('/detail-list-user-course', [UserCourseController::class,
                'getDetailListOfUserCourse'])->name('detailListOfUserCourse');

            Route::get('/detail-list-user-course-by-user-slug', [UserCourseController::class,
                'getDetailListOfUserCourseByUserSlug'])->name('detailListOfUserCourseByUserSlug');

            Route::post('/', [UserCourseController::class, 'store'])->name('store');

            Route::post('/update-course', [UserCourseController::class, 'update'])
                ->name('updateCourse');

            Route::delete('/', [UserCourseController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'user-project', 'as' => 'userProject.'], function() {
            Route::get('/list-project-current-user', [UserProjectController::class,
                'getListProjectCurrentUser'])->name('listProjectCurrentUser');

            Route::get('/complete-list-user-project', [UserProjectController::class,
                'getCompleteListOfUserProject'])->name('completeListOfUserProject');

            Route::get('/detail-list-user-project', [UserProjectController::class,
                'getDetailListOfUserProject'])->name('detailListOfUserProject');

            Route::get('/detail-list-user-project-by-user-slug', [UserProjectController::class,
                'getDetailListOfUserProjectByUserSlug'])->name('detailListOfUserProjectByUserSlug');

            Route::post('/', [UserProjectController::class, 'store'])->name('store');

            Route::post('/update-project', [UserProjectController::class, 'update'])
                ->name('updateProject');

            Route::delete('/', [UserProjectController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'user-prize', 'as' => 'userPrize.'], function() {
            Route::get('/list-prize-current-user', [UserPrizeController::class,
                'getListPrizeCurrentUser'])->name('listPrizeCurrentUser');

            Route::get('/complete-list-user-prize', [UserPrizeController::class,
                'getCompleteListOfUserPrize'])->name('completeListOfUserPrize');

            Route::get('/detail-list-user-prize', [UserPrizeController::class,
                'getDetailListOfUserPrize'])->name('detailListOfUserPrize');

            Route::get('/detail-list-user-prize-by-user-slug', [UserPrizeController::class,
                'getDetailListOfUserPrizeByUserSlug'])->name('detailListOfUserPrizeByUserSlug');

            Route::post('/', [UserPrizeController::class, 'store'])->name('store');

            Route::post('/update-prize', [UserPrizeController::class, 'update'])
                ->name('updatePrize');

            Route::delete('/', [UserPrizeController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'user-product', 'as' => 'userProduct.'], function() {
            Route::get('/list-product-current-user', [UserProductController::class,
                'getListProductCurrentUser'])->name('listProductCurrentUser');

            Route::get('/complete-list-user-product', [UserProductController::class,
                'getCompleteListOfUserProduct'])->name('completeListOfUserProduct');

            Route::get('/detail-list-user-product', [UserProductController::class,
                'getDetailListOfUserProduct'])->name('detailListOfUserProduct');

            Route::get('/detail-list-user-product-by-user-slug', [UserProductController::class,
                'getDetailListOfUserProductByUserSlug'])->name('detailListOfUserProductByUserSlug');

            Route::post('/', [UserProductController::class, 'store'])->name('store');

            Route::post('/update-product', [UserProductController::class, 'update'])
                ->name('updateProduct');

            Route::delete('/', [UserProductController::class, 'destroy'])->name('destroy');
        });

    Route::group(['prefix' => 'user-activity', 'as' => 'userActivity.'], function() {
        Route::get('/list-activity-current-user', [UserActivityController::class,
            'getListActivityCurrentUser'])->name('listActivityCurrentUser');

        Route::get('/complete-list-user-activity', [UserActivityController::class,
            'getCompleteListOfUserActivity'])->name('completeListOfUserActivity');

        Route::get('/detail-list-user-activity', [UserActivityController::class,
            'getDetailListOfUserActivity'])->name('detailListOfUserActivity');

        Route::get('/detail-list-user-activity-by-user-slug', [UserActivityController::class,
            'getDetailListOfUserActivityByUserSlug'])->name('detailListOfUserActivityByUserSlug');

        Route::post('/', [UserActivityController::class, 'store'])->name('store');

        Route::post('/update-activity', [UserActivityController::class, 'update'])
            ->name('updateActivity');

        Route::delete('/', [UserActivityController::class, 'destroy'])->name('destroy');
    });
});
