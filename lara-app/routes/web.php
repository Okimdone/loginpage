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
use Illuminate\Http\Request;

Route::post('login', 'UserController@authenticate');

Route::group(['middleware' => ['jwt.redirect']], function() {
    Route::get('/', 'DataController@homepage');
});

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('getNotes', 'DataController@getNotes');
    Route::post('sync', 'DataController@syncData');
});
