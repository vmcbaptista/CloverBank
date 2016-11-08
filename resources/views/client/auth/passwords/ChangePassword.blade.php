@extends('manager.layout.auth')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Mudar Password</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/client/Passwords/ChangePassword/check') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password atual</label>

                                <div class="col-md-6">
                                    <input id="PasswordAtual" type="password" class="form-control" name="PasswordAtual" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label"> Nova Password</label>

                                <div class="col-md-6">
                                    <input id="Newpassword" type="password" class="form-control" name="Newpassword" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Confirme Password</label>

                                <div class="col-md-6">
                                    <input id="ConfirmNewpassword" type="password" class="form-control" name="ConfirmNewpassword"  required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Mudar
                                    </button>
                                </div>
                            </div>
                            @if($ErroVerificacao!= 0||$ErroVerificacao != NULL)

                                @if($ErroVerificacao == 1)
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <p style = "color: red ">Nao pode existir campos vazios</p>
                                    </div>
                                </div>
                                @endif

                                @if($ErroVerificacao == 2)
                                        <div class="form-group">
                                            <div class="col-md-8 col-md-offset-4">
                                                <p style = "color: red ">O username introduzido nao existe</p>
                                            </div>
                                        </div>
                                @endif

                                @if($ErroVerificacao == 3)
                                        <div class="form-group">
                                            <div class="col-md-8 col-md-offset-4">
                                                <p style = "color: red ">A password atual encontra-se errada</p>
                                            </div>
                                        </div>
                                 @endif

                                 @if($ErroVerificacao == 4)
                                        <div class="form-group">
                                            <div class="col-md-8 col-md-offset-4">
                                                <p style = "color: red ">As novas passwords não são iguais,Tente novamente</p>
                                            </div>
                                        </div>
                                  @endif
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection