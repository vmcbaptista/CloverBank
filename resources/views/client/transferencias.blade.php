@extends('template')

@section('content')
    @if($VerificationStep == 0)
    <form method="POST" id="Transferencia">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <label>Conta a Debitar</label><br>
        <select id="account" name="account">
            <option></option>
            @foreach($accounts as $account)
                <option>{{ $account->id }}</option>
            @endforeach
        </select><br>
        <label>Saldo </label><br>
        <p id="balance"></p>
        <br>
        <label>Dados transferencia</label>
        <fieldset>
            <label>Conta/IBAN</label>
            <br>
            <input type="number" name="IBAN">
            @if($ErroVerificacao==2)
                <p style="color:red">  O IBAN introduzido não existe </p>
            @endif
            <br>
            <label>Montante</label>
            <div>
                <input type="number" name ="Montante">EUR
                @if($ErroVerificacao==3)
                    <p style="color:red">  O montante tem que ser maior que 0€ </p>
                @endif
            </div>
            <br>
            <label>Descrição</label>
            <br>
            <input type="textfield" name="DescricaoTransferencia">
            <br>

        </fieldset>
        @if($ErroVerificacao==1)
            <p style="color:red"> Nenhum dos campos pode estar vazio</p>
        @endif
        @if($ErroVerificacao == 4)
            <p style="color:red">Não tem fundos suficientes para realizar a transferencia </p>
        @endif
        <input type="submit" name="submit" value="Continuar">
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
    @endif
    @if($VerificationStep ==1)
    <form action ="{{ url('/client/transfers/check') }}" method="POST" id="Transferencia">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <label>Codigo de Verificação</label>
        <br>
        <input type="text" name="PinCliente">
        <br>
        <input type="submit" name="submit" value="Transferir">
        @if($ErroVerificacao==1)
            <p style="color: red ">Não pode existir campos vazios</p>
        @endif
        @if($ErroVerificacao==2)
            <p style="color: red ">O codigo de verificação não se encontra correcto </p>
        @endif

    </form>
    @endif
    @if($VerificationStep ==2)

        <p style = "color: green ">A transferencia foi realizada com sucesso</p>
        <br>
        <a href="http://localhost:8000/client/home">Continuar</a>
    @endif
@endsection