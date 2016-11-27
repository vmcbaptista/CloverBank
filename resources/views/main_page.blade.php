@extends('template')


@section('css')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/our_company.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/products.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/contacts.css')}}">

@endsection

@section('slider')
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
@endsection

@section('about_us')
    <div class="our_company">
        <h1>O nosso banco</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id mattis risus, non tristique tellus. In non felis nec diam varius mollis. Praesent elit enim, blandit ac risus ac, lobortis efficitur nisl. Sed ultricies faucibus risus at iaculis. Proin condimentum dolor metus, vitae posuere augue rutrum non. Curabitur quis risus nec ex pellentesque feugiat. Praesent sed nulla sit amet libero porttitor eleifend sed eu neque. Vestibulum vel maximus orci. Sed eu odio varius nulla accumsan hendrerit nec eget nulla. Quisque condimentum, turpis quis malesuada fermentum, augue nibh tincidunt lorem, quis vehicula eros dui vitae neque. Quisque tempor efficitur mi, eu dignissim turpis ullamcorper quis. In sed pretium tortor. Vivamus faucibus augue velit. In hac habitasse platea dictumst.
        </p>
    </div>
@endsection

@section('products')
    <div class="products">
        <div class="particular">
            <div class="circle-img">

            </div>
            <h1>Particulares</h1>
        </div>

        <div class="enterprise">
            <div class="circle-img">

            </div>
            <h1>Empresarial</h1>
        </div>

    </div>
@endsection

@section('simulator')
    <input type="radio"> James
    <input type="radio"> James
    <input type="radio"> James

@endsection

@section('contacts')
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
@endsection

@section('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/slider.js') }}"></script>
@endsection