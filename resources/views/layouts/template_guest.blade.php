@extends('layouts.template')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/contacts.css')}}">
@endpush
@section('content')

    @yield('slider')
    @yield('about_us')
    @yield('products')
    @yield('simulator')
    @yield('products_list')
    @yield('help')
    @yield('reset')
<div class="contacts-container">
    <h3>Quer falar connosco?</h3>
    <ul class="contacts">
        <li>
            <div class="icon-contact">
                <i class="fa fa-user-o fa-2x" aria-hidden="true"></i>
            </div>
            <div class="contact_msg min-size-2">
                <p>Nos Ligamos</p>
                <p> Deixe-nos o seu contacto e nos ligamos-lhe</p>
            </div>
        </li>
        <li>
            <div class="icon-contact">
                <i class="fa fa-map-marker fa-2x" aria-hidden="true"></i>
            </div>

            <div class="contact_msg  min-size">
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
            <div class="contact_msg min-size">
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