<?php

use Fruitcake\Cors\HandleCors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(HandleCors::class)->group(function () {
    Route::post('login', 'AuthController@login');
    Route::post('rate_history', 'RateController@getPairHistory');
    Route::get('main_rates', 'RateController@getMainRates');
    Route::post('log_check', 'AuthController@isLoggedNow');
});

