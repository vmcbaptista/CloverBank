@extends('manager.layout.auth')

@section('content')
    {{ var_dump(Auth::user())}}
<div class="container">
    <a href="/account/add">Criar Conta</a>
    <br>
    <a href="#">Criar Produtos</a>
    <br>
    <a href="#">Efetuar Depósito</a>
    <br>
    <a href="/manager/passwords/ChangePassword">Mudar Password</a>

    <br>
</div>
@endsection
