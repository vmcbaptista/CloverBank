@extends('client.client_template')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/client/clientBalance.css')}}">
@endsection

@section('content')
    <div class="container">
        <div class="accountBalanceBar">
        <label for="account" >Selecione a conta  </label>
        <select id="account" name="account">
            @foreach($accounts as $account)
                <option>{{ $account->id }}</option>
            @endforeach
        </select>
        <label id="balanceLabel">Saldo: <span id="balance"></span></label>
        </div>

        <table  id="account_movements">
            <thead>
                <tr>
                    <th>Data Movimento</th>
                    <th>Descriçao</th>
                    <th>Montante</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody id="movements">

            </tbody>
        </table>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/client/updateMovementsBalance.js') }}"></script>
@endsection