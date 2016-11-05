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

    <div class="nav-bar">
        <ul class="option-menu">
            <li><a class="link" href="#">A nossa instituição</a></li>
            <li><a class="link" href="#">Particulares</a></li>
            <li><a class="link" href="#">Empresas</a></li>
            <li><a class="link" href="#">Ajuda</a></li>
            <li class="li_access"><a class="link" href="#"><i class="fa fa-lock" aria-hidden="true"></i> Acesso Online </a></li>
        </ul>
    </div>

    <div class="slider-container">
        <div class="slide fade">
            <img src="{{URL::asset('img/credit_card.jpg')}}">
        </div>

        <div class="slide fade">
            <img src="{{URL::asset('img/6817014-image.jpg')}}">
        </div>

        <div class="slide fade">
            <img src="{{URL::asset('img/money.jpg')}}">
        </div>

        <a class="prev-btt" onclick="previous_slide(-1)">&#10094;</a>
        <a class="next-btt" onclick="next_slide(1)">&#10095;</a>

        <div class="dots">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>

    </div>

    <!--@yield('menu')-->
    <!--@yield('content')-->

    <script type="text/javascript" src="{{ URL::asset('js/slider.js') }}"></script>

</body>
</html>
