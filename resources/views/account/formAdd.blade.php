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
        <p>Selecione o tipo de conta que pretende criar:</p>
        <button id="current">Conta à Ordem</button>
        <button id="saving">Conta Poupança</button>
        <button id="loan">Empréstimo</button>
    </div>
@endsection