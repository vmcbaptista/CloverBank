@extends('client.layout.template')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/forms.css')}}">
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
                </tr>
            </thead>
            <tbody id="tableRow">

            </tbody>
        </table>
    </div>
@endsection

@push('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/client/getSavings.js') }}"></script>
@endpush