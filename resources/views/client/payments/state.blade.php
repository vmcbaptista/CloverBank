@extends('client.payments.layout')
@section('payment_form')
    <label>Referência</label>
    <input type="text" id="reference" name="reference">
    @if ($errors->has('reference'))
        <span class="error">
            <strong>{{ $errors->first('reference') }}</strong>
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