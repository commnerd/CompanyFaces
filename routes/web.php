<?php

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

Auth::routes();
Route::namespace('Web')->group(function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/search', 'SearchController@list')->name('search');
    Route::get('/users/{id}', 'UsersController@show')->name('users.show');

    Route::prefix('admin')->namespace('Admin')->group(function () {
        Route::get('/', 'AdminController@index')->name('admin.index');
        Route::resource('users', 'UsersController', ['names' => [
            'index' => 'admin.users.index',
            'store' => 'admin.users.store',
            'destroy' => 'admin.users.destroy',
            'show' => 'admin.users.show',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'create' => 'admin.users.create',
        ]]);
    });
});
