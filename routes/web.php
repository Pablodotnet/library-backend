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
	Route::get('/home', 'HomeController@index')->name('home');
	// Book Routes
	Route::get('/books', 'BookController@index')->name('books');
	Route::post('/books', 'BookController@store')->name('books.store');
	Route::get('/books/create', 'BookController@create')->name('books.create');
	Route::get('/books/{book}', 'BookController@show')->name('book');
	Route::get('/books/{book}/edit', 'BookController@edit')->name('book.edit');
	Route::put('books/{book}', 'BookController@update')->name('book.update');
	Route::delete('books/{book}', 'BookController@delete')->name('book.delete');
});
