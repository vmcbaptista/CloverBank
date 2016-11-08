<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('client')->user();

    //dd($users);

    return view('client.home');
})->name('home');

Route::get('/passwords/ChangePassword', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('client')->user();

    //dd($users);
    $ErroVerificacao=0;
    return view('client.auth.passwords.ChangePassword')->with("ErroVerificacao",$ErroVerificacao);
})->name('home');

Route::post('/Passwords/ChangePassword/check', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('client')->user();

    //dd($users);
    $ErroVerificacao = \App\Http\Controllers\ClientAuth\ChangePassword::VerificaDadosIntroduzidos();
    echo $ErroVerificacao;
})->name('home');
