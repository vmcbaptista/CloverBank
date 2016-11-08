@extends('manager.layout.auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Encontrar a tua conta</div>
                    <div class="panel-body">

                        @if($VerificationStep==0)
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/manager/passwords/resetPassword/verification') }}">
                                {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Email</label>

                                <div class="col-md-6">
                                    <input id="Email" type="text" class="form-control" name="EmailManager" required>

                                    @if ($errors->has('Email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('Email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                @if($ErroVerification == 1)
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-4">
                                            <p style = "color: red ">Nao pode existir campos vazios</p>
                                        </div>
                                    </div>
                                @endif
                                @if($ErroVerification == 2)
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-4">
                                            <p style = "color: red ">Não existe nenhuma conta associada com o email introduzido</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Continuar
                                    </button>
                                </div>
                            </div>
                         </form>
                        @endif
                        @if($VerificationStep==1)
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/manager/passwords/resetPassword/Codeverification') }}">
                                    {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('verificationCode') ? ' has-error' : '' }}">
                                    <label for="verificationCode" class="col-md-4 control-label">Código de verificação</label>

                                    <div class="col-md-6">
                                        <input id="verificationCode" type="text" class="form-control" name="verificationCode" required>

                                        @if ($errors->has('verificationCode'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('verificationCode') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    @if($ErroVerification == 1)
                                        <div class="form-group">
                                            <div class="col-md-8 col-md-offset-4">
                                                <p style = "color: red ">Nao pode existir campos vazios</p>
                                            </div>
                                        </div>
                                    @endif
                                    @if($ErroVerification == 2)
                                        <div class="form-group">
                                            <div class="col-md-8 col-md-offset-4">
                                                <p style = "color: red ">O código de verificação introduzido está incorreto</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Continuar
                                        </button>
                                    </div>
                                </div>
                            </form>

                        @endif
                        @if($VerificationStep==2)
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/manager/passwords/resetPassword/NewPassword') }}">
                                    {{ csrf_field() }}
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
                                @if($ErroVerification == 1)
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-4">
                                            <p style = "color: red ">Nao pode existir campos vazios</p>
                                        </div>
                                    </div>
                                @endif
                                @if($ErroVerification == 2)
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-4">
                                            <p style = "color: red ">As passwords introduzidas não correspondem</p>
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Continuar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif
                        @if($VerificationStep==3)

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <p style = "color: green ">A sua password foi alterada com sucesso!</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <a href="http://localhost:8000/manager/login">Login
                                    </div>
                                </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
