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
//this will get the list of articles to show in the front page
Route::get('/', 'PostsController@index')->name('landing');
Route::POST('/search', 'PostsController@search')->name('search');
Auth::routes();

Route::resource('posts', 'PostsController');
