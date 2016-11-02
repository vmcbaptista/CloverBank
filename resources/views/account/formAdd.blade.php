@extends('template')
@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/modal.css') }}">
    <script src="{{ URL::asset('js/addAccount/main.js') }}"></script>
    <script src="{{ URL::asset('js/util/modal.js') }}"></script>
    <script src="{{ URL::asset('js/addAccount/search.js') }}"></script>
    <script src="{{ URL::asset('js/addAccount/addClient.js') }}"></script>
    <meta name="_token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <!--TODO: Poder meter mais que um titular!! -->
    <form method="post" id="addAccount">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <label>Cliente</label><br>
        <input disabled id="client" type="text"> <input type="button" id="create" value="Criar Novo Cliente"> <input type="button" id="search" value="Pesquisar Cliente"><br>
        <input type="hidden" id="clientId" name="clientId">
        <label>Tipo de Produto</label><br>
        <select name="prod_type" id="prod_type">
            <option></option>
            <option id="current" value="1">Conta à Ordem</option>
            <option value="2">Conta Poupança</option>
            <option value="3">Empréstimo</option>
        </select><br>
        <div id="prod">
        </div>
        <label>Depósito Inicial</label><br>
        <input id="amount" name="amount" disabled><br>
        <button type="submit">Criar nova conta</button>
    </form>
    <div id="createModal" class="modal">
        <div class="modal-content">
            <span class="close">x</span>
            @include('client.add')
        </div>

    </div>
    <div id="searchModal" class="modal">
        <div class="modal-content">
            <span class="close">x</span>
            <!-- This part is dynamically modified using JS -->
        </div>

    </div>
@endsection