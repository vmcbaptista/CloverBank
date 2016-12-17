@push('css')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/client/clientBalance.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/forms.css')}}">
@endpush

<div class="container" style="text-align: center">
    <img src="/Users/paulomendez/PhpstormProjects/CloverBank2/img/LogoCloverBank.png">
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
                <th>{{$Movement->created_at}}</th>
                <th>{{$Movement->description}}</th>
                <th>{{$Movement->amount}}€</th>
                <th>{{$Movement->balance_after}}€</th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('javascript')
<script type="text/javascript" src="{{ URL::asset('js/client/updateMovementsBalance.js') }}"></script>
@endpush

