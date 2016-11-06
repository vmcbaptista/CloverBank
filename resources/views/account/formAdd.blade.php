@extends('template')
@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/modal.css') }}">
    <script src="/js/addAccount/main.js"></script>
    <script src="/js/addAccount/search.js"></script>
    <script src="/js/addAccount/addClient.js"></script>
    <meta name="_token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div id="body"> <!-- Talvez seja preciso mudar por um id melhor-->
        <p>Selecione uma das seguintes opções para o 1º Titular da Conta</p>
        <button id="new">Novo cliente</button>
        <button id="existing">Cliente já existente</button>
    </div>
@endsection