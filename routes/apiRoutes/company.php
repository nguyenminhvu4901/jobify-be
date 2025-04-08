<?php

use App\Enums\RouteNames\Company\BusinessSectorEnum;
use App\Enums\RouteNames\Company\CompanyBenefitEnum;
use App\Enums\RouteNames\Company\CompanyBranchEnum;
use App\Enums\RouteNames\Company\CompanyProfileEnum;
use App\Enums\RouteNames\Company\CompanyScaleEnum;
use App\Enums\RouteNames\Company\OperationTypeEnum;
use App\Enums\RouteNames\Company\CompanyWorkingDayEnum;
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

        Route::get('/', function () {
            $a = \App\Entities\JobSeries\JobAgeRange\JobAgeRange::all();
            return response()->json(\App\Http\Resources\JobSeries\JobAgeRanges\JobAgeRangeResource::collection($a));
        });
        Route::group(['prefix' => 'operation-type', 'as' => 'operationType.'], function() {
            Route::get('/list-all-operation-type', [
                OperationTypeController::class, 'getListAllOperationType'
            ])->name(OperationTypeEnum::LIST_ALL_OPERATION_TYPE->value);

        });

        Route::group(['prefix' => 'business-sector', 'as' => 'businessSector.'], function() {
            Route::get('/list-all-business-sector', [
                BusinessSectorController::class, 'getListAllBusinessSector'
            ])->name(BusinessSectorEnum::LIST_ALL_BUSINESS_SECTOR->value);

        });

        Route::group(['prefix' => 'company-working-day', 'as' => 'companyWorkingDay.'], function() {
            Route::get('/list-all-company-working-day', [
                CompanyWorkingDayController::class, 'getListAllWorkingDay'
            ])->name(CompanyWorkingDayEnum::LIST_ALL_WORKING_DAY->value);

        });

        Route::group(['prefix' => 'company-scale', 'as' => 'companyScale.'], function() {
            Route::get('/list-all-company-scale', [
                CompanyScaleController::class, 'getListAllCompanyScale'
            ])->name(CompanyScaleEnum::LIST_ALL_COMPANY_SCALE->value);
        });

        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function() {
            Route::get('/detail-profile-company-current-user', [
                CompanyController::class, 'getDetailProfileCompanyCurrentUser'
            ])->name(CompanyProfileEnum::DETAIL_COMPANY_PROFILE_CURRENT_USER->value);

            Route::put('/update-company-profile', [
                CompanyController::class, 'updateCompanyProfile'
            ])->name(CompanyProfileEnum::UPDATE_COMPANY_PROFILE->value);

            Route::post('/update-company-avatar', [
                CompanyController::class, 'updateCompanyAvatar'
            ])->name(CompanyProfileEnum::UPDATE_COMPANY_AVATAR->value);

            Route::group(['prefix' => 'company-branch', 'as' => 'companyBranch.'], function () {
                Route::get('/list-company-branch', [
                    CompanyBranchController::class, 'getListCompanyBranch'
                ])->name(CompanyBranchEnum::LIST_COMPANY_BRANCH->value);

                Route::post('/store-company-branch', [
                    CompanyBranchController::class, 'storeCompanyBranch'
                ])->name(CompanyBranchEnum::STORE_COMPANY_BRANCH->value);

                Route::put('/update-company-branch', [
                    CompanyBranchController::class, 'updateCompanyBranch'
                ])->name(CompanyBranchEnum::UPDATE_COMPANY_BRANCH->value);

                Route::delete('/destroy-company-branch', [
                    CompanyBranchController::class, 'destroyCompanyBranch'
                ])->name(CompanyBranchEnum::DESTROY_COMPANY_BRANCH->value);
            });

            Route::group(['prefix' => 'company-benefit', 'as' => 'companyBenefit.'], function (){
                Route::get('/list-company-benefit', [
                    CompanyBenefitController::class, 'getListCompanyBenefit'
                ])->name(CompanyBenefitEnum::LIST_COMPANY_BENEFIT->value);

                Route::post('/store-company-benefit', [
                    CompanyBenefitController::class, 'storeCompanyBenefit'
                ])->name(CompanyBenefitEnum::STORE_COMPANY_BENEFIT->value);

                Route::put('/update-company-benefit', [
                    CompanyBenefitController::class, 'updateCompanyBenefit'
                ])->name(CompanyBenefitEnum::UPDATE_COMPANY_BENEFIT->value);

                Route::delete('/destroy-company-benefit', [
                    CompanyBenefitController::class, 'destroyCompanyBenefit'
                ])->name(CompanyBenefitEnum::DESTROY_COMPANY_BENEFIT->value);
            });
        });
    }
);
