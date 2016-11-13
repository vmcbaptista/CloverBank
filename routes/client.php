<?php

Route::get('/home', function () {
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

Route::get('/transfers/', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('client')->user();


    $client = \Auth::guard('client')->user();
    $accounts = $client->accounts;
    //dd($users);
    $ErroVerificacao = 0;
    $VerificactionStep = 0;
    return view('client.transferencias',compact('accounts'))->with(['ErroVerificacao'=>$ErroVerificacao,'VerificationStep'=>$VerificactionStep]);
})->name('home');

Route::post('/transfers/', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('client')->user();


    $client = \Auth::guard('client')->user();
    $accounts = $client->accounts;
    //dd($users);
    $VerificactionStep = 0;
    $ErroVerificacao = \App\Http\Controllers\TransferenciasController::VerificaTransferencia();
    return view('client.transferencias',compact('accounts'))->with(['ErroVerificacao'=>$ErroVerificacao,'VerificationStep'=>$VerificactionStep]);
})->name('home');

Route::post('/transfers/check', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('client')->user();


    $client = \Auth::guard('client')->user();
    $accounts = $client->accounts;
    //dd($users);
    $VerificactionStep = 1;
    $ErroVerificacao = \App\Http\Controllers\TransferenciasController::CheckVerificationCode();
    return view('client.transferencias',compact('accounts'))->with(['ErroVerificacao'=>$ErroVerificacao,'VerificationStep'=>$VerificactionStep]);
})->name('home');
