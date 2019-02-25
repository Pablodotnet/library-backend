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

Route::middleware('auth')->get('/user', function (Request $request) {
	return $request->user();
});

// Auth routes
Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

// Book routes
Route::group(['middleware' => 'auth'], function() {
	Route::get('books', 'BookController@index');
	Route::get('books/{book}', 'BookController@show');
	Route::post('books', 'BookController@store');
	Route::put('books/{book}', 'BookController@update');
	Route::delete('books/{book}', 'BookController@delete');
});
