@extends('template')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/help.css')}}">
@endsection



@section('help')
    <div class="title">
        <h2>Ajuda</h2>
    </div>
    <div class="container-help">
        <div class="container-faq">
            <h3>Lorem ipsum dolor sit amet</h3>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sollicitudin justo eu hendrerit pretium. Proin et quam odio. Nunc ullamcorper sapien dui, a rutrum sapien malesuada eu. Etiam lobortis odio pulvinar eros vehicula, ultricies rhoncus neque dapibus. Sed aliquet ipsum quis porttitor semper. Morbi a ex porta, fringilla turpis eu, luctus enim. Donec a eros eget dolor lobortis sollicitudin. Donec vehicula diam nunc, ut luctus ipsum varius a. Praesent congue lectus nec aliquam fermentum. Etiam non porttitor tortor. Phasellus dictum felis massa, non porta sem venenatis sed. Sed vitae magna non arcu vehicula pretium sit amet et lectus. Ut turpis nulla, volutpat sed dolor vel, vulputate posuere ligula. Etiam auctor rhoncus odio.
            </p>
        </div>
    </div>

    <div class="container-help">
        <div class="container-faq">
            <h3>Lorem ipsum dolor sit amet</h3>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sollicitudin justo eu hendrerit pretium. Proin et quam odio. Nunc ullamcorper sapien dui, a rutrum sapien malesuada eu. Etiam lobortis odio pulvinar eros vehicula, ultricies rhoncus neque dapibus. Sed aliquet ipsum quis porttitor semper. Morbi a ex porta, fringilla turpis eu, luctus enim. Donec a eros eget dolor lobortis sollicitudin. Donec vehicula diam nunc, ut luctus ipsum varius a. Praesent congue lectus nec aliquam fermentum. Etiam non porttitor tortor. Phasellus dictum felis massa, non porta sem venenatis sed. Sed vitae magna non arcu vehicula pretium sit amet et lectus. Ut turpis nulla, volutpat sed dolor vel, vulputate posuere ligula. Etiam auctor rhoncus odio.
            </p>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/help.js') }}"></script>
@endsection