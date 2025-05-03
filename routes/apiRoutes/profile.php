<?php

use App\Enums\RouteNames\Profile\UserActivityEnum;
use App\Enums\RouteNames\Profile\UserCertificationEnum;
use App\Enums\RouteNames\Profile\UserCourseEnum;
use App\Enums\RouteNames\Profile\UserEducationEnum;
use App\Enums\RouteNames\Profile\UserExperienceEnum;
use App\Enums\RouteNames\Profile\UserLocationEnum;
use App\Enums\RouteNames\Profile\UserPrizeEnum;
use App\Enums\RouteNames\Profile\UserProductEnum;
use App\Enums\RouteNames\Profile\UserProfileEnum;
use App\Enums\RouteNames\Profile\UserProjectEnum;
use App\Enums\RouteNames\Profile\UserSkillEnum;
use App\Http\Controllers\API\Profile\PersonalInfoController;
use App\Http\Controllers\API\Profile\UserActivityController;
use App\Http\Controllers\API\Profile\UserCertificationController;
use App\Http\Controllers\API\Profile\UserCourseController;
use App\Http\Controllers\API\Profile\UserEducationController;
use App\Http\Controllers\API\Profile\UserExperienceController;
use App\Http\Controllers\API\Profile\UserLocationController;
use App\Http\Controllers\API\Profile\UserPrizeController;
use App\Http\Controllers\API\Profile\UserProductController;
use App\Http\Controllers\API\Profile\UserProjectController;
use App\Http\Controllers\API\Profile\UserSkillController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => ['api', 'auth', 'throttle:rateLimit'],
        'prefix' => 'profile',
        'as' => 'profile.',
    ],
    function () {
        Route::get('/current-user', [PersonalInfoController::class, 'getInformationCurrentUser'])
            ->name(UserProfileEnum::INFORMATION_CURRENT_USER->value);

        Route::get('/information-cv-current-user', [PersonalInfoController::class, 'getInformationCVCurrentUser'])
            ->name(UserProfileEnum::INFORMATION_CV_CURRENT_USER->value);

        Route::post('update-personal-info', [PersonalInfoController::class, 'updateProfile'])
            ->name(UserProfileEnum::UPDATE_PROFILE->value);

        Route::post('upload-avatar', [PersonalInfoController::class, 'uploadAvatar'])
            ->name(UserProfileEnum::UPLOAD_AVATAR->value);

        Route::group(['prefix' => 'user-experience', 'as' => 'userExperience.'], function () {
            Route::post('/', [UserExperienceController::class, 'store'])
                ->name(UserExperienceEnum::STORE->value);

            Route::get('/list-experience-current-user', [UserExperienceController::class,
                'getListExperienceCurrentUser'])->name(UserExperienceEnum::LIST_EXPERIENCE_CURRENT_USER->value);

            Route::get('/complete-list-user-experience', [UserExperienceController::class,
                'getCompleteListOfUserExperience'])->name(UserExperienceEnum::COMPLETE_LIST_USER_EXPERIENCE->value);

            Route::get('/detail-list-user-experience', [UserExperienceController::class,
                'getDetailListOfUserExperience'])->name(UserExperienceEnum::DETAIL_LIST_USER_EXPERIENCE->value);

            Route::get('/detail-list-user-experience-by-user-slug', [UserExperienceController::class,
                'getDetailListOfUserExperienceByUserSlug'])
                ->name(UserExperienceEnum::DETAIL_LIST_USER_EXPERIENCE_BY_USER_SLUG->value);

            Route::post('/update-experience', [UserExperienceController::class, 'update'])
                ->name(UserExperienceEnum::UPDATE->value);

            Route::delete('/', [UserExperienceController::class, 'destroy'])
                ->name(UserExperienceEnum::DESTROY->value);
        });

        Route::group(['prefix' => 'user-certification', 'as' => 'userCertification.'], function () {
            Route::get('/list-certification-current-user', [UserCertificationController::class,
                'getListCertificationCurrentUser'])
                ->name(UserCertificationEnum::LIST_CERTIFICATION_CURRENT_USER->value);

            Route::post('/', [UserCertificationController::class, 'store'])
                ->name(UserCertificationEnum::STORE->value);

            Route::get('/complete-list-user-certification', [UserCertificationController::class,
                'getCompleteListOfUserCertification'])
                ->name(UserCertificationEnum::COMPLETE_LIST_USER_CERTIFICATION->value);

            Route::get('/detail-list-user-certification', [UserCertificationController::class,
                'getDetailListOfUserCertification'])
                ->name(UserCertificationEnum::DETAIL_LIST_USER_CERTIFICATION->value);

            Route::get('/detail-list-user-certification-by-user-slug', [UserCertificationController::class,
                'getDetailListOfUserCertificationByUserSlug'])
                ->name(UserCertificationEnum::DETAIL_LIST_USER_CERTIFICATION_BY_USER_SLUG->value);

            Route::post('/update-certification', [UserCertificationController::class, 'update'])
                ->name(UserCertificationEnum::UPDATE->value);

            Route::delete('/', [UserCertificationController::class, 'destroy'])
                ->name(UserCertificationEnum::DESTROY->value);
        });

        Route::group(['prefix' => 'user-education', 'as' => 'userEducation.'], function () {
            Route::get('/list-education-current-user', [UserEducationController::class,
                'getListEducationCurrentUser'])->name(UserEducationEnum::LIST_EDUCATION_CURRENT_USER->value);

            Route::post('/', [UserEducationController::class, 'store'])
                ->name(UserEducationEnum::STORE->value);

            Route::get('/complete-list-user-education', [UserEducationController::class,
                'getCompleteListOfUserEducation'])
                ->name(UserEducationEnum::COMPLETE_LIST_USER_EDUCATION->value);

            Route::get('/detail-list-user-education', [UserEducationController::class,
                'getDetailListOfUserEducation'])
                ->name(UserEducationEnum::DETAIL_LIST_USER_EDUCATION->value);

            Route::get('/detail-list-user-education-by-user-slug', [UserEducationController::class,
                'getDetailListOfUserEducationByUserSlug'])
                ->name(UserEducationEnum::DETAIL_LIST_USER_EDUCATION_BY_USER_SLUG->value);

            Route::put('/', [UserEducationController::class, 'update'])
                ->name(UserEducationEnum::UPDATE->value);

            Route::delete('/', [UserEducationController::class, 'destroy'])
                ->name(UserEducationEnum::DESTROY->value);
        });

        Route::group(['prefix' => 'user-skill', 'as' => 'userSkill.'], function () {
            Route::get('/list-skill-current-user', [UserSkillController::class,
                'getListSkillCurrentUser'])
                ->name(UserSkillEnum::LIST_SKILL_CURRENT_USER->value);

            Route::post('/', [UserSkillController::class, 'store'])
                ->name(UserSkillEnum::STORE->value);

            Route::get('/complete-list-user-skill', [UserSkillController::class,
                'getCompleteListOfUserSkill'])
                ->name(UserSkillEnum::COMPLETE_LIST_USER_SKILL->value);

            Route::get('/detail-list-user-skill', [UserSkillController::class,
                'getDetailListOfUserSkill'])
                ->name(UserSkillEnum::DETAIL_LIST_USER_SKILL->value);

            Route::get('/detail-list-user-skill-by-user-slug', [UserSkillController::class,
                'getDetailListOfUserSkillByUserSlug'])
                ->name(UserSkillEnum::DETAIL_LIST_USER_SKILL_BY_USER_SLUG->value);

            Route::put('/', [UserSkillController::class, 'update'])
                ->name(UserSkillEnum::UPDATE->value);

            Route::delete('/', [UserSkillController::class, 'destroy'])
                ->name(UserSkillEnum::DESTROY->value);
        });

        Route::group(['prefix' => 'user-course', 'as' => 'userCourse.'], function () {
            Route::get('/list-course-current-user', [UserCourseController::class,
                'getListCourseCurrentUser'])->name(UserCourseEnum::LIST_COURSE_CURRENT_USER->value);

            Route::get('/complete-list-user-course', [UserCourseController::class,
                'getCompleteListOfUserCourse'])->name(UserCourseEnum::COMPLETE_LIST_USER_COURSE->value);

            Route::get('/detail-list-user-course', [UserCourseController::class,
                'getDetailListOfUserCourse'])->name(UserCourseEnum::DETAIL_LIST_USER_COURSE->value);

            Route::get('/detail-list-user-course-by-user-slug', [UserCourseController::class,
                'getDetailListOfUserCourseByUserSlug'])->name(UserCourseEnum::DETAIL_LIST_USER_COURSE_BY_USER_SLUG->value);

            Route::post('/', [UserCourseController::class, 'store'])->name(UserCourseEnum::STORE->value);

            Route::post('/update-course', [UserCourseController::class, 'update'])
                ->name(UserCourseEnum::UPDATE->value);

            Route::delete('/', [UserCourseController::class, 'destroy'])->name(UserCourseEnum::DESTROY->value);
        });

        Route::group(['prefix' => 'user-project', 'as' => 'userProject.'], function () {
            Route::get('/list-project-current-user', [UserProjectController::class,
                'getListProjectCurrentUser'])
                ->name(UserProjectEnum::LIST_PROJECT_CURRENT_USER->value);

            Route::get('/complete-list-user-project', [UserProjectController::class,
                'getCompleteListOfUserProject'])
                ->name(UserProjectEnum::COMPLETE_LIST_USER_PROJECT->value);

            Route::get('/detail-list-user-project', [UserProjectController::class,
                'getDetailListOfUserProject'])
                ->name(UserProjectEnum::DETAIL_LIST_USER_PROJECT->value);

            Route::get('/detail-list-user-project-by-user-slug', [UserProjectController::class,
                'getDetailListOfUserProjectByUserSlug'])
                ->name(UserProjectEnum::DETAIL_LIST_USER_PROJECT_BY_USER_SLUG->value);

            Route::post('/', [UserProjectController::class, 'store'])
                ->name(UserProjectEnum::STORE->value);

            Route::post('/update-project', [UserProjectController::class, 'update'])
                ->name(UserProjectEnum::UPDATE->value);

            Route::delete('/', [UserProjectController::class, 'destroy'])
                ->name(UserProjectEnum::DESTROY->value);
        });

        Route::group(['prefix' => 'user-prize', 'as' => 'userPrize.'], function () {
            Route::get('/list-prize-current-user', [UserPrizeController::class,
                'getListPrizeCurrentUser'])
                ->name(UserPrizeEnum::LIST_PRIZE_CURRENT_USER->value);

            Route::get('/complete-list-user-prize', [UserPrizeController::class,
                'getCompleteListOfUserPrize'])
                ->name(UserPrizeEnum::COMPLETE_LIST_USER_PRIZE->value);

            Route::get('/detail-list-user-prize', [UserPrizeController::class,
                'getDetailListOfUserPrize'])
                ->name(UserPrizeEnum::DETAIL_LIST_USER_PRIZE->value);

            Route::get('/detail-list-user-prize-by-user-slug', [UserPrizeController::class,
                'getDetailListOfUserPrizeByUserSlug'])
                ->name(UserPrizeEnum::DETAIL_LIST_USER_PRIZE_BY_USER_SLUG->value);

            Route::post('/', [UserPrizeController::class, 'store'])
                ->name(UserPrizeEnum::STORE->value);

            Route::post('/update-prize', [UserPrizeController::class, 'update'])
                ->name(UserPrizeEnum::UPDATE->value);

            Route::delete('/', [UserPrizeController::class, 'destroy'])
                ->name(UserPrizeEnum::DESTROY->value);
        });

        Route::group(['prefix' => 'user-product', 'as' => 'userProduct.'], function () {
            Route::get('/list-product-current-user', [UserProductController::class,
                'getListProductCurrentUser'])
                ->name(UserProductEnum::LIST_PRODUCT_CURRENT_USER->value);

            Route::get('/complete-list-user-product', [UserProductController::class,
                'getCompleteListOfUserProduct'])
                ->name(UserProductEnum::COMPLETE_LIST_USER_PRODUCT->value);

            Route::get('/detail-list-user-product', [UserProductController::class,
                'getDetailListOfUserProduct'])
                ->name(UserProductEnum::DETAIL_LIST_USER_PRODUCT->value);

            Route::get('/detail-list-user-product-by-user-slug', [UserProductController::class,
                'getDetailListOfUserProductByUserSlug'])
                ->name(UserProductEnum::DETAIL_LIST_USER_PRODUCT_BY_USER_SLUG->value);

            Route::post('/', [UserProductController::class, 'store'])
                ->name(UserProductEnum::STORE->value);

            Route::post('/update-product', [UserProductController::class, 'update'])
                ->name(UserProductEnum::UPDATE->value);

            Route::delete('/', [UserProductController::class, 'destroy'])
                ->name(UserProductEnum::DESTROY->value);
        });

        Route::group(['prefix' => 'user-activity', 'as' => 'userActivity.'], function () {

            Route::get('/list-activity-current-user', [UserActivityController::class,
                'getListActivityCurrentUser'])
                ->name(UserActivityEnum::LIST_ACTIVITY_CURRENT_USER->value);

            Route::get('/complete-list-user-activity', [UserActivityController::class,
                'getCompleteListOfUserActivity'])
                ->name(UserActivityEnum::COMPLETE_LIST_USER_ACTIVITY->value);

            Route::get('/detail-list-user-activity', [UserActivityController::class,
                'getDetailListOfUserActivity'])
                ->name(UserActivityEnum::DETAIL_LIST_USER_ACTIVITY->value);

            Route::get('/detail-list-user-activity-by-user-slug', [UserActivityController::class,
                'getDetailListOfUserActivityByUserSlug'])
                ->name(UserActivityEnum::DETAIL_LIST_USER_ACTIVITY_BY_USER_SLUG->value);

            Route::post('/', [UserActivityController::class, 'store'])
                ->name(UserActivityEnum::STORE->value);

            Route::post('/update-activity', [UserActivityController::class, 'update'])
                ->name(UserActivityEnum::UPDATE->value);

            Route::delete('/', [UserActivityController::class, 'destroy'])
                ->name(UserActivityEnum::DESTROY->value);
        });

        Route::group(['prefix' => 'user-location', 'as' => 'userLocation.'], function () {
            Route::get('/list-location-current-user', [UserLocationController::class,
                'getListLocationCurrentUser'])
                ->name(UserLocationEnum::LIST_LOCATION_CURRENT_USER->value);

            Route::get('/complete-list-user-location', [UserLocationController::class,
                'getCompleteListOfUserLocation'])
                ->name(UserLocationEnum::COMPLETE_LIST_USER_LOCATION->value);

            Route::get('/detail-list-user-location', [UserLocationController::class,
                'getDetailListOfUserLocation'])
                ->name(UserLocationEnum::DETAIL_LIST_USER_LOCATION->value);

            Route::get('/detail-list-user-location-by-user-slug', [UserLocationController::class,
                'getDetailListOfUserLocationByUserSlug'])
                ->name(UserLocationEnum::DETAIL_LIST_USER_LOCATION_BY_USER_SLUG->value);

            Route::post('/', [UserLocationController::class, 'store'])
                ->name(UserLocationEnum::STORE->value);

            Route::put('/update-location', [UserLocationController::class, 'update'])
                ->name(UserLocationEnum::UPDATE->value);

            Route::delete('/', [UserLocationController::class, 'destroy'])
                ->name(UserLocationEnum::DESTROY->value);
        });
    }
);
