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

Route::match(['post','options'],'login','ApiController@login');
Route::match(['post','options'],'register','ApiController@register');

Route::prefix('page')->group(function(){
    Route::match(['get','options'],'list','PageController@getList');
    Route::get('my-list','PageController@getMyList');
    Route::match(['post','options'],'store','PageController@store');
    Route::match(['post','options'],'update/{page}','PageController@update');
    Route::get('remove/{page}','PageController@remove');
    Route::get('{id}','PageController@get');
});

Route::prefix('tag')->group(function(){
    Route::get('list','TagController@getList');
});
Route::get('search','PageController@search');