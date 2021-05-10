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
});
//Laravel9 
Route::group(['prefix' => 'admin','middleware'=>'auth'], function() {
    Route::get('profile/create','Admin\ProfileController@add');
    Route::post('profile/create', 'Admin\ProfileController@create'); # 追記
    Route::get('profile', 'Admin\ProfileController@index');
    Route::get('profile/edit','Admin\ProfileController@edit');
    Route::post('profile/edit', 'Admin\ProfileController@update');
    Route::get('profile/delete', 'Admin\ProfileController@delete');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'NewsController@index');//Laravel19
//laravel15追記
Route::group(['prefix' => 'admin'], function() {
    Route::get('news/create', 'Admin\NewsController@add')->middleware('auth');
    Route::post('news/create', 'Admin\NewsController@create')->middleware('auth');
    Route::get('news', 'Admin\NewsController@index')->middleware('auth'); 
    Route::get('news/edit', 'Admin\NewsController@edit')->middleware('auth'); // Laravel16追記
    Route::post('news/edit', 'Admin\NewsController@update')->middleware('auth'); // Laravel追記
    Route::get('news/delete', 'Admin\NewsController@delete')->middleware('auth');//laravel16追記
    Route::get('profile', 'ProfileController@index');//laravel19課題
});
