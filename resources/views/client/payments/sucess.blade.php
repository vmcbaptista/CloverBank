@extends('client.layout.template')
@push('css')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/client/clientBalance.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/forms.css')}}">
@endpush
@section('main_content')
    <div class="container confirmation">
        <p>O pagamento foi efetuado com sucesso</p>
        <p>Clique em <a href="/client/home">Continuar</a> para ser redirecionado para a página inicial.</p>
    </div>
@endsection
@push('javascript')
<script type="text/javascript" src="{{ URL::asset('js/client/updateMovementsBalance.js') }}"></script>
@endpush