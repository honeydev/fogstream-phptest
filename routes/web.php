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

Route::get('/', 'NewsController@index');

Route::get('profile', 'ProfileController@index')->name('profile');
Route::get('profile/update', 'ProfileController@updatePage')->name('profile.update');
Route::post('profile/store', 'ProfileController@storeProfile')->name('profile.store');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
