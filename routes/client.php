<?php

Route::get('/', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('client')->user();

    //dd($users);

    $client = \Auth::guard('client')->user();
    $accounts = $client->accounts;

    return view('client.home',compact('accounts'));
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
