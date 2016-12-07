@extends('auth.template')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/client/client.css')}}">
@endpush
@section('side-bar')
    <div class="side-bar">
        <h3>Cliente</h3>

        <br>
        <a href="#">Dados da Conta</a>
        <a href="#">Pagamentos</a>
        <div id="dropdown-payments" class="dropdown-content">
            <a href="/payments/services">Pagamento de Serviços</a>
            <a href="/payments/phone">Pagamento de Telemóveis</a>
            <a href="/payments/state">Pagamento ao Estado</a>
        </div>
        <a href="/client/transfers/">Transferências</a>
        <a href="#" >Poupanças</a>
        <div id="dropdown-saving" class="dropdown-content">
            <a href="/product/check/saving">Visualizar Poupanças</a>
            <a href="/product/create/saving">Constituir Poupança</a>
            <a href="#">Liquidar Poupança</a>
        </div>
        <a href="#" >Emprestimos</a>
        <a href="#" >Simulaçoes</a>
    </div>
@endsection