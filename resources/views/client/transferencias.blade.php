@extends('client.layout.template')


@push('css')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/client/clientBalance.css')}}">
<!--<link rel="stylesheet" type="text/css" href="{{URL::asset('css/client/clientTransference.css')}}">-->
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/forms.css')}}">
@endpush

@section('main_content')

    @if($VerificationStep == 0)
        <div class="container">
            <form method="POST" id="Transferencia">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="accountBalanceBar">
                    <label>Conta a Debitar</label>
                    <select id="account" name="account">
                        @foreach($accounts as $account)
                            <option>{{ $account->id }}</option>
                        @endforeach
                    </select>
                    <label id="balanceLabel">Saldo: <span id="balance"></span></label>
                </div>

                <label class="label-title">Dados transferencia</label>
                <div class="form-wrapper">
                    <label>Conta/IBAN</label>
                    <br>
                    <input type="number" name="IBAN">
                    @if($ErroVerificacao==2)
                        <p class="error">  O IBAN introduzido não existe </p>
                    @endif
                    <br>
                    <label>Montante (€)</label>
                    <div>
                        <input type="number" name ="Montante">
                        @if($ErroVerificacao==3)
                            <p class="error">  O montante tem que ser maior que 0€ </p>
                        @endif
                    </div>
                    <label>Descrição</label>
                    <br>
                    <input type="text" name="DescricaoTransferencia">
                    <br>
                    @if($ErroVerificacao==1)
                        <p class="error"> Nenhum dos campos pode estar vazio</p>
                    @endif
                    @if($ErroVerificacao == 4)
                        <p class="error">Não tem fundos suficientes para realizar a transferencia </p>
                    @endif
                </div>
                <div class="right_buttons">
                    <input type="submit" name="submit" value="Continuar">
                </div>
            </form>
        </div>
    @endif

    @if($VerificationStep ==1)
        <div class="container">
            <form class="form-step2" action ="{{ url('/client/transfers/check') }}" method="POST" id="Transferencia">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-wrapper ">
                    <label>Codigo de Verificação</label>

                    <br>
                    <input type="text" name="PinCliente">
                    <br>
                    @if($ErroVerificacao==1)
                        <p class="error">Não pode existir campos vazios</p>
                    @endif

                    @if($ErroVerificacao==2)
                        <p class="error">O codigo de verificação não se encontra correcto </p>
                    @endif
                </div>
                <div class="right_buttons">
                    <input class="step2-button" type="submit" name="submit" value="Transferir">
                </div>
            </form>
        </div>
    @endif
    @if($VerificationStep==2)
        <div class="container">
            <div class="form-wrapper step3">
                <p class="success">A transferencia foi realizada com sucesso</p>
                <p class=""> Clique em <a href="http://localhost:8000/client/home">Continuar</a> para ser redirecionado a pagina inicial.</p>
            </div>
        </div>
    @endif
@endsection

@push('javascript')
<script type="text/javascript" src="{{ URL::asset('js/client/updateMovementsBalance.js') }}"></script>
@endpush