<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('invoice', function(){
    return view('invoice');
});
Route::get('admin', 'Auth\AdminController@showLoginForm');
Route::post('admin-login', ['as'=>'admin-login','uses'=>'Auth\AdminController@login']);
Route::get('{path}',"HomeController@index")->where( 'path', '([A-z\d-\/_.]+)?' );
