<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="{{ URL::asset('js/jquery-3.1.1.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/base.css')}}">

    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/slider.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/login_form.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/font-awesome.css')}}">

    @yield('css')
    <title>CloverBank</title>
</head>
<body>
    <div class="upper-nav">
        <ul class="brand-logo">
            <li>
                <a href="/">
                    <img src="{{URL::asset('logo/clover_main.jpg')}}" />
                </a>
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
                <li class="li_access" id="openLogin"><a class="link" href="#"><i class="fa fa-lock" aria-hidden="true" ></i> Acesso Online </a></li>
            </ul>
        </div>

        <div class="login_form" id="form_to_login">

            <form method="POST" action="{{ url('/client/login') }}">
                {{ csrf_field() }}
                <input name="username" placeholder="Nome Utilizador">
                <input name="password" type="password" placeholder="Palavra-Passe">
                <button type="submit">  <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
            </form>

            <a class="forgotten_password" href="{{ url('/client/password/resetPassword') }}">Esqueceu a Palavra-Passe?</a>
            <div class="subBar_login">
                <a href="#"><i class="fa fa-mobile" aria-hidden="true"></i>
                    Faça ja Download da nossa App</a>
                <a href="#"><i class="fa fa-shield" aria-hidden="true"></i>
                    Medidas de Segurança</a>
                <a href="client/register">Ainda nao e cliente CloverBank?<span class="underline"> Adira Ja</span> </a>
            </div>
        </div>

        @yield('slider')
        @yield('menu')
        @yield('about_us')
        @yield('products')
        @yield('simulator')
        @yield('contacts')
        @yield('content')

        @yield('help')


        <script type="text/javascript" src="{{ URL::asset('js/login_form.js') }}"></script>
        @yield('javascript')

</body>
</html>
