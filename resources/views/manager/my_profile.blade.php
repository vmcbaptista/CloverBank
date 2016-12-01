@extends('manager.layout.template')


@push('css')
    <link rel="stylesheet" href="{{ URL::asset('css/manager/myProfile.css') }}">
@endpush

@section('main_content')
    <div class="container">
        <div class="picture-wrapper">
            <div class="pic-box">
                <img src="/img/user.png">
            </div>
        </div>
        <div class="person-wrapper">
            <div class="person-box">
                <div class="person-info">
                    <span> Olá {{Auth::guard('manager')->user()->name}}. </span>
                    <br>
                    <span> Este é o seu perfil pessoal.</span>
                    <span> Neste espaço poderá ter acesso à sua informação pessoal.</span>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="column">
                            <h3><i class="fa fa-envelope-o" aria-hidden="true"></i> E-mail: </h3>
                            <span>{{Auth::guard('manager')->user()->email}}</span>
                        </div>
                        <div class="column">
                            <h3><i class="fa fa-mobile" aria-hidden="true"></i> Telefone: </h3>
                            <span>{{Auth::guard('manager')->user()->phone}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column">
                            <h3><i class="fa fa-id-card-o" aria-hidden="true"></i> NIF: </h3>
                            <span>{{Auth::guard('manager')->user()->nif}}</span>
                        </div>
                        <div class="column">
                            <h3><i class="fa fa-clock-o" aria-hidden="true"></i> Ùltimo Acesso: </h3>
                            <span>{{Auth::guard('manager')->user()->last_login}}</span>
                        </div>
                    </div>

                    <div class="row">
                        <input type="submit" name="generate_card" id="generate_card" value="Gerar Cartão de Contacto">
                        <input type="submit" name="add_pic" id="add_pic" value="Adicionar Foto">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
<script src=""></script>
@endpush