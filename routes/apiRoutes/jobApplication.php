<?php

use App\Enums\RouteNames\JobApplicationSeries\ApplicationStatusEnum;
use App\Enums\RouteNames\JobApplicationSeries\JobApplicationEnum;
use App\Http\Controllers\API\JobApplicationSeries\ApplicationStatusController;
use App\Http\Controllers\API\JobApplicationSeries\JobApplicationController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => ['api', 'auth', 'throttle:rateLimit'],
        'prefix' => 'apply-job',
        'as' => 'applyJob.'
    ], function () {
        Route::group(['prefix' => 'job-application', 'as' => 'jobApplication.'], function () {
            Route::get('/detail-job-application-by-job-seeker', [
                JobApplicationController::class, 'getDetailJobApplicationJobSeeker'
            ])->name(JobApplicationEnum::DETAIL_JOB_APPLICATION_JOB_SEEKER->value);

            Route::get('/list-job-application-by-job-seeker', [
                JobApplicationController::class, 'getListJobApplicationByJobSeeker'
            ])->name(JobApplicationEnum::LIST_JOB_APPLICATION_JOB_SEEKER->value);

            Route::get('/list-job-seeker-apply-job', [
                JobApplicationController::class, 'getListJobSeekerApplyJob'
            ])->name(JobApplicationEnum::LIST_JOB_SEEKER_APPLY_JOB->value);

            Route::post('/store-job-seeker-apply-job', [
                JobApplicationController::class, 'storeJobSeekerApplyJob'
            ])->name(JobApplicationEnum::STORE_JOB_SEEKER_APPLY_JOB->value);

            Route::post('/store-job-seeker-apply-job', [
                JobApplicationController::class, 'storeJobSeekerApplyJob'
            ])->name(JobApplicationEnum::STORE_JOB_SEEKER_APPLY_JOB->value);

            Route::patch('/update-job-application-status', [
                JobApplicationController::class, 'updateJobApplicationStatus'
            ])->name(ApplicationStatusEnum::UPDATE_JOB_APPLICATION_STATUS->value);
        });

    Route::group(['prefix' => 'application-status', 'as' => 'applicationStatus.'], function () {
        Route::get('/list-application-status', [
            ApplicationStatusController::class, 'getListApplicationStatuses'
        ])->name(ApplicationStatusEnum::LIST_APPLICATION_STATUS->value);
    });
    }
);
