@extends('manager.layout.template')


@push('css')
<link rel="stylesheet" type="text/css" href="/css/forms.css">
<link rel="stylesheet" type="text/css" href="/css/manager/addAccount.css">
@endpush

@section('main_content')
    <div id="body" class="container"> <!-- Talvez seja preciso mudar por um id melhor-->
        @if(!$success)
            @if (count($errors) > 0)
                <div class="error">
                    <p>Ocorreram os seguintes erros.</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <p>Terá de recomeçar o processo de criação da conta.</p>
                </div>
            @endif
            <p>Selecione o tipo de conta que pretende criar:</p>
            <div class="buttons">
                <button id="current">Conta à Ordem</button>
                <button id="saving">Conta Poupança</button>
                <button id="loan">Empréstimo</button>
            </div>
        @else
            <div class="confirmation">
                <p>A conta foi criada com sucesso</p>
                <p>Clique em <a href="/manager/home">Continuar</a> para ser redirecionado para a página inicial.</p>
            </div>
        @endif
        </div>
@endsection

@push('javascript')
<script src="/js/addAccount/main.js"></script>
<script src="/js/addAccount/search.js"></script>
<script src="/js/addAccount/addClient.js"></script>
<script src="/js/addAccount/validate.js"></script>
@endpush