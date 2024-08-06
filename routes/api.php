<?php

use App\Http\Controllers\API\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['middleware' => 'api'], function () {
    Route::group(['prefix' => 'auth'], function ()
    {
        Route::post('/login', [AuthController::class, 'login']);
    });
});
