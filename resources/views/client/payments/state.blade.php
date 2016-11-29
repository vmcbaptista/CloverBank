@extends('client.layout.template')
@push('css')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/forms.css')}}">
@endpush
@section('main_content')
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
            $("#account").change(function () {
                $.get('/account/balance/'+$("#account").val(), function(data) {
                    $("#balance").text(data+' €');
                });
            });
        });
    </script>
@endsection