<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="{{ URL::asset('js/jquery-3.1.1.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/base.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/font-awesome.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/slider.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/login_form.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/our_company.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/products.css')}}">
    <title>CloverBank</title>
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

    @include('main_page')
    @yield('nav-bar')
    @yield('slider')

    <!--@yield('menu')-->
    <!--@yield('content')-->

    <script type="text/javascript" src="{{ URL::asset('js/slider.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/login_form.js') }}"></script>

</body>
</html>
