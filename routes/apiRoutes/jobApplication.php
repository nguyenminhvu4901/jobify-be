<?php

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
    });
    }
);
