@extends('client.client_template')

@section('content')
    <div class="container">
        <label>Selecione a conta</label><br>
        <select id="account" name="account">
            @foreach($accounts as $account)
                <option>{{ $account->id }}</option>
            @endforeach
        </select><br>
        <label>Saldo:</label>
        <p id="balance"></p>
        <div>
            <table>
                <thead>
                <tr>
                    <th>Data do Movimento</th>
                    <th>Descrição</th>
                    <th>Montante</th>
                    <th>Saldo</th>
                </tr>
                </thead>
                <tbody id="movements">
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function updateBalance() {
            $.get('/account/balance/'+$("#account").val(), function(data) {
                $("#balance").text(data+' €');
            });
        }

        function updateMovements() {
            $.get('/movements/'+$("#account").val(), function(data) {
                console.log(data);

                $.each(data,function (i,val) {
                    $("#movements").append(
                            '<tr>' +
                            '<td>'+val["created_at"]+'</td>' +
                            '<td>'+val["description"]+'</td>' +
                            '<td>'+val["amount"]+'</td>' +
                            '<td>'+val["balance_after"]+'</td>' +
                            '</tr>'
                    )
                })
            });
        }

        $().ready(function () {
            updateBalance();
            updateMovements();
            $("#account").change(function () {
                updateBalance();
                $("#movements").empty();
                updateMovements();
            });
        });
    </script>
@endsection
