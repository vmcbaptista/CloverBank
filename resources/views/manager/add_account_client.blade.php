@extends('manager.layout.template')


@push('css')
    <link rel="stylesheet" href="{{ URL::asset('css/modal.css') }}">
@endpush

@section('main_content')
    <div id="body"> <!-- Talvez seja preciso mudar por um id melhor-->
        <p>Selecione o tipo de conta que pretende criar:</p>
        <button id="current">Conta à Ordem</button>
        <button id="saving">Conta Poupança</button>
        <button id="loan">Empréstimo</button>
    </div>
@endsection

@push('javascript')
<script src="/js/addAccount/main.js"></script>
<script src="/js/addAccount/search.js"></script>
<script src="/js/addAccount/addClient.js"></script>
@endpush