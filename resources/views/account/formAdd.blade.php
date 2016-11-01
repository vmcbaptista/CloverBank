@extends('template')
@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/modal.css') }}">
    <script src="{{ URL::asset('js/util/modal.js') }}"></script>
    <script src="{{ URL::asset('js/addAccount/search.js') }}"></script>
    <script src="{{ URL::asset('js/addAccount/addClient.js') }}"></script>
    <meta name="_token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <form>
        <label>Tipo de Conta</label><br>
        <select></select><br>
        <label>Cliente</label><br>
        <input id="client" type="text"> <input type="button" id="create" value="Criar Novo Cliente"> <input type="button" id="search" value="Pesquisar Cliente"><br>
        <input type="hidden" id="clientId" name="clientId">
        <label>Depósito Inicial</label><br>
        <input><br>
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