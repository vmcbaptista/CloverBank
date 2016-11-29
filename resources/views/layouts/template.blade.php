<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <script type="text/javascript" src="{{ URL::asset('js/jquery-3.1.1.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/base.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/login_form.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/font-awesome.css')}}">
    @stack('css')
    <title>CloverBank</title>
</head>
<body>
<div class="upper-nav">
    <ul class="brand-logo">
        <li>
            <a href="/">
                <img src="{{URL::asset('logo/clover_main.png')}}" />
            </a>
        </li>
    </ul>
    <ul class="slogan">
        <li><span>Give your money a lucky life</span></li>
    </ul>
</div>

<div class="nav-bar">
    <ul class="option-menu">
        <li><a class="link" href="/#our_company">A nossa instituição</a></li>
        <li><a class="link" href="/#products">Produtos</a></li>
        <li><a class="link" href="/help">Ajuda</a></li>

        @if (Auth::guard('client')->check() || Auth::guard('manager')->check())
            <li class="li_access">
                <div id="user-image">
                    <img style="height: 22px; width: 22px;" src="/img/user.png">
                </div>
                <a class="link" href="#">@if (Auth::guard('client')->check()) {{ Auth::guard('client')->user()->name }} @else {{ Auth::guard('manager')->user()->name }} @endif</a>
                <ul class="user-options">
                    <li><i class="fa fa-address-card-o" aria-hidden="true"></i> <span @if (Auth::guard('client')->check()) href="/client/profile" @else href="/manager/profile" @endif class="profile">Perfil</span> </li>
                    <li><i class="fa fa-cog" aria-hidden="true"></i>            <span @if (Auth::guard('client')->check()) href="/client/settings" @else href="/manager/settings" @endif class="settings">Definiçoes</span> </li>
                    <li class="bottom-logout" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i>
                        <span class="logout">Sair</span> </li>

                    <form id="logout-form" action="@if (Auth::guard('client')->check()) /client/logout @else /manager/logout @endif" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </ul>
            </li>
        @else
        <li class="li_access" id="openLogin"><a class="link" href="#"><i class="fa fa-lock" aria-hidden="true" ></i> Acesso Online </a></li>
        @endif
    </ul>
</div>

<div class="login_form" id="form_to_login" @if ($errors->has('username') || $errors->has('password')) style="display: flex" @endif>

    <form method="POST" action="{{ url('/client/login') }}">
        {{ csrf_field() }}
        <input name="username" placeholder="Nome Utilizador">
        <input name="password" type="password" placeholder="Palavra-Passe">
        <button type="submit">  <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
    </form>
    @if ($errors->has('username'))
        <span class="error">
                <strong>{{ $errors->first('username') }}</strong>
            </span>
    @endif
    @if ($errors->has('password'))
        <span class="error">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
    @endif
    <a class="forgotten_password" href="{{ url('/client/password/resetPassword') }}">Esqueceu a Palavra-Passe?</a>
    <div class="subBar_login">
        <a href="#"><i class="fa fa-mobile" aria-hidden="true"></i>
            Faça ja Download da nossa App</a>
        <a href="#"><i class="fa fa-shield" aria-hidden="true"></i>
            Medidas de Segurança</a>
        <a href="client/register">Ainda nao e cliente CloverBank?<span class="underline"> Adira Ja</span> </a>
    </div>
</div>
<div class="main-interface">
@yield('content')
</div>
<script type="text/javascript" src="{{ URL::asset('js/login_form.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/util/dropdown_navbar.js') }}"></script>
@stack('javascript')

</body>
</html>
