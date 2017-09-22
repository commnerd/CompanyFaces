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
    Route::get('/search', 'UsersController@search')->name('users.search');
    Route::get('/users/{user}', 'UsersController@show')->name('users.show');
    Route::resource('badges', 'BadgesController')->only('show');

    Route::namespace('Admin')->prefix('admin')->group(function () {
        Route::get('/', 'AdminController@index')->name('admin.index');
        Route::get('/users/{user}/badges', 'BadgeUserController@assign')->name('admin.badges.assign');
        Route::post('/users/{user}/badges', 'BadgeUserController@save')->name('admin.badges.save');
        Route::resource('users', 'UsersController', ['names' => [
            'index' => 'admin.users.index',
            'store' => 'admin.users.store',
            'destroy' => 'admin.users.destroy',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'create' => 'admin.users.create',
        ]])->except(['show']);
        Route::resource('badges', 'BadgesController', ['names' => [
            'index' => 'admin.badges.index',
            'store' => 'admin.badges.store',
            'destroy' => 'admin.badges.destroy',
            'edit' => 'admin.badges.edit',
            'update' => 'admin.badges.update',
            'create' => 'admin.badges.create',
        ]])->except(['show']);
        Route::resource('settings', 'SettingController', ['names' => [
            'store' => 'admin.settings.store',
        ]])->only(['store']);
    });
});
