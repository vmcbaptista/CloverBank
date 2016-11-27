<!DOCTYPE html>
<html lang="en">
<head>
    <title>CloverBank - Cliente</title>
    <script type="text/javascript" src="{{ URL::asset('js/jquery-3.1.1.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/base.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/font-awesome.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/forms.css')}}">

    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/client/client.css')}}">
    @yield('css')
</head>
<body>

<div class="upper-nav">
    <ul class="brand-logo">
            <li>
                <a href="/client/home"><img src="{{URL::asset('logo/clover_main.jpg')}}" />  </a>
            </li>
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
                <a class="link" href="#"> {{ Auth::guard('client')->user()->name }} </a>
                <ul class="user-options">
                    <li><i class="fa fa-address-card-o" aria-hidden="true"></i> <span class="profile">Perfil</span> </li>
                    <li><i class="fa fa-cog" aria-hidden="true"></i>            <span href="/client/passwords/ChangePassword" class="settings">Definiçoes</span> </li>
                    <li class="bottom-logout"><i class="fa fa-sign-out" aria-hidden="true"
                                                 onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();"></i>
                        <span class="logout">Sair</span> </li>

                        <form id="logout-form" action="{{ url('/client/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                </ul>
            </li>

        </ul>
    </div>
    <div class="main-interface">
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
                <a href="#">Link 1</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
            </div>
            <a href="#" >Emprestimos</a>
            <a href="#" >Simulaçoes</a>
        </div>
        @yield('content')

    </div>

    <script type="text/javascript" src="{{ URL::asset('js/manager/dropdown_navbar.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/manager/sidebar.js') }}"></script>
    @yield('js')
</body>
</html>