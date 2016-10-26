@extends('template')

@section('content')
    <!--TODO Add text spread and js to show the right fields-->
    <form method="POST" action="">
        <label for="name">Nome Produto: </label><br>
        <input type="text" id="name"><br>
        <label for="description">Condições de Acesso: </label><br>
        <input type="text" id="access_condition"><br>
        <label for="description">Descrição: </label><br>
        <input type="text" id="description"><br>
        <label for="rate">Taxa de Juro: </label><br>
        <input type="text" id="rate"><br>
        <label for="min_amount">Montante Mínimo: </label><br>
        <input type="text" id="min_amount"><br>
        <label for="max_amount">Montante Máximo: </label><br>
        <input type="text" id="max_amount"><br>
        <label for="duration">Duração em meses: </label><br>
        <input type="text" id="duration"><br>
        <label>Tipo Produto: </label><br>
        <label for="current">Ordem: </label>
        <input type="radio" name="prod_type" id="current">
        <label for="saving">Poupança: </label>
        <input type="radio" name="prod_type" id="saving">
        <label for="loan">Emprestímo: </label>
        <input type="radio" name="prod_type" id="loan"><br>

        <label >Reforços de Capital: </label><br>
        <label for="allow">Permitido: </label>
        <input type="radio" name="reinforcements" id="allow">
        <label for="not_allow">Não Permitido: </label>
        <input type="radio" name="reinforcements" id="not_allow"/><br>
        <input type="submit" value="Adicionar Novo Produto" />
    </form>
@endsection