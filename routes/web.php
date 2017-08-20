<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/', 'Web\HomeController@index')->name('home');
Route::get('/admin', 'Web\AdminController@index')->name('admin');
Route::get('/search', 'Web\SearchController@list')->name('search');

Route::resource('/users', 'Web\UsersController');

// Route::get('/', 'Auth\LoginController@showLoginForm');
