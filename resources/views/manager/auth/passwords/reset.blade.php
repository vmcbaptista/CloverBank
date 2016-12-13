@extends('manager.layout.auth')

@section('content')
    <div class="container">
        @if($VerificationStep==0)
            <form class="manager-login-form" role="form" method="POST" action="{{ url('/manager/passwords/resetPassword/verification') }}">
                {{ csrf_field() }}
                <a href="{{ url('/') }}">
                    <img  src="/logo/horizontal_transparent.png">
                </a>
                <h4>Recuperar Palavra-passe</h4>
                <input id="Email" type="text" class="form-control" name="EmailManager" required placeholder="E-mail">
                @if($ErroVerification == 1)
                    <span class="error">
                        <strong>Não podem existir campos vazios</strong>
                    </span>
                @endif
                @if($ErroVerification == 2)
                    <span class="error">
                        <strong>Não existe nenhuma conta associada com o email introduzido</strong>
                    </span>
                @endif
                <button type="submit">
                    Continuar
                </button>

            </form>
        @endif
        @if($VerificationStep==1)
            <form class="manager-login-form" role="form" method="POST" action="{{ url('/manager/passwords/resetPassword/Codeverification') }}">
                {{ csrf_field() }}
                <a href="{{ url('/') }}">
                    <img  src="/logo/horizontal_transparent.png">
                </a>
                <h4>Recuperar Palavra-passe</h4>
                <p>Por favor insira o código de verificação que foi enviado para o seu e-mail</p>
                <input id="verificationCode" type="text" class="form-control" name="verificationCode" required placeholder="Código de Verificação">
                @if($ErroVerification == 1)
                    <span class="error">
                        <strong>Não podem existir campos vazios</strong>
                    </span>
                @endif
                @if($ErroVerification == 2)
                    <span class="error">
                        <strong>O código de verificação introduzido está incorreto</strong>
                    </span>
                @endif
                <button type="submit">
                    Continuar
                </button>
    </div>
    </div>
    </form>

    @endif
    @if($VerificationStep==2)
        <form class="manager-login-form" role="form" method="POST" action="{{ url('/manager/passwords/resetPassword/NewPassword') }}">
            {{ csrf_field() }}
            <a href="{{ url('/') }}">
                <img  src="/logo/horizontal_transparent.png">
            </a>
            <h4>Recuperar Palavra-passe</h4>
            <input id="Newpassword" type="password" class="form-control" name="Newpassword" required placeholder="Nova Passowrd">
            <input id="ConfirmNewpassword" type="password" class="form-control" name="ConfirmNewpassword"  required placeholder="Confirme a Password">
            @if($ErroVerification == 1)
                <span class="error">
                    <strong>Não podem existir campos vazios</strong>
                </span>
            @endif
            @if($ErroVerification == 2)
                <span class="error">
                    <strong>As passwords introduzidas não correspondem</strong>
                </span>
            @endif
            <button type="submit">
                Continuar
            </button>
        </form>
    @endif
    @if($VerificationStep==3)
        <p style = "color: green ">A sua password foi alterada com sucesso!</p>
        <a href="http://localhost:8000/manager/login">Login </a>
    @endif


@endsection
