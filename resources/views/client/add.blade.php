<form method="POST" id="addCliForm">
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
    <input id="submit" type="submit" value="Criar novo cliente">
</form>