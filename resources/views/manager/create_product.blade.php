@extends('manager.layout.template')

@push('css')
<link rel="stylesheet" type="text/css" href="/css/forms.css">
@endpush
@section('main_content')
    <div class="container">
        @if(!$success)
            @if (count($errors) > 0)
                <div class="error">
                    <p>Ocorreram os seguintes erros.</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <p>Terá de recomeçar o processo de criação do produto.</p>
                </div>
            @endif
            <form method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label>Selecione o Tipo de Produto que pretende criar: </label><br>
                <div class="form-wrapper">
                    <label for="current">Conta à Ordem: </label>
                    <input type="radio" name="prod_type" id="current"  value="current" checked="checked">
                    <label for="saving">Conta Poupança: </label>
                    <input type="radio" name="prod_type" id="saving" value="saving">
                    <label for="loan">Emprestímo: </label>
                    <input type="radio" name="prod_type" id="loan" value="loan">
                </div><br>
                <label>Insira os dados do novo produto</label>
                <div id="form" class="form-wrapper">

                </div>
                <div class="right_buttons">
                    <input type="submit" value="Adicionar Novo Produto" />
                </div>
            </form>
        @else
            <div class="confirmation">
                <p>O produto foi criado com sucesso</p>
                <p>Clique em <a href="/manager/home">Continuar</a> para ser redirecionado para a página inicial.</p>
            </div>
        @endif
    </div>
@endsection


@push('javascript')
<script src="/js/manager/addProductDynamicForm.js"></script>
@endpush