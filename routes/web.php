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

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/pastebin', 'PastebinController@index')->name('pastebin');
Route::post('/pastebin', 'PastebinController@store')->name('postPastebin');
Route::get('/pastebin/{url}', 'PastebinController@show')->name('pastebin-enity');

Route::get('/usr/pastebin', 'PastebinRegisterController@index')->name('usrPasterbin');



