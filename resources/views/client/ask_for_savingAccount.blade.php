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
                    <th> Selecionar</th>
                </thead>
                <tbody>
                    @if( count($savings) > 0)
                        @foreach($products as $prod)
                            <form method="POST" action="/product/create/saving" >
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <tr>
                                    @foreach($savings as $sav)
                                        @if($prod->id ==  $sav->id)
                                            <input type="hidden" name="savingId" value="{{ $sav->id }}" >
                                            <td><input type="text" name="prodName" value="{{ $prod->name }}" readonly></td>
                                            <td><input type="text" name="min_amount" value="{{ $prod->min_amount }}" readonly></td>
                                            <td><input type="text" name="max_amount" value="{{ $sav->max_amount }}" readonly></td>
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
            <p><bold>A TANB : {{ $chosenSaving->tanb }}</bold></p>
            <p><bold>A TANL : {{ $chosenSaving->tanl }}</bold></p>
            <form method="POST" action="/product/add/saving">
                <label for="amount"> Montante (€)</label>
                <input type="text" name="amount">
                <button> Subscrever Produto </button>
            </form>
        @endif




    <div>
@endsection

@push('javascript')
@endpush