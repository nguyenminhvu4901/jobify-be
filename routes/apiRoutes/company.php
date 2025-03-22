<?php

use App\Enums\RouteNames\Company\BusinessSector;
use App\Enums\RouteNames\Company\OperationType;
use App\Http\Controllers\API\Company\BusinessSectorController;
use App\Http\Controllers\API\Company\OperationTypeController;
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

    }
);
