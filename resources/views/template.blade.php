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

    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/contacts.css')}}">

    @yield('css')
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

        @yield('products_list')

        @yield('help')
    <div class="contacts-container">
        <h3>Quer falar connosco?</h3>
        <ul class="contacts">
            <li>
                <div class="icon-contact">
                    <i class="fa fa-user-o fa-2x" aria-hidden="true"></i>
                </div>
                <div class="contact_msg">
                    <p>Nos Ligamos</p>
                    <p> Deixe-nos o seu contacto e nos ligamos-lhe</p>
                </div>
            </li>
            <li>
                <div class="icon-contact">
                    <i class="fa fa-map-marker fa-2x" aria-hidden="true"></i>
                </div>

                <div class="contact_msg">
                    <p>Nos nossos Balcoes</p>
                    <p>Encontre-nos num balcao perto de si</p>
                </div>
            </li>
            <li>
                <div class="icon-contact">
                    <i class="fa fa-comments fa-2x" aria-hidden="true"></i>
                </div>
                <div class="contact_msg">
                    <p>O nosso chat</p>
                    <p> Todos os dias 24/7 </p>
                </div>
            </li>
            <li>
                <div class="icon-contact">
                    <i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i>
                </div>
                <div class="contact_msg">
                    <p>Por email</p>
                    <p>Pelo nosso email</p>
                </div>
            </li>
            <li>
                <div class="icon-contact">
                    <i class="fa fa-mobile fa-2x" aria-hidden="true"></i>
                </div>
                <div class="contact_msg">
                    <p>700 000 000</p>
                    <p>Atendimento a medida 24/7</p>
                </div>
            </li>

        </ul>

        <div class="social_networks">
            <a href="https://www.facebook.com"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="https://www.twitter.com"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
            <a href="https://www.youtube.com"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
            <a href="https://plus.google.com"><i class="fa fa-google-plus-official" aria-hidden="true"></i></a>
            <a href="https://www.linkedin.com/"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
        </div>
    </div>

        <script type="text/javascript" src="{{ URL::asset('js/login_form.js') }}"></script>
        @yield('javascript')

</body>
</html>
