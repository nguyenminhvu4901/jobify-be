<?php

use App\Enums\RouteNames\Company\BusinessSector;
use App\Enums\RouteNames\Company\CompanyBenefit;
use App\Enums\RouteNames\Company\CompanyBranch;
use App\Enums\RouteNames\Company\CompanyProfile;
use App\Enums\RouteNames\Company\CompanyScale;
use App\Enums\RouteNames\Company\OperationType;
use App\Enums\RouteNames\Company\CompanyWorkingDay;
use App\Http\Controllers\API\Company\BusinessSectorController;
use App\Http\Controllers\API\Company\CompanyBenefitController;
use App\Http\Controllers\API\Company\CompanyBranchController;
use App\Http\Controllers\API\Company\CompanyController;
use App\Http\Controllers\API\Company\CompanyScaleController;
use App\Http\Controllers\API\Company\OperationTypeController;
use App\Http\Controllers\API\Company\CompanyWorkingDayController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => ['api', 'auth', 'throttle:rateLimit'],
        'prefix' => 'company',
        'as' => 'company.'
    ],
    function () {
        Route::group(['prefix' => 'operation-type', 'as' => 'operationType.'], function() {
            Route::get('/list-all-operation-type', [
                OperationTypeController::class, 'getListAllOperationType'
            ])->name(OperationType::LIST_ALL_OPERATION_TYPE->value);

        });

        Route::group(['prefix' => 'business-sector', 'as' => 'businessSector.'], function() {
            Route::get('/list-all-business-sector', [
                BusinessSectorController::class, 'getListAllBusinessSector'
            ])->name(BusinessSector::LIST_ALL_BUSINESS_SECTOR->value);

        });

        Route::group(['prefix' => 'company-working-day', 'as' => 'companyWorkingDay.'], function() {
            Route::get('/list-all-company-working-day', [
                CompanyWorkingDayController::class, 'getListAllWorkingDay'
            ])->name(CompanyWorkingDay::LIST_ALL_WORKING_DAY->value);

        });

        Route::group(['prefix' => 'company-scale', 'as' => 'companyScale.'], function() {
            Route::get('/list-all-company-scale', [
                CompanyScaleController::class, 'getListAllCompanyScale'
            ])->name(CompanyScale::LIST_ALL_COMPANY_SCALE->value);
        });

        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function() {
            Route::get('/detail-profile-company-current-user', [
                CompanyController::class, 'getDetailProfileCompanyCurrentUser'
            ])->name(CompanyProfile::DETAIL_COMPANY_PROFILE_CURRENT_USER->value);

            Route::put('/update-company-profile', [
                CompanyController::class, 'updateCompanyProfile'
            ])->name(CompanyProfile::UPDATE_COMPANY_PROFILE->value);

            Route::post('/update-company-avatar', [
                CompanyController::class, 'updateCompanyAvatar'
            ])->name(CompanyProfile::UPDATE_COMPANY_AVATAR->value);

            Route::group(['prefix' => 'company-branch', 'as' => 'companyBranch.'], function () {
                Route::get('/list-company-branch', [
                    CompanyBranchController::class, 'getListCompanyBranch'
                ])->name(CompanyBranch::LIST_COMPANY_BRANCH->value);

                Route::post('/store-company-branch', [
                    CompanyBranchController::class, 'storeCompanyBranch'
                ])->name(CompanyBranch::STORE_COMPANY_BRANCH->value);

                Route::put('/update-company-branch', [
                    CompanyBranchController::class, 'updateCompanyBranch'
                ])->name(CompanyBranch::UPDATE_COMPANY_BRANCH->value);

                Route::delete('/destroy-company-branch', [
                    CompanyBranchController::class, 'destroyCompanyBranch'
                ])->name(CompanyBranch::DESTROY_COMPANY_BRANCH->value);
            });

            Route::group(['prefix' => 'company-benefit', 'as' => 'companyBenefit.'], function (){
                Route::get('/list-company-benefit', [
                    CompanyBenefitController::class, 'getListCompanyBenefit'
                ])->name(CompanyBenefit::LIST_COMPANY_BENEFIT->value);
            });
        });
    }
);
