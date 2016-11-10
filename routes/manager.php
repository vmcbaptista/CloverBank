<?php

Route::get('/', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('manager')->user();

    //dd($users);

    return view('manager.home');
})->name('home');

Route::get('/passwords/ChangePassword', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('manager')->user();

    //dd($users);
    $ErroVerificacao=0;
    return view('manager.auth.passwords.ChangePassword')->with("ErroVerificacao",$ErroVerificacao);
})->name('home');

Route::post('/Passwords/ChangePassword/check', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('manager')->user();

    //dd($users);
    $ErroVerificacao = App\Http\Controllers\ManagerAuth\ChangePassword::VerificaDadosIntroduzidos();
    echo $ErroVerificacao;
})->name('home');


