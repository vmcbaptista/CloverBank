@extends('manager.layout.template')


@push('css')
<link rel="stylesheet" type="text/css" href="/css/forms.css">
<link rel="stylesheet" type="text/css" href="/css/manager/addAccount.css">
@endpush

@section('main_content')

    @if($VerificationStep == 1)
        <div id="body" class="container">
            <p>Como deseja encontrar a conta respectiva ao deposito a realizar?  </p>

            <div class="buttons">
                <form action="/deposits/NIF">
                    <button>Numero de identificação fiscal (NIF)</button>
                </form>
                <form action="/deposits/IBAN">
                    <button>Numero de conta (IBAN) </button>
                </form>
            </div>
        </div>
    @endif
    @if($VerificationStep==2)
        <div id="body" class="container">
            <div class="form-wrapper">
                <form method="POST" action="/deposits/IBAN/check">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <label>Introduza o número de conta (IBAN)</label>
                    <input type="number" name="IBAN">
                    @if($ErroVerificacao==1)
                        <p class="error">Não pode existir campos em branco</p>
                    @endif
                    @if($ErroVerificacao==2)
                        <p class="error">O IBAN introduzido não pertence ao Clover Bank</p>
                    @endif
                    <div class="right_buttons">
                        <input type="submit" value="Procurar">
                    </div>
                </form>
            </div>
        </div>
    @endif
    @if($VerificationStep==4)
        <div id="Body" class="container">
            <div class="form-wrapper">
                <label>Titular da Conta:{{$clients[0]->name}}</label>
                <br>
                <label>NIF do Titular: {{$clients[0]->nif}}</label>
                <br>
                <label>Email: {{$clients[0]->email}}</label>
                <br>
                <label>Contato: {{$clients[0]->phone}}</label>
                <br>

                <form id="home" action="/manager/home">
                    <div class="right_buttons">
                        <button form="continue">Continuar</button>
                    </div>
                </form>
                <form id="continue" action="/deposits/IBAN/form">
                    <div class="right_buttons">
                        <button form="home">Cancelar</button>
                    </div>
                </form>


            </div>
        </div>
    @endif
    @if($VerificationStep==5)
        <div class="container">
            <div class="form-wrapper">
                <form method="POST" action="/deposits/IBAN/form/check">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <label>Introduza o valor a depositar</label>
                    <input type="number" name="amount">
                    @if($ErroVerificacao==1)
                        <p class="error">Não pode existir campos em branco</p>
                    @endif
                    @if($ErroVerificacao==2)
                        <p class="error">O valor a depositar tem que ser maior que 0€</p>
                    @endif
                    <div class="right_buttons">
                        <input type="submit" value="Depositar">
                    </div>
                </form>
                <form action="/manager/home">
                    <div class="right_buttons">
                        <button>Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
    @if($VerificationStep==6)
        <div class="container">
            <div class="form-wrapper">
                <p style="color:darkgreen; text-align: center;">O depósito foi realizado com sucesso</p>
                <br>
            </div>
            <form action="/manager/home">
                <button style="text-align: center;">Continuar</button>
            </form>
        </div>
    @endif

    @if($VerificationStep==7)
        <div id="body" class="container">
            <div class="form-wrapper">

                <form method="POST" id="searchCliForm">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <label>NIF</label>
                    <input type="number" name="nif">
                    @if($ErroVerificacao==1)
                        <p class="error">Não pode existir campos em branco</p>
                    @endif
                    @if($ErroVerificacao==2)
                        <p class="error">O NIF introduzido não existe</p>
                    @endif
                    <div class="right_buttons">
                        <input type="submit" value="Procurar" id="SearchNIF">
                    </div>
                </form>
            </div>

        </div>
    @endif
@endsection

@push('javascript')
@if($VerificationStep==7)
    <script src="/js/addAccount/search.js"></script>
    <script src="/js/deposits.js"></script>
@endif
@endpush