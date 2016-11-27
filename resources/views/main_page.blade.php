@extends('template')


@section('css')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/our_company.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/products.css')}}">

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
    <div id="our_company" class="our_company">
        <h1>O nosso banco</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id mattis risus, non tristique tellus. In non felis nec diam varius mollis. Praesent elit enim, blandit ac risus ac, lobortis efficitur nisl. Sed ultricies faucibus risus at iaculis. Proin condimentum dolor metus, vitae posuere augue rutrum non. Curabitur quis risus nec ex pellentesque feugiat. Praesent sed nulla sit amet libero porttitor eleifend sed eu neque. Vestibulum vel maximus orci. Sed eu odio varius nulla accumsan hendrerit nec eget nulla. Quisque condimentum, turpis quis malesuada fermentum, augue nibh tincidunt lorem, quis vehicula eros dui vitae neque. Quisque tempor efficitur mi, eu dignissim turpis ullamcorper quis. In sed pretium tortor. Vivamus faucibus augue velit. In hac habitasse platea dictumst.
        </p>
    </div>
@endsection

@section('products')
    <div id="products" class="products">
        <div class="currents">
            <div class="circle-img">
                <a href="products/current"><img src="/img/wallet.svg"></img></a>

            </div>
            <h1><a href="products/current">Contas à Ordem</a></h1>
        </div>

        <div class="savings">
            <div class="circle-img">
                <a href="products/savings"><img src="/img/piggy-bank.svg"></img></a>
            </div>
            <h1><a href="products/savings">Contas Poupança</a></h1>
        </div>

        <div class="loans">
            <div class="circle-img">
                <a href="products/loans"><img src="/img/loan.svg"></img></a>
            </div>
            <h1><a href="products/loans">Créditos</a></h1>
        </div>

    </div>
@endsection

@section('simulator')
    <input type="radio"> James
    <input type="radio"> James
    <input type="radio"> James

@endsection

@section('contacts')

@endsection

@section('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/slider.js') }}"></script>
@endsection