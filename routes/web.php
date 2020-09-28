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
Route::group(['prefix' => 'admin'], function() {
    Route::get('news/create',
  'Admin\NewsController@add');
});

//Laravel9 課題４
Route::group(['prefix' => 'admin'],function(){
    Route::get('profile/ccreate',
    'ProfileController@add');
    
Route::get(['profile/edit,
    ProfileController@add']);
});
