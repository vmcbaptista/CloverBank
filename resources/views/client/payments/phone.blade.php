@extends('client.payments.layout')
@section('payment_form')
    <label>Entidade</label>
    <input type="text" name="entity">
    @if ($errors->has('entity'))
        <span class="error">
            <strong>{{ $errors->first('entity') }}</strong>
        </span><br>
    @endif
    <label>Número de Telefone</label>
    <input type="text" id="phone_number" name="phone_number">
    @if ($errors->has('phone_number'))
        <span class="error">
            <strong>{{ $errors->first('phone_number') }}</strong>
        </span><br>
    @endif
    <label>Descrição</label>
    <input id="description" type="text" name="description">
    <label>Valor</label>
    <input id="amount" type="text" name="amount">
    @if ($errors->has('amount'))
        <span class="error">
            <strong>{{ $errors->first('amount') }}</strong>
        </span>
    @endif
@endsection