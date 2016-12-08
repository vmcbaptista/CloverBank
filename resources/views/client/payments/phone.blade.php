@extends('client.payments.layout')
@section('payment_form')
    <label>Entidade</label><br>
    <input type="text" name="entity"><br>
    <label>Número de Telefone</label><br>
    <input type="text" id="phone_number" name="phone_number"><br>
    <label>Descrição</label><br>
    <input id="description" type="text" name="description"><br>
    <label>Valor</label><br>
    <input id="amount" type="text" name="amount"><br>
@endsection