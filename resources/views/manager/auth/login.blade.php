@extends('manager.manager_template')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/manager/manager_login.css')}}">
@endsection


@section('content')
    <div class="container">

        <form class="manager-login-form" method="POST" action="{{ url('/manager/login') }}">
            {{ csrf_field() }}
            <a href="{{ url('/') }}">
                <img  src="/logo/horizontal_transparent.png">
            </a>
            <input id="username"  class="" name="username" value="{{ old('username') }}" autofocus placeholder="Utilizador">
            @if ($errors->has('username'))
                <span class="error">
                <strong>{{ $errors->first('username') }}</strong>
            </span>
            @endif
            <input id="password" type="password" class="" name="password" placeholder="Password">
            @if ($errors->has('password'))
                <span class="error">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <div clasS="remenber-me">
                <input type="checkbox" name="remember"><span class="rem-font">Lembrar-me</span>
            </div>
            <button type="submit" class="">Login</button>
            <div class="wrap_password_forgot">
                <a href="{{ url('/manager/password/resetPassword') }}">
                    Esqueci a palavra-passe.
                </a>
            </div>
        </form>
    </div>
@endsection
