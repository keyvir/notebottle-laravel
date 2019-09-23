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

Route::post('login','ApiController@login');
Route::post('register','ApiController@register');

Route::prefix('page')->group(function(){
    Route::get('{id}','PageController@get');
    Route::get('list','PageController@getList');
    Route::get('my-list','PageController@getMyList');
    Route::post('store','PageController@store');
    Route::post('update/{page}','PageController@update');
    Route::get('remove/{page}','PageController@remove');
});
