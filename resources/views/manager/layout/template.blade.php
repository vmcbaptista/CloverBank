@extends('auth.template')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/manager/manager.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/forms.css')}}">

@endpush

@section('side-bar')
        <div class="side-bar">
            <h3>Atendimento ao Publico</h3>

            <a>Contas Correntes</a>
            <div id="dropdown-current" class="dropdown-content">
                <a href="/account/add">Criar Conta</a>
                <a href="/account/activate">Ativar Contas</a>
                <a href="#">Link 3</a>
            </div>
            <a>Poupanças</a>
            <div id="dropdown-saving" class="dropdown-content">
                <a href="#">Link 1</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
            </div>
            <a href="#" >Emprestimos</a>
            <a href="#" >Simulaçoes</a>
            <a href="/deposits">Depósitos</a>
            <h3>Gestao</h3>
            <a>Produtos</a>
            <div id="dropdown-products" class="dropdown-content">
                <a href="/product/create">Criar Produto</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
            </div>
            <a href="#" >Site</a>
            <a href="#" >Random</a>
        </div>
@endsection