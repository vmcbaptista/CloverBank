@extends('manager.layout.template')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/manager/manager.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/manager/home.css')}}">
@endpush

@section('main_content')
    <div class="container">
            <div class="row">
                <div class="square column grayblue">
                    <p><span id="numcli">0</span></p>
                    <p>Número Clientes</p>
                    <p><i class="fa fa-user" aria-hidden="true"></i></p>
                </div>
                <div class="square column pink">
                    <p><span id="numwaiting">0</span></p>
                    <p>Contas em Espera de Ativação</p>
                    <p><i class="fa fa-lock" aria-hidden="true"></i></p>
                </div>
                <div class="square column yellow">
                    <p><span id="allmoney">0</span></p>
                    <p>Capital Total</p>
                    <p><i class="fa fa-eur" aria-hidden="true"></i></p>
                </div>
            </div>
            <div class="row">
                <div class="square column blue">
                    <p><span id="accnum">0</span></p>
                    <p>Número Contas</p>
                </div>
                <div class="square column green ">
                    <p><span id="accsav">0</span></p>
                    <p>Produtos Prazo</p>
                </div>
                <div class="square column orange">
                    <p><span id="accloan">0</span></p>
                    <p>Número Emprestímos</p>
                </div>
            </div>
    </div>
@endsection


@push('javascript')
    <script src=""></script>
@endpush