<?php

use Illuminate\Http\Request;

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

//Route::get('/login', function () {
//    dd('login');
//});
Route::post('/login', 'Api\UserController@login')->name('login');
Route::post('/create', 'Api\UserController@create')->name('create');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
