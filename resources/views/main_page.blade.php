@extends('template')


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
        <h1>A Nossa Empresa</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id mattis risus, non tristique tellus. In non felis nec diam varius mollis. Praesent elit enim, blandit ac risus ac, lobortis efficitur nisl. Sed ultricies faucibus risus at iaculis. Proin condimentum dolor metus, vitae posuere augue rutrum non. Curabitur quis risus nec ex pellentesque feugiat. Praesent sed nulla sit amet libero porttitor eleifend sed eu neque. Vestibulum vel maximus orci. Sed eu odio varius nulla accumsan hendrerit nec eget nulla. Quisque condimentum, turpis quis malesuada fermentum, augue nibh tincidunt lorem, quis vehicula eros dui vitae neque. Quisque tempor efficitur mi, eu dignissim turpis ullamcorper quis. In sed pretium tortor. Vivamus faucibus augue velit. In hac habitasse platea dictumst.
        </p>
    </div>
@endsection

@section('products')
    <div class="particular">
        <h1>Particulares</h1>
        <div class="product_type_row">
            <div class="product_type current">Contas</div>
            <div class="product_type loan">Poupanças</div>
            <div class="product_type saving">Creditos</div>
        </div>
    </div>
    <div class="enterprise">
        <h1>Empresarial</h1>
        <div class="product_type_row">
            <div class="product_type enterprise_current">Contas</div>
            <div class="product_type enterprise_loan">Poupanças</div>
            <div class="product_type enterprise_saving">Creditos</div>
        </div>
    </div>
@endsection