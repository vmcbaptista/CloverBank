@extends('client.layout.template')

@push('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/forms.css')}}">
    <style>
        .ui-dialog-titlebar{
            background-color: #113342;
            color:white;
        }
        .ui-dialog-buttonset .ui-button{
            background-color: #2ab27b;
            color:white;
        }

    </style>

@endpush

@section('main_content')
    <div class="container">
        <label for="currentAccount"> Selecione Conta:</label>
        <select name="currentAccount" id="currentAccount">
                <option></option>
            @foreach($currentAccounts as $currentAccount)
                <option value="{{$currentAccount->id}}">{{ $currentAccount->id}}</option>
            @endforeach
        </select>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Valor Cativo (€)</th>
                    <th>Data Limite</th>
                    <th>TANB (%)</th>
                    <th>Juro Ilíquido (€)</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody id="tableRow">

            </tbody>
        </table>
        <div style="display: none;" id="dialog-confirm" title="Liquidar conta poupança?">
            <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Deseja liquidar a sua conta poupança?<br> O dinheiro cativo ser-lhe-á devolvido. Irá sofrer uma penalização sobre o valor do juro.</p>
        </div>
    </div>
@endsection

@push('javascript')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/client/getSavings.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/client/deleteSavings.js') }}"></script>
@endpush