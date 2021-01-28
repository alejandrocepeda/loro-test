<?php

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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::group(['prefix' => 'v1'], function() {

    //Customers resource controller
    Route::resource('customers', 'Api\Customer\CustomerController');
    Route::resource('customers-random-winner', 'Api\Customer\CustomerRandonWinnerController');
    Route::resource('customer-send-notification', 'Api\Customer\SendNotificationWinnerController');

    //Cities resource controller
    Route::resource('cities', 'Api\City\CityController');

    //States resource controller
    Route::resource('states', 'Api\State\StateController');
});
