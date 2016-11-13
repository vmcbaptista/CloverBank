<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gestor de Conta</title>
    <script type="text/javascript" src="{{ URL::asset('js/jquery-3.1.1.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/base.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/font-awesome.css')}}">
    @yield('css')
    @yield('head')
</head>
<body>
    @yield('upper-nav')
    @yield('nav-bar')
    @yield('side-bar')
    @yield('content')


    <script type="text/javascript" src="{{ URL::asset('js/manager/dropdown_navbar.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/manager/sidebar.js') }}"></script>

</body>
</html>