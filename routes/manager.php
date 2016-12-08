<?php

Route::get('/home', "ManagerAuth\HomeController@showHome")->name('home');

Route::get('/passwords/ChangePassword', "ManagerAuth\ChangePassword@ApresentaForm")->name('passwords.change');

Route::post('/Passwords/ChangePassword/check', "ManagerAuth\ChangePassword@VerificaDadosIntroduzidos")->name('passwords.change.check');

//Show Manager Profile
Route::get('/myProfile','MyManagerProfile@showMyProfile');