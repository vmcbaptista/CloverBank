<?php

Route::get('/home', "ClientAuth\HomeController@showHome")->name('home');

Route::get('/passwords/ChangePassword', "ClientAuth\ChangePassword@ApresentaForm")->name('passwords.change');

Route::post('/Passwords/ChangePassword/check', "ClientAuth\ChangePassword@VerificaDadosIntroduzidos")->name('passwords.change.check');

Route::get('/transfers/', "TransferenciasController@showForm")->name('transfers');

Route::post('/transfers/', "TransferenciasController@VerificaTransferencia")->name('transfers.post');

Route::post('/transfers/check', "TransferenciasController@CheckVerificationCode")->name('transfers.check');

Route::get('/accounts','CurrentAccountController@showAccountsInfo');

//Show Client Profile
Route::get('/myProfile','MyClientProfile@showMyProfile');