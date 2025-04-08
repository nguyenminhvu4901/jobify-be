<?php

use App\Enums\RouteNames\JobSeries\JobAgeRangeEnum;
use App\Enums\RouteNames\JobSeries\JobLevelEnum;
use App\Enums\RouteNames\JobSeries\JobTypeEnum;
use App\Http\Controllers\API\JobSeries\JobAgeRangeController;
use App\Http\Controllers\API\JobSeries\JobLevelController;
use App\Http\Controllers\API\JobSeries\JobTypeController;
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
    }
);
