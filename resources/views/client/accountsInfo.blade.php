@extends('client.layout.template')


@push('css')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/client/clientBalance.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/forms.css')}}">
@endpush

@section('main_content')
    <div class="container">
        <div class="accountBalanceBar">
            <label>Selecione a Conta</label>
            <select id="account" name="account">
                @foreach($accounts as $account)
                    <option>{{ $account->id }}</option>
                @endforeach
            </select>
            <label id="balanceLabel">Saldo: <span id="balance"></span></label>
        </div>
        @foreach($accounts as $account)
            <div class="account_info" id="{{ $account->id }}">
                <label>Dados da Conta</label>
                <table>
                    <thead>
                    <tr>
                        <th colspan="2">Conta à Ordem</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Produto</td>
                        <td>{{ $account->currentProduct->belongsTOne_product->name }}</td>
                    </tr>
                    </tbody>
                    <thead>
                    <tr>
                        <th colspan="2">Balcão</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Nome</td>
                        <td>{{ $account->branch->name }}</td>
                    </tr>
                    <tr>
                        <td>Morada do Balcão</td>
                        <td>{{ $account->branch->address }}</td>
                    </tr>
                    <tr>
                        <td>Telefone do Balcão</td>
                        <td>{{ $account->branch->phone }}</td>
                    </tr>
                    <tr>
                        <td>E-mail do Balcão</td>
                        <td>{{ $account->branch->mail }}</td>
                    </tr>
                    </tbody>
                    <thead>
                    <tr>
                        <th colspan="2">Gestor</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Nome</td>
                        <td>{{ $account->manager->name }}</td>
                    </tr>
                    <tr>
                        <td>Telefone do Gestor</td>
                        <td>{{ $account->manager->phone }}</td>
                    </tr>
                    <tr>
                        <td>Email do Gestor</td>
                        <td>{{ $account->manager->email }}</td>
                    </tr>
                    </tbody>
                </table>
                <br>
                <label>Titulares</label>
                <?php $i = 0 ?>
                @foreach($account->clients as $client)
                    <?php $i++ ?>
                <table>
                    <thead>
                    <tr>
                        <th colspan="2">{{ $i }}º Titular</th>
                    </tr>
                    </thead>
                    <tr>
                        <td>Nome</td>
                        <td>{{ $client->name }}</td>
                    </tr>
                    <tr>
                        <td>Morada</td>
                        <td>{{ $client->address }}</td>
                    </tr>
                    <tr>
                        <td>Telefone</td>
                        <td>{{ $client->phone }}</td>
                    </tr>
                    <tr>
                        <td>NIF</td>
                        <td>{{ $client->nif }}</td>
                    </tr>
                    <tr>
                        <td>E-mail</td>
                        <td>{{ $client->email }}</td>
                    </tr>
                </table>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection

@push('javascript')
<script type="text/javascript" src="{{ URL::asset('js/client/updateMovementsBalance.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/client/accountsInfo.js') }}"></script>
@endpush