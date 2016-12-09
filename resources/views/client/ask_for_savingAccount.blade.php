@extends('client.layout.template')

@push('css')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/forms.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/ask_for_saving.css')}}">
@endpush

@section('main_content')
    <div class="container">
        @if($step == 1)
            <table>
                <thead>
                <th>Nome Produto</th>
                <th> Valor Min. €</th>
                <th> Valor Max. €</th>
                <th> TANB (%)</th>
                <th> Selecionar</th>
                </thead>
                <tbody>
                @if( count($savings) > 0)
                    @foreach($products as $prod)
                        <form method="POST" action="/product/create/saving" >
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <tr>
                                @foreach($savings as $sav)
                                    @if($prod->id ==  $sav->product_id)
                                        <input type="hidden" name="savingId" value="{{ $sav->id }}" >
                                        <td><input type="text" name="prodName" value="{{ $prod->name }}" readonly></td>
                                        <td><input type="text" name="min_amount" value="{{ $prod->min_amount }}" readonly></td>
                                        <td><input type="text" name="max_amount" value="{{ $sav->max_amount }}" readonly></td>
                                        <td><input type="text" name="tanb" value="{{ $sav->tanb }}" readonly></td>
                                        <td><button> Selecionar </button></td>
                                    @endif
                                @endforeach
                                @endforeach
                            </tr>
                        </form>
                        @else
                            <tr>
                                <td colspan="4">Não existem produtos para serem mostrados.</td>
                            </tr>
                        @endif
                </tbody>
            </table>
            @if (count($errors) > 0)
                <div class="error">
                    <p>Ocorreram os seguintes erros.</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <p>Terá de recomeçar o processo de criação da conta.</p>
                </div>
            @endif
        @elseif($step == 2)
            <p>O produto selecionado é: {{$chosenProduct->name}}</p>
            <p>O Montante Mínímo é : {{ $chosenProduct->min_amount }}</p>
            <p>O Montante Máximo é : {{ $chosenSaving->max_amount }}</p>
            @if($chosenSaving->reinforcements == 1)
                <p>São Permitidos reforços ao longo do investimento.</p>
            @else
                <p>Não são Permitidos reforços ao longo do investimento.</p>
            @endif
            <p>A duração será de {{ $chosenSaving->duration }} meses</p>
            <p><strong>A TANB : {{ $chosenSaving->tanb }}</strong></p>
            <p><strong>A TANL : {{ $chosenSaving->tanl }}</strong></p>
            <form method="POST" action="/product/add/saving">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="savingId" value="{{$chosenSaving->id}}">
                <label for="account"> Conta a Debitar: </label>
                <select name="account">
                    @foreach($currentAccounts as $account)
                        <option value="{{$account->id}}"> {{$account->id}} </option>
                    @endforeach
                </select>
                <label for="amount"> Montante (€)</label>
                <input type="text" name="amount">
                <button> Subscrever Produto </button>
            </form>
        @elseif($step == 3)
            <div class="confirmation">
                <p>A conta foi criada com sucesso</p>
                <p>Clique em <a href="/client/home">Continuar</a> para ser redirecionado para a página inicial.</p>
            </div>
        @endif
    </div>
@endsection

@push('javascript')
@endpush