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

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::get('/', 'ArticleapiController@index');
Route::get('/show/{id}', 'ArticleapiController@show');
Route::group(['middleware' => 'check.token'], function () {
	Route::post('/logout', 'AuthController@logout');
	Route::post('/store', 'ArticleapiController@store');
	Route::group(['middleware' => 'change.article'], function () {
		Route::post('/update/{id}', 'ArticleapiController@update');
		Route::post('/destroy/{id}', 'ArticleapiController@destroy');
	});
});
