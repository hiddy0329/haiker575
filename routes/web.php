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

Route::get('/', 'HomeController@create')->name('index');
Route::get('/home', 'HomeController@create')->name('home');
Route::get('/create', 'HomeController@create')->name('create');
Route::post('/store', 'HomeController@store')->name('store');
Route::get('/edit/{id}', 'HomeController@edit')->name('edit');
Route::post('/update/{id}', 'HomeController@update')->name('update');
Route::get('/show/{id}', 'HomeController@show')->name('show');
Route::post('/delete/{id}', 'HomeController@delete')->name('delete');
Route::get('/posts/search', 'homeController@search')->name('search');

Route::post('/posts/{post_id}/comments','CommentsController@store');

