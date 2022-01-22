<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::post('/login', '\App\Http\Controllers\AuthController@login');
    Route::get('/login/socialite/Discord', '\App\Http\Controllers\AuthController@socDiscRed');
    Route::get('/login/socialite/Discord/continue', '\App\Http\Controllers\AuthController@socDiscRet');
    Route::post('/login/ac', '\App\Http\Controllers\AuthController@signupCode')->name('login.accesscode');
});

Route::post('/logout', '\App\Http\Controllers\AuthController@logout');

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');

\Illuminate\Support\Facades\Broadcast::routes();
