<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/manager', function () {
    return view('manager.manager');
});

Route::get('/client', function () {
    return view('client.client');
});

Route::get('/account/add', 'AccountController@showForm');

Route::post('/account/add', 'AccountController@add');