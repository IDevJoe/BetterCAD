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
Route::get('/manifest', function () {
    return \App\Models\Setting::getManifest();
});
Route::post('/pusher-wh', '\App\Http\Controllers\PusherController@webhookIntake');

Route::middleware('auth:sanctum')->namespace('\App\Http\Controllers')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/healthcheck', function(Request $request) {
        return response(null, 204);
    });
    Route::put('/settings/{setting}', 'SettingsController@putSetting')->middleware('can:modify standard settings');
    Route::prefix('/users')->middleware('can:modify users')->group(function () {
        Route::get('/', 'UsersController@get');
        Route::get('/{user}', 'UsersController@getUser');
        Route::patch('/{user}', 'UsersController@modify');
        Route::put('/{user}/permissions', 'UsersController@assignPermission');
        Route::delete('/{user}/permissions', 'UsersController@unassignPermission');
        Route::put('/{user}/roles', 'UsersController@assignRole');
        Route::delete('/{user}/roles', 'UsersController@unassignRole');
    });
    Route::prefix('/roles')->middleware('can:modify roles')->group(function () {
        Route::get('/', 'RolesController@get');
        Route::post('/', 'RolesController@create');
        Route::get('/{role}', 'RolesController@getRole');
        Route::patch('/{role}', 'RolesController@modify');
        Route::delete('/{role}', 'RolesController@delete');
        Route::put('/{role}/permissions', 'RolesController@assignPermission');
        Route::delete('/{role}/permissions', 'RolesController@unassignPermission');
    });
    Route::middleware('can:access civilian dashboard')->group(function () {
        Route::resource('characters', 'CharactersController');
        Route::post('/characters/{character}/vehicles', 'VehiclesController@store');
        Route::patch('/vehicles/{vehicle}', 'VehiclesController@update');
    });
    Route::prefix('/lookup')->middleware('can:lookup civilian records')->group(function () {
        Route::get('/person', 'RecordsController@lookupPerson');
    });
    Route::prefix('/cad')->middleware('can:access dispatch dashboard')->group(function () {
        Route::get('/state', 'CadController@cadState');
        Route::patch('/identifier', 'CadController@changeIdentifier');
        Route::patch('/status', 'CadController@setStatus');
    });
});
