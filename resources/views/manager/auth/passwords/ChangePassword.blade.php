    @extends('manager.layout.template')

@push('css')
<link rel="stylesheet" type="text/css" href="/css/forms.css">
@endpush

@section('main_content')

    <div class="container">
        <form role="form" method="POST" action="{{ url('/manager/Passwords/ChangePassword/check') }}">
            <h3>Alterar Password</h3>
            <div class="form-wrapper">
                {{ csrf_field() }}
                <label for="password">Password atual</label>
                <input id="PasswordAtual" type="password" name="PasswordAtual">
                <label for="password"> Nova Password</label>
                <input id="Newpassword" type="password" name="Newpassword">
                <label for="password">Confirme Password</label>
                <input id="ConfirmNewpassword" type="password" name="ConfirmNewpassword">
                @if($ErroVerificacao!= 0||$ErroVerificacao != NULL)

                    @if($ErroVerificacao == 1)
                        <div class="error">
                            <p>Nao pode existir campos vazios</p>
                        </div>
                    @endif

                    @if($ErroVerificacao == 2)
                        <div class="error">
                            <p>O username introduzido nao existe</p>
                        </div>
                    @endif

                    @if($ErroVerificacao == 3)
                        <div class="error">
                            <p>A password atual encontra-se errada</p>
                        </div>
                    @endif

                    @if($ErroVerificacao == 4)
                        <div class="error">
                            <p>As novas passwords não são iguais,Tente novamente</p>
                        </div>

                    @endif
                @endif
            </div>
            <div class="right_buttons">
                <button type="submit" class="btn btn-primary">
                    Mudar
                </button>
            </div>
        </form>
    </div>
@endsection