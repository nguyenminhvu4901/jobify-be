<?php

use App\Enums\RouteNames\JobSeries\JobAgeRangeEnum;
use App\Http\Controllers\API\JobSeries\JobAgeRangeController;
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



    }
);
