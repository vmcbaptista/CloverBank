<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gestor de Conta</title>
    <script type="text/javascript" src="{{ URL::asset('js/jquery-3.1.1.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/base.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/font-awesome.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/manager/manager.css')}}">
</head>
<body>

<div class="upper-nav">
    <ul class="brand-logo">
        <li><img src="{{URL::asset('logo/clover_main.jpg')}}" /></li>
    </ul>
    <ul class="slogan">
        <li><span>Give your money a lucky life</span></li>
    </ul>
</div>
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
                <a class="link" href="#">Utilizador X</a>
                <ul class="user-options">
                    <li><i class="fa fa-address-card-o" aria-hidden="true"></i> <span class="profile">Perfil</span> </li>
                    <li><i class="fa fa-cog" aria-hidden="true"></i>            <span class="settings">Definiçoes</span> </li>
                    <li class="bottom-logout"><i class="fa fa-sign-out" aria-hidden="true"></i>       <span class="logout">Sair</span> </li>
                </ul>
            </li>

        </ul>
    </div>
    <div class="side-bar">
        <h3>Atendimento ao Publico</h3>

        <a href="#" >Contas Correntes</a>
        <div id="dropdown-current" class="dropdown-content">
            <a href="#">Link 1</a>
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
            <a href="#">Link 1</a>
            <a href="#">Link 2</a>
            <a href="#">Link 3</a>
        </div>
        <a href="#" >Site</a>
        <a href="#" >Random</a>
    </div>



    <script type="text/javascript" src="{{ URL::asset('js/manager/dropdown_navbar.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/manager/sidebar.js') }}"></script>

</body>
</html>