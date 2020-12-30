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

// Route::get('/', function () {
// 	return view('welcome');
// });

//adminlte
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//line login
Route::get('/line', 'LoginController@pageLine');
Route::get('/callback/login', 'LoginController@lineLoginCallBack');

Route::get('/', 'ArticleController@index');
// Route::get('/home', 'ArticleController@index');
Route::group(['middleware' => 'auth'], function () {
	Route::get('/create', 'ArticleController@create');
	Route::post('/store', 'ArticleController@store');
	Route::group(['middleware' => 'authority'], function () {
		Route::get('/show/{id}/', 'ArticleController@show');
		Route::get('/edit/{id}/', 'ArticleController@edit');
		Route::post('/show/update/{id}', 'ArticleController@update');
		Route::post('/show/delete/{id}/', 'ArticleController@destroy');
	});
});
