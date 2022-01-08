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
Route::get('/settings', '\App\Http\Controllers\SettingsController@getAllSettings');

Route::middleware('auth:sanctum')->namespace('\App\Http\Controllers')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::put('/settings/{setting}', 'SettingsController@putSetting')->middleware('can:modify standard settings');
    Route::get('/users', 'UsersController@get')->middleware('can:modify users');
    Route::get('/users/{user}', 'UsersController@getUser')->middleware('can:modify users');
});
