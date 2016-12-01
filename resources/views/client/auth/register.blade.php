@extends('layouts.template_guest')
@push('css')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/reset_password.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/client/register.css')}}">
@endpush
@section('reset')
    <div class="content">
        <div class="background-wrapping"></div>
    <form id="addCliForm" class="form-forgotten_password" method="POST" action="{{ url('/client/register') }}">
        <h4>Adira ao Clover Bank</h4>
        {{ csrf_field() }}

        <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Nome">

        @if ($errors->has('name'))
            <span class="error">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
        <input id="address" type="text" name="address" value="{{ old('address') }}" placeholder="Morada">

        @if ($errors->has('address'))
            <span class="error">
                <strong>{{ $errors->first('address') }}</strong>
            </span>
        @endif
        <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="E-mail">

        @if ($errors->has('email'))
            <span class="error">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" placeholder="Telefone">

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
        <button type="submit">Solicitar Conta</button>
    </form>
    </div>
@endsection

