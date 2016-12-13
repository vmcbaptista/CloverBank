@extends('manager.layout.auth')

@section('content')
    <div class="container">
        <form class="manager-login-form" role="form" method="POST" action="{{ url('/manager/register') }}">
            {{ csrf_field() }}
            <a href="{{ url('/') }}">
                <img  src="/logo/horizontal_transparent.png">
            </a>
            <h4> Registar Gestor</h4>
            <input id="name" type="text" name="name" value="{{ old('name') }}" autofocus placeholder="Nome">

            @if ($errors->has('name'))
                <span class="error">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
            @endif
            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="E-mail">

            @if ($errors->has('email'))
                <span class="error">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
            @endif
            <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" placeholder="Número de Telefone">

            @if ($errors->has('phone'))
                <span class="error">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
            @endif
            <input id="nif" type="number" name="nif" value="{{ old('nif') }}" placeholder="Número de Contribuinte">

            @if ($errors->has('nif'))
                <span class="error">
                                        <strong>{{ $errors->first('nif') }}</strong>
                                    </span>
            @endif
            <button type="submit">
                Registar
            </button>
        </form>
    </div>
@endsection
