@extends('auth.template')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/client/client.css')}}">
@endpush
@section('side-bar')
    <div class="side-bar">
        <h3><a href="/client/home">Área de Cliente</a></h3>

        <br>
        <a>Contas à Ordem</a>
        <div id="dropdown-accounts" class="dropdown-content">
            <a href="/client/home">Saldo e Movimentos</a>
            <a href="/client/accounts">Dados das contas</a>
        </div>
        <a href="#">Pagamentos</a>
        <div id="dropdown-payments" class="dropdown-content">
            <a href="/payments/services">Pagamento de Serviços</a>
            <a href="/payments/phone">Pagamento de Telemóveis</a>
            <a href="/payments/state">Pagamento ao Estado</a>
        </div>
        <a href="/client/transfers/">Transferências</a>
        <a href="#" >Poupanças</a>
        <div id="dropdown-saving" class="dropdown-content">
            <a href="/product/create/saving">Constituir Depósito</a>
            <a href="#">Link 2</a>
            <a href="#">Link 3</a>
        </div>
        <a href="#" >Emprestimos</a>
        <a href="#" >Simulaçoes</a>
    </div>
@endsection