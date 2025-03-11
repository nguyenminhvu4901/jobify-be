<?php

use App\Enums\RouteNames\Profile\UserActivity;
use App\Enums\RouteNames\Profile\UserCertification;
use App\Enums\RouteNames\Profile\UserCourse;
use App\Enums\RouteNames\Profile\UserEducation;
use App\Enums\RouteNames\Profile\UserExperience;
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
        'middleware' => ['api', 'auth', 'throttle:rateLimit'],
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
            Route::post('/', [UserExperienceController::class, 'store'])
                ->name(UserExperience::STORE);

            Route::get('/list-experience-current-user', [UserExperienceController::class,
                'getListExperienceCurrentUser'])->name(UserExperience::LIST_EXPERIENCE_CURRENT_USER->value);

            Route::get('/complete-list-user-experience', [UserExperienceController::class,
                'getCompleteListOfUserExperience'])->name(UserExperience::COMPLETE_LIST_USER_EXPERIENCE->value);

            Route::get('/detail-list-user-experience', [UserExperienceController::class,
                'getDetailListOfUserExperience'])->name(UserExperience::DETAIL_LIST_USER_EXPERIENCE->value);

            Route::get('/detail-list-user-experience-by-user-slug', [UserExperienceController::class,
                'getDetailListOfUserExperienceByUserSlug'])
                ->name(UserExperience::DETAIL_LIST_USER_EXPERIENCE_BY_USER_SLUG->value);

            Route::post('/update-experience', [UserExperienceController::class, 'update'])
                ->name(UserExperience::UPDATE->value);

            Route::delete('/', [UserExperienceController::class, 'destroy'])
                ->name(UserExperience::DESTROY->value);
        });

        Route::group(['prefix' => 'user-certification', 'as' => 'userCertification.'], function (){
            Route::get('/list-certification-current-user', [UserCertificationController::class,
                'getListCertificationCurrentUser'])
                ->name(UserCertification::LIST_CERTIFICATION_CURRENT_USER->value);

            Route::post('/', [UserCertificationController::class, 'store'])
                ->name(UserCertification::STORE->value);

            Route::get('/complete-list-user-certification', [UserCertificationController::class,
                'getCompleteListOfUserCertification'])
                ->name(UserCertification::COMPLETE_LIST_USER_CERTIFICATION->value);

            Route::get('/detail-list-user-certification', [UserCertificationController::class,
                'getDetailListOfUserCertification'])
                ->name(UserCertification::DETAIL_LIST_USER_CERTIFICATION->value);

            Route::get('/detail-list-user-certification-by-user-slug', [UserCertificationController::class,
                'getDetailListOfUserCertificationByUserSlug'])
                ->name(UserCertification::DETAIL_LIST_USER_CERTIFICATION_BY_USER_SLUG->value);

            Route::post('/update-certification', [UserCertificationController::class, 'update'])
                ->name(UserCertification::UPDATE->value);

            Route::delete('/', [UserCertificationController::class, 'destroy'])
                ->name(UserCertification::DESTROY->value);
        });

        Route::group(['prefix' => 'user-education', 'as' => 'userEducation.'], function() {
            Route::get('/list-education-current-user', [UserEducationController::class,
                'getListEducationCurrentUser'])->name(UserEducation::LIST_EDUCATION_CURRENT_USER->value);

            Route::post('/', [UserEducationController::class, 'store'])
                ->name(UserEducation::STORE->value);

            Route::get('/complete-list-user-education', [UserEducationController::class,
                'getCompleteListOfUserEducation'])
                ->name(UserEducation::COMPLETE_LIST_USER_EDUCATION->value);

            Route::get('/detail-list-user-education', [UserEducationController::class,
                'getDetailListOfUserEducation'])
                ->name(UserEducation::DETAIL_LIST_USER_EDUCATION->value);

            Route::get('/detail-list-user-education-by-user-slug', [UserEducationController::class,
                'getDetailListOfUserEducationByUserSlug'])
                ->name(UserEducation::DETAIL_LIST_USER_EDUCATION_BY_USER_SLUG->value);

            Route::put('/', [UserEducationController::class, 'update'])
                ->name(UserEducation::UPDATE->value);

            Route::delete('/', [UserEducationController::class, 'destroy'])
                ->name(UserEducation::DESTROY->value);
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

            Route::put('/', [UserSkillController::class, 'update'])->name('updateUserSkill');

            Route::delete('/', [UserSkillController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'user-course', 'as' => 'userCourse.'], function () {
            Route::get('/list-course-current-user', [UserCourseController::class,
                'getListCourseCurrentUser'])->name(UserCourse::LIST_COURSE_CURRENT_USER->value);

            Route::get('/complete-list-user-course', [UserCourseController::class,
                'getCompleteListOfUserCourse'])->name(UserCourse::COMPLETE_LIST_USER_COURSE->value);

            Route::get('/detail-list-user-course', [UserCourseController::class,
                'getDetailListOfUserCourse'])->name(UserCourse::DETAIL_LIST_USER_COURSE->value);

            Route::get('/detail-list-user-course-by-user-slug', [UserCourseController::class,
                'getDetailListOfUserCourseByUserSlug'])->name(UserCourse::DETAIL_LIST_USER_COURSE_BY_USER_SLUG->value);

            Route::post('/', [UserCourseController::class, 'store'])->name(UserCourse::STORE->value);

            Route::post('/update-course', [UserCourseController::class, 'update'])
                ->name(UserCourse::UPDATE->value);

            Route::delete('/', [UserCourseController::class, 'destroy'])->name(UserCourse::DESTROY->value);
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
                ->name('updateUserProject');

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
                ->name('updateUserPrize');

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
                ->name('updateUserProduct');

            Route::delete('/', [UserProductController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'user-activity', 'as' => 'userActivity.'], function() {

            Route::get('/list-activity-current-user', [UserActivityController::class,
                'getListActivityCurrentUser'])
                ->name(UserActivity::LIST_ACTIVITY_CURRENT_USER->value);

            Route::get('/complete-list-user-activity', [UserActivityController::class,
                'getCompleteListOfUserActivity'])
                ->name(UserActivity::COMPLETE_LIST_USER_ACTIVITY->value);

            Route::get('/detail-list-user-activity', [UserActivityController::class,
                'getDetailListOfUserActivity'])
                ->name(UserActivity::DETAIL_LIST_USER_ACTIVITY->value);

            Route::get('/detail-list-user-activity-by-user-slug', [UserActivityController::class,
                'getDetailListOfUserActivityByUserSlug'])
                ->name(UserActivity::DETAIL_LIST_USER_ACTIVITY_BY_USER_SLUG->value);

            Route::post('/', [UserActivityController::class, 'store'])
                ->name(UserActivity::STORE->value);

            Route::post('/update-activity', [UserActivityController::class, 'update'])
                ->name(UserActivity::UPDATE->value);

            Route::delete('/', [UserActivityController::class, 'destroy'])
                ->name(UserActivity::DESTROY->value);
        });
});
