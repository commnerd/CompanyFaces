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

Route::get('/', 'Web\HomeController@index')->name('home');
Route::get('/admin', 'Web\AdminController@index')->name('admin');
Route::get('/search', 'Web\SearchController@list')->name('search');

Route::resource('/users', 'Web\UsersController');
