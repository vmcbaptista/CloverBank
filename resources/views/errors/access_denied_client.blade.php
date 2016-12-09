@extends('errors.template')
@section('header')
    <h1><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Acesso Não Autorizado</h1>
@endsection
@section('error_message')
    <h2>Ups!</h2>
    <h2>Não é possível iniciar sessão uma vez que um cliente encontra-se a utilizar este equipamento.</h2>
@endsection