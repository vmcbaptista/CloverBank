
@extends('template')
@section('content')
    <form method="POST">
        <label>Nome Completo</label><br>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="text" name="name"><br>
        <label>Código Postal</label><br>
        <input type="text" id="zip1" name="zip1"> - <input type="text" id="zip2" name="zip2"> <input id="zipLoc" type="text" name="zipLoc"><br>
        <label>Morada</label>
        <input id="address" type="text" name="address">
        <label>Número de Porta</label>
        <input id="numPort" type="text" name="numPort"><br>
        <label>Número de Contribuinte</label><br>
        <input type="text" name="nif"><br>
        <label>Telefone</label><br>
        <input type="text" name="phone"><br>
        <label>E-mail</label><br>
        <input type="text" name="email"><br>
        <label>Tipo de Cliente</label><br>
        <select name="type">
            @foreach($client_types as $type)
            <option value="{{ $type->id }}">{{ $type->type }}</option>
            @endforeach
        </select><br>
        <button type="submit">Criar nova conta</button>
    </form>

    <script>
        $('#zip2').on('input', function() {
            if($('#zip1').val().length == 4 && $('#zip2').val().length == 3) {
                console.log($('#zip1').val()+$('#zip2').val());
                requestAddress();
            }
        });
        $('#zip1').on('input', function() {
            if($('#zip1').val().length == 4 && $('#zip2').val().length == 3) {
                requestAddress()
            }
        });

        function requestAddress() {
            $.ajax({
                dataType: "jsonp",
                url:'http://codigospostais.appspot.com/cp7?codigo='+$('#zip1').val()+$('#zip2').val(),
                success: function (data) {
                    $('#zipLoc').val(data.localidade);
                    $('#address').val(data.arteria);
                },
                error: function (err) {
                    alert('O código portal introduzido não foi reconhecido.\nPor favor introduza a morada manualmente.');
                }
            });
        }
    </script>
@endsection