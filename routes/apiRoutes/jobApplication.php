<?php

use App\Enums\RouteNames\ApplyJob\ApplicationStatusEnum;
use App\Http\Controllers\API\JobApplicationSeries\ApplicationStatusController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => ['api', 'auth', 'throttle:rateLimit'],
        'prefix' => 'apply-job',
        'as' => 'applyJob.'
    ], function () {
        Route::group(['prefix' => 'job-application', 'as' => 'jobApplication.'], function () {

        });

    Route::group(['prefix' => 'application-status', 'as' => 'applicationStatus.'], function () {
        Route::get('/list-application-status', [
            ApplicationStatusController::class, 'getListApplicationStatuses'
        ])->name(ApplicationStatusEnum::LIST_APPLICATION_STATUS->value);
    });
    }
);
