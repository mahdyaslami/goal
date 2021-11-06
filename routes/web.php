<?php

use Illuminate\Support\Facades\Route;

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

Route::put('/steps/{step}', 'StepController@update')->name('step-update');

Route::get('/books', 'BookController@index');
Route::get('/books/create', 'BookController@create');
Route::post('/books', 'BookController@store');
Route::get('/books/{book}/edit', 'BookController@edit')->name('book-edit');
Route::put('/books/{book}', 'BookController@update')->name('book-update');
