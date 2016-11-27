@extends('manager.manager_template')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/manager/manager.css')}}">
@endsection

@section('upper-nav')
<div class="upper-nav">
    <ul class="brand-logo">
        <li><img src="{{URL::asset('logo/clover_main.png')}}" /></li>
    </ul>
    <ul class="slogan">
        <li><span>Give your money a lucky life</span></li>
    </ul>
</div>
@endsection

@section('nav-bar')
    <div class="nav-bar">
        <ul class="option-menu">
            <li><a class="link" href="#">A nossa instituição</a></li>
            <li><a class="link" href="#">Particulares</a></li>
            <li><a class="link" href="#">Empresas</a></li>
            <li><a class="link" href="#">Ajuda</a></li>
            <li class="li_access">
                <div id="user-image">
                    <img style="height: 22px; width: 22px;" src="/img/user.png">
                </div>
                <a class="link" href="#"> {{ Auth::user()->name }} </a>
                <ul class="user-options">
                    <li><i class="fa fa-address-card-o" aria-hidden="true"></i> <span class="profile">Perfil</span> </li>
                    <li><i class="fa fa-cog" aria-hidden="true"></i>            <span href="/manager/passwords/ChangePassword" class="settings">Definiçoes</span> </li>
                    <li class="bottom-logout"><i class="fa fa-sign-out" aria-hidden="true"
                                                 onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();"></i>
                        <span class="logout">Sair</span> </li>

                    <form id="logout-form" action="{{ url('/manager/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </ul>
            </li>

        </ul>
    </div>
@endsection

@section('side-bar')
    <div class="main-interface">
        <div class="side-bar">
            <h3>Atendimento ao Publico</h3>

            <a href="#" >Contas Correntes</a>
            <div id="dropdown-current" class="dropdown-content">
                <a href="/account/add">Criar Conta</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
            </div>
            <a href="#" >Poupanças</a>
            <div id="dropdown-saving" class="dropdown-content">
                <a href="#">Link 1</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
            </div>
            <a href="#" >Emprestimos</a>
            <a href="#" >Simulaçoes</a>
            <h3>Gestao</h3>
            <a href="#" >Produtos</a>
            <div id="dropdown-products" class="dropdown-content">
                <a href="/product/create">Criar Produto</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
            </div>
            <a href="#" >Site</a>
            <a href="#" >Random</a>
        </div>
@endsection

@section('content')

<div class="container">
    <a href="">Criar Conta</a>
    <br>
    <a href="">Criar Produtos</a>
    <br>
    <a href="#">Efetuar Depósito</a>
    <br>
    <a href="">Mudar Password</a>

    <br>
</div>
@endsection
