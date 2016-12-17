@extends('client.layout.template')

@push('css')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/client/clientBalance.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/forms.css')}}">
@endpush

@section('main_content')
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
        <div>
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
        <div class="right_buttons">
            <button id="PDFHandler">Download PDF</button>
        </div>
    </div>
@endsection

@push('javascript')
<script type="text/javascript" src="{{ URL::asset('js/client/updateMovementsBalance.js') }}"></script>
@endpush