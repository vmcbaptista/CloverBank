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
Route::get('Login', function () {
    if(session('GrauAuth') != 0)
    {
        switch(session('GrauAuth'))
        {
            case 1:
                return redirect('/userpage');
                break;
            case 2:
                return redirect('/userpage');
                break;
            default:
                break;
        }
    }
    else
    {
        return view('Login');
    }
});

Route::post('LoginData',"LoginController@VerifyLogin");

Route::get('userpage',"LoginController@VerificaAutentificacaoUser");

Route::get('managerpage',"LoginController@VerificaAutentificacaoGestor");

Route::get('Logout',"LoginController@EfetuaLogout");


Auth::routes();

Route::get('/home', 'HomeController@index');
