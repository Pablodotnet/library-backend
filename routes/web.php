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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::group(['middleware' => 'prevent.back.history'], function() {
	Auth::routes();
	Route::group(['middleware' => 'auth'], function() {
		Route::get('/home', 'HomeController@index')->name('home');
		Route::resource('books', 'BookController');
		Route::put('books/{book}/rent', 'BookController@rent')->name('books.rent');
		Route::put('books/{book}/returnBook', 'BookController@returnBook')->name('books.returnBook');
	});
});
