@extends('template')
@section('content')
    <form method="POST" id="addCliForm">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <label>Conta a Debitar</label><br>
        <select id="account" name="account">
            <option></option>
            @foreach($accounts as $account)
                <option>{{ $account->id }}</option>
            @endforeach
        </select><br>
        <label>Saldo Contabilístico</label><br>
        <p id="balance"></p>
        <label>Entidade</label><br>
        <input type="text" name="entity"><br>
        <label>Referência</label><br>
        <input type="text" id="reference" name="reference"><br>
        <label>Descrição</label><br>
        <input id="description" type="text" name="description"><br>
        <label>Valor</label><br>
        <input id="amount" type="text" name="amount"><br>
        <input id="submit" type="submit" value="Criar novo pagamento">
    </form>

    <script>
        $().ready(function () {
            $("#account").click(function () {
                $.get('/account/balance/'+$("#account").val(), function(data) {
                    $("#balance").text(data+' €');
                });
            });
        });
    </script>
@endsection