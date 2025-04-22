<?php

use App\Enums\RouteNames\JobSeries\CurrencyEnum;
use App\Enums\RouteNames\JobSeries\JobAgeRangeEnum;
use App\Enums\RouteNames\JobSeries\JobEducationLevelEnum;
use App\Enums\RouteNames\JobSeries\JobExperienceEnum;
use App\Enums\RouteNames\JobSeries\JobLevelEnum;
use App\Enums\RouteNames\JobSeries\JobListingEnum;
use App\Enums\RouteNames\JobSeries\JobModerationStatusEnum;
use App\Enums\RouteNames\JobSeries\JobSalaryTypeEnum;
use App\Enums\RouteNames\JobSeries\JobTypeEnum;
use App\Enums\RouteNames\JobSeries\JobVisibilityStatusEnum;
use App\Enums\RouteNames\JobSeries\PositionEnum;
use App\Http\Controllers\API\JobSeries\CurrencyController;
use App\Http\Controllers\API\JobSeries\JobAgeRangeController;
use App\Http\Controllers\API\JobSeries\JobEducationLevelController;
use App\Http\Controllers\API\JobSeries\JobExperienceController;
use App\Http\Controllers\API\JobSeries\JobLevelController;
use App\Http\Controllers\API\JobSeries\JobListingController;
use App\Http\Controllers\API\JobSeries\JobModerationStatusController;
use App\Http\Controllers\API\JobSeries\JobSalaryTypeController;
use App\Http\Controllers\API\JobSeries\JobTypeController;
use App\Http\Controllers\API\JobSeries\JobVisibilityStatusController;
use App\Http\Controllers\API\JobSeries\PositionController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => ['api', 'auth', 'throttle:rateLimit'],
        'prefix' => 'job',
        'as' => 'job.'
    ],
    function() {
        Route::group(['prefix' => 'job-age-range', 'as' => 'jobAgeRange.'], function () {
            Route::get('/list-all-job-age-range', [
                JobAgeRangeController::class, 'getListJobAgeRange'
            ])->name(JobAgeRangeEnum::LIST_ALL_JOB_AGE_RANGE->value);
        });

        Route::group(['prefix' => 'job-type', 'as' => 'jobType.'], function () {
            Route::get('/list-all-job-type', [
                JobTypeController::class, 'getListJobType'
            ])->name(JobTypeEnum::LIST_ALL_JOB_TYPE->value);
        });

        Route::group(['prefix' => 'job-level', 'as' => 'jobLevel.'], function () {
            Route::get('/list-all-job-level', [
                JobLevelController::class, 'getListJobLevel'
            ])->name(JobLevelEnum::LIST_ALL_JOB_LEVEL->value);
        });

        Route::group(['prefix' => 'job-experience', 'as' => 'jobExperience.'], function () {
            Route::get('/list-all-job-experience', [
                JobExperienceController::class, 'getListJobExperience'
            ])->name(JobExperienceEnum::LIST_ALL_JOB_EXPERIENCE->value);
        });

        Route::group(['prefix' => 'job-education-level', 'as' => 'jobEducationLevel.'], function () {
            Route::get('/list-all-job-education-level', [
                JobEducationLevelController::class, 'getListJobEducationLevel'
            ])->name(JobEducationLevelEnum::LIST_ALL_JOB_EDUCATION_LEVEL->value);
        });

        Route::group(['prefix' => 'position', 'as' => 'position.'], function () {
            Route::get('/list-all-position', [
                PositionController::class, 'getListPosition'
            ])->name(PositionEnum::LIST_ALL_POSITION->value);

            Route::get('/list-leaf-position', [
                PositionController::class, 'getListLeafPosition'
            ])->name(PositionEnum::LIST_LEAF_POSITION->value);
        });

        Route::group(['prefix' => 'currency', 'as' => 'currency.'], function () {
            Route::get('/list-all-currency', [
                CurrencyController::class, 'getListCurrency'
            ])->name(CurrencyEnum::LIST_ALL_CURRENCY->value);
        });

        Route::group(['prefix' => 'job-salary-type', 'as' => 'jobSalaryType.'], function () {
            Route::get('/list-all-job-salary-type', [
                JobSalaryTypeController::class, 'getListJobSalaryType'
            ])->name(JobSalaryTypeEnum::LIST_ALL_JOB_SALARY_TYPE->value);
        });

        Route::group(['prefix' => 'job-moderation-status', 'as' => 'jobModerationStatus.'], function () {
            Route::get('/list-all-job-moderation-status', [
                JobModerationStatusController::class, 'getListJobModerationStatus'
            ])->name(JobModerationStatusEnum::LIST_ALL_JOB_MODERATION_STATUS->value);
        });

        Route::group(['prefix' => 'job-visibility-status', 'as' => 'jobVisibilityStatus.'], function () {
            Route::get('/list-all-job-visibility-status', [
                JobVisibilityStatusController::class, 'getListJobVisibilityStatus'
            ])->name(JobVisibilityStatusEnum::LIST_ALL_JOB_VISIBILITY_STATUS->value);
        });

        Route::group(['prefix' => 'job-listing', 'as' => 'jobListing.'], function () {
            Route::get('/list-all-jobs', [
                JobListingController::class, 'getListAllJobs'
            ])->name(JobListingEnum::LIST_ALL_JOBS->value);

            Route::get('/list-all-job-by-company', [
                JobListingController::class, 'getListAllJobsByCompany'
            ])->name(JobListingEnum::LIST_ALL_JOBS_BY_COMPANY->value);

            Route::get('/detail-job', [
                JobListingController::class, 'getDetailJobByJobId'
            ])->name(JobListingEnum::DETAIL_JOB_BY_JOB_ID->value);

            Route::get('/suggested-jobs', [
                JobListingController::class, 'getSuggestedJob'
            ])->name(JobListingEnum::SUGGESTED_JOB->value);

            Route::post('/store-job', [
                JobListingController::class, 'storeJob'
            ])->name(JobListingEnum::STORE_JOB->value);
        });
    }
);
