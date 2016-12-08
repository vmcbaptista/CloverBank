@extends('client.layout.template')
@push('css')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/client/clientBalance.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/forms.css')}}">
@endpush
@section('main_content')
    <div class="container">
        <form method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="accountBalanceBar">
                <label>Conta a Debitar</label><br>
                <select id="account" name="account">
                    @foreach($accounts as $account)
                        <option>{{ $account->id }}</option>
                    @endforeach
                </select><br>
                <label id="balanceLabel">Saldo</label><span id="balance"></span>
            </div>
            <div class="form-wrapper">
            @yield('payment_form')
            </div>
                <div class="right_buttons">
                    <input id="submit" type="submit" value="Criar novo pagamento">
                </div>
        </form>
    </div>
@endsection
@push('javascript')
<script type="text/javascript" src="{{ URL::asset('js/client/updateMovementsBalance.js') }}"></script>
@endpush