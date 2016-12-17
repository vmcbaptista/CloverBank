<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <!--<link rel="stylesheet" type="text/css" href="/var/www/html/CloverBank/public/css/base.css">-->
    <link rel="stylesheet" type="text/css" href="/var/www/html/CloverBank/public/css/client/clientBalance.css">
    <link rel="stylesheet" type="text/css" href="/var/www/html/CloverBank/public/css/forms.css">
    <title>CloverBank</title>
</head>
<body>
<div class="container" style="text-align: center">
    <img src="/var/www/html/CloverBank/public/logo/clover_main.png">
</div>
<div class="container">
    <h4>Movimentos da conta</h4>
    <p>Na sequência do pedido efectuado por {{$Name}} através do Serviço Homebanking,
        foi registada às {{$hours}} do dia {{$date}} a operação -<b>Consultar saldos e movimentos à ordem</b>- com os seguintes dados:
    </p>
    <hr style="border-color:green">
</div>
<div>
    <fieldset>
        <p>Produto: {{$Product->name}}</p>
        <p>Saldo Disponível:{{$Balance}}</p>
    </fieldset>
</div>

    <div>
        <table class="table">
            <thead>
            <tr>
                <th>Data Movimento</th>
                <th>Descriçao</th>
                <th>Montante</th>
                <th>Saldo</th>
            </tr>
            </thead>
            <tbody>
            @foreach($Movements as $Movement)
                <tr>
                <td>{{$Movement->created_at}}</td>
                <td>{{$Movement->description}}</td>
                <td>{{$Movement->amount}}€</td>
                <td>{{$Movement->balance_after}}€</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>

