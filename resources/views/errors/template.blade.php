<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <script type="text/javascript" src="{{ URL::asset('js/jquery-3.1.1.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/error.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/font-awesome.css')}}">
    @stack('css')
    <title>CloverBank</title>
</head>
<body>
<header>
    @yield('header')
</header>
<div class="container-error">
    @yield('error_message')
    <button>Voltar atrás</button>
</div>
<footer>
    <img src="/logo/white.png">
</footer>
</body>
<script>
    $("button").click(function () {
       parent.history.back();
    });
</script>
</html>

