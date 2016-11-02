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

Route::get('/client/add', 'ClientController@addForm');

Route::post('/client/add', 'ClientController@add');

Route::post('/client/search', 'ClientController@search');

Route::get('/product/create', 'ProductController@renderForm');

Route::post('/product/create', 'ProductController@create');

Route::get('/product/current', 'ProductController@getCurrent');

Route::get('/product/loan', 'ProductController@getLoan');

Route::get('/product/saving', 'ProductController@getSaving');

Route::get('/product/{id}', 'ProductController@getProduct');