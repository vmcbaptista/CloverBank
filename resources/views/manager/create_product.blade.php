@extends('manager.layout.template')

@push('css')
<link rel="stylesheet" type="text/css" href="/css/forms.css">
<link rel="stylesheet" type="text/css" href="/css/manager/addProducts.css">
@endpush
@section('main_content')
<div class="container">
    <form method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <label>Selecione o Tipo de Produto que pretende criar: </label><br>
        <div class="selProd">
        <label for="current">Conta à Ordem: </label>
        <input type="radio" name="prod_type" id="current"  value="current" checked="checked">
        <label for="saving">Conta Poupança: </label>
        <input type="radio" name="prod_type" id="saving" value="saving">
        <label for="loan">Emprestímo: </label>
        <input type="radio" name="prod_type" id="loan" value="loan">
        </div><br>
        <label>Insira os dados do novo produto</label>
        <div id="form">

        </div>
        <div>
            <input type="submit" value="Adicionar Novo Produto" />
            </div>
    </form>
</div>
@endsection


@push('javascript')
    <script src="/js/manager/addProductDynamicForm.js"></script>
@endpush