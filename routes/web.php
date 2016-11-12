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

Route::get('/account/add', 'AccountController@showForm')->middleware('manager');

Route::post('/account/current/add', 'CurrentAccountController@add')->middleware('manager');

Route::post('/account/current/search/{client_id}', 'CurrentAccountController@search')->middleware('manager');

Route::post('/account/saving/add', 'SavingAccountController@add')->middleware('manager');

Route::post('/account/loan/add', 'LoanController@add')->middleware('manager');

Route::get('/account/balance/{id}', 'CurrentAccountController@balance');

Route::get('/client/add', 'ClientController@addForm');

Route::post('/client/add', 'ClientController@add');

Route::get('/payments/services', 'AccountMovementController@showServicesForm')->middleware('client');

Route::post('/payments/services', 'AccountMovementController@servicePayment')->middleware('client');

Route::get('/payments/phone', 'AccountMovementController@showPhoneForm')->middleware('client');

Route::post('/payments/phone', 'AccountMovementController@phonePayment')->middleware('client');

Route::get('/payments/state', 'AccountMovementController@showStateForm')->middleware('client');

Route::post('/payments/state', 'AccountMovementController@statePayment')->middleware('client');

Route::get('/movements/{account_id}', 'AccountMovementController@getMovements')->middleware('client');

Route::post('/client/search', 'ClientController@search')->middleware('manager');

Route::get('/product/create', 'ProductController@renderForm')->middleware('manager');

Route::post('/product/create', 'ProductController@create')->middleware('manager');

Route::get('/product/current', 'ProductController@getCurrent');

Route::get('/product/loan', 'ProductController@getLoan');

Route::get('/product/saving', 'ProductController@getSaving');

Route::get('/product/{id}', 'ProductController@getProduct');
//Client Login
Route::get('client/login', 'ClientAuth\LoginController@showLoginForm');
Route::post('client/login', 'ClientAuth\LoginController@login');
Route::post('client/logout', 'ClientAuth\LoginController@logout');

//Client Register
Route::get('client/register', 'ClientAuth\RegisterController@showRegistrationForm');
Route::post('client/register', 'ClientAuth\RegisterController@register');

//Client Passwords
Route::post('client/password/email', 'ClientAuth\ForgotPasswordController@sendResetLinkEmail');
Route::post('client/password/reset', 'ClientAuth\ResetPasswordController@reset');
Route::get('client/password/reset', 'ClientAuth\ForgotPasswordController@showLinkRequestForm');
Route::get('client/password/reset/{token}', 'ClientAuth\ResetPasswordController@showResetForm');


//Manager Login
Route::get('manager/login', 'ManagerAuth\LoginController@showLoginForm');
Route::post('manager/login', 'ManagerAuth\LoginController@login');
Route::post('manager/logout', 'ManagerAuth\LoginController@logout');

//Manager Register
Route::get('manager/register', 'ManagerAuth\RegisterController@showRegistrationForm');
Route::post('manager/register', 'ManagerAuth\RegisterController@register');

//Manager Passwords
Route::post('manager/password/email', 'ManagerAuth\ForgotPasswordController@sendResetLinkEmail');
Route::post('manager/password/reset', 'ManagerAuth\ResetPasswordController@reset');
Route::get('manager/password/reset', 'ManagerAuth\ForgotPasswordController@showLinkRequestForm');
Route::get('manager/password/reset/{token}', 'ManagerAuth\ResetPasswordController@showResetForm');
//Manager change Password

Route::get('/manager/passwords/ChangePassword','ManagerAuth\ChangePassword@ApresentaForm');
Route::post('/manager/Passwords/ChangePassword/check','ManagerAuth\ChangePassword@VerificaDadosIntroduzidos');
//reset passwords manager
Route::get('manager/password/resetPassword', 'ManagerAuth\ForgotPasswordController@ForgotPasswordForm');
Route::post('/manager/passwords/resetPassword/verification', 'ManagerAuth\ForgotPasswordController@CheckEmail');
Route::post('/manager/passwords/resetPassword/Codeverification', 'ManagerAuth\ForgotPasswordController@CheckVerificationCode');
Route::post('/manager/passwords/resetPassword/NewPassword', 'ManagerAuth\ForgotPasswordController@CheckNewPasswords');
//client change Password

Route::get('/client/passwords/ChangePassword','ManagerAuth\ChangePassword@ApresentaForm');
Route::post('/client/Passwords/ChangePassword/check','ManagerAuth\ChangePassword@VerificaDadosIntroduzidos');

//reset passwords client
Route::get('client/password/resetPassword', 'ClientAuth\ForgotPasswordController@ForgotPasswordForm');
Route::post('/client/passwords/resetPassword/verification', 'ClientAuth\ForgotPasswordController@CheckEmail');
Route::post('/client/passwords/resetPassword/Codeverification', 'ClientAuth\ForgotPasswordController@CheckVerificationCode');
Route::post('/client/passwords/resetPassword/NewPassword', 'ClientAuth\ForgotPasswordController@CheckNewPasswords');