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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',  'API\LoginController@login');
Route::post('/register', 'API\RegisterController@register');

Route::post('/news/create', 'API\NewsController@createNews')->middleware('auth:api');
Route::get('/news/get/all', 'API\NewsController@getAll');
Route::get('/news/get', 'API\NewsController@getByCursor');

Route::get('/profile/get/{id}', 'API\ProfileController@getProfile');
Route::put('profile/store', 'API\ProfileController@storeProfile')->middleware('auth:api');
