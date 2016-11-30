@extends('layouts.template_guest')


@push('css')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/reset_password.css')}}">
@endpush

@section('reset')
<div class="content">
    <div class="background-wrapping"></div>
    <!--Ask for password-->
    @if($VerificationStep==0)
        <form  class="form-forgotten_password" method="POST" action="{{ url('/client/passwords/resetPassword/verification') }}">
            {{ csrf_field() }}
                <h4> Esqueceu a palavra-passe</h4>

                <input class="email" type="text" name="EmailClient" placeholder="Email" >

                @if($ErroVerification == 1)
                    <div class="error">
                            <p>Nao podem existir campos vazios</p>
                    </div>
                @endif
                @if($ErroVerification == 2)
                    <div class="error">
                            <p >Não existe nenhuma conta associada com o email introduzido</p>
                    </div>
                @endif
                <button type="submit" class="">Continuar</button>
        </form>
    @endif
    <!--Code insertion-->
    @if($VerificationStep==1)
        <form class="form-forgotten_password" method="POST" action="{{ url('/client/passwords/resetPassword/Codeverification') }}">
            {{ csrf_field() }}
                <h4> Esqueceu a palavra-passe</h4>

                <input id="verificationCode" type="text" class="form-control" name="verificationCode" placeholder="Código de verificação">


                @if($ErroVerification == 1)
                    <div class="error">
                        <p>Nao podem existir campos vazios</p>
                    </div>
                @endif
                @if($ErroVerification == 2)
                    <div class="error">
                        <p>O código de verificação introduzido está incorreto</p>
                    </div>
                @endif
                <button type="submit" >Continuar</button>
        </form>
    @endif


    <!-- New pasword defenition -->
    @if($VerificationStep==2)
        <form class="form-forgotten_password" method="POST" action="{{ url('/client/passwords/resetPassword/NewPassword') }}">
            {{ csrf_field() }}
                <h4> Esqueceu a palavra-passe</h4>
                <input class="password" id="newpassword" type="password" class="form-control" name="Newpassword" placeholder="Nova palavra-passe">
                <input class="password"  id="ConfirmNewpassword" type="password" class="form-control" name="ConfirmNewpassword"  placeholder="Confirme palavra-passe">

            @if($ErroVerification == 1)
                <div class="error">
                        <p>Nao pode existir campos vazios</p>
                </div>
            @endif
            @if($ErroVerification == 2)
                <div class="error">
                        <p>As passwords introduzidas não correspondem</p>
                </div>
            @endif
            <button type="submit">Continuar</button>
        </form>
    @endif


    <!-- Show the user that the procedure was ok -->
    @if($VerificationStep==3)
        <div class="form-forgotten_password">
            <h4> Esqueceu a palavra-passe</h4>
            <h5> A sua palavra-passe foi redefinida</h5>
            <button id="loginBt" >Clique para que possa fazer login</button>
        </div>
    @endif
</div>
@endsection

@push('javascript')
                <script type="text/javascript" src="{{ URL::asset('js/forgotten_password_show_login.js') }}"></script>
@endpush