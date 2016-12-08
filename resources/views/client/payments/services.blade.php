@extends('client.payments.layout')
@section('payment_form')
    <label>Entidade</label><br>
    <input type="text" name="entity"><br>
    <label>Referência</label><br>
    <input type="text" id="reference" name="reference"><br>
    <label>Descrição</label><br>
    <input id="description" type="text" name="description"><br>
    <label>Valor</label><br>
    <input id="amount" type="text" name="amount"><br>
@endsection