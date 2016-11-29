@extends('layouts.template_guest')
@section('content')
    <form id="addCliForm" class="form-horizontal" role="form" method="POST" action="{{ url('/client/register') }}">
        {{ csrf_field() }}

        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
        <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" autofocus>

        @if ($errors->has('address'))
            <span class="help-block">
                <strong>{{ $errors->first('address') }}</strong>
            </span>
        @endif
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        <input id="phone" type="tel" class="form-control" name="phone" value="{{ old('phone') }}">

        @if ($errors->has('phone'))
            <span class="help-block">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
        <input id="nif" type="number" class="form-control" name="nif" value="{{ old('nif') }}">

        @if ($errors->has('nif'))
            <span class="help-block">
                <strong>{{ $errors->first('nif') }}</strong>
            </span>
        @endif
        <button type="submit" class="btn btn-primary">
            Register
        </button>
    </form>
@endsection

