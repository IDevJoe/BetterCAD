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
    Route::resource('characters', 'CharactersController')->middleware('can:access civilian dashboard');
});
