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

Route::get('/v1/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/v1/users/search', 'API\UsersController@search')->name('searchUsers');
