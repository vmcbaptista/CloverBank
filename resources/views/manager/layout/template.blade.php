@extends('auth.template')

@push('css')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/manager/manager.css')}}">

@endpush

@section('side-bar')
    <div class="side-bar">
        <h3><a href="/manager/home">Área do Gestor</a></h3>


        <a href="/account/add">Criar Conta</a>
        <a href="/account/activate">Ativar Contas</a>

        <a href="/product/create">Criar Produto</a>

    </div>
@endsection