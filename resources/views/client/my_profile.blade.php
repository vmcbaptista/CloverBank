@extends('client.layout.template')


@push('css')
<link rel="stylesheet" href="{{ URL::asset('css/forms.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/myProfile.css') }}">
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
                    <span> Olá {{Auth::guard('client')->user()->name}}. </span>
                    <br>
                    <span> Este é o seu perfil pessoal.</span>
                    <span> Neste espaço poderá ter acesso à sua informação pessoal.</span>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="column">
                            <h3><i class="fa fa-envelope-o" aria-hidden="true"></i> E-mail: </h3>
                            <span>{{Auth::guard('client')->user()->email}}</span>
                        </div>
                        <div class="column">
                            <h3><i class="fa fa-mobile" aria-hidden="true"></i> Telefone: </h3>
                            <span>{{Auth::guard('client')->user()->phone}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column">
                            <h3><i class="fa fa-id-card-o" aria-hidden="true"></i> NIF: </h3>
                            <span>{{Auth::guard('client')->user()->nif}}</span>
                        </div>
                        <div class="column">
                            <h3><i class="fa fa-map-marker" aria-hidden="true"></i> Morada: </h3>
                            <span>{{Auth::guard('client')->user()->address}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column">
                            <h3><i class="fa fa-clock-o" aria-hidden="true"></i> Ùltimo Acesso: </h3>
                            <span>{{Auth::guard('client')->user()->last_login}}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column">
                            <input type="submit" name="add_pic" id="add_pic" value="Adicionar Foto">
                            <form action="/client/changePersonalData">
                            <input type="submit" name="change_personal_data" id="change_personal_data" value="Alterar Dados Pessoais">
                            </form>
                            <form action="/client/passwords/ChangePassword">
                            <input type="submit" name="change_password" id="change_personal_data" value="Alterar Password">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
<script src=""></script>
@endpush