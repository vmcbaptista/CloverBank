@extends('layouts.template_guest')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/products_list.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/contacts.css')}}">
@endpush

@section('products_list')
    <div class="products">
        <div class="currents">
            <div class="circle-img">
                <img src="/img/wallet.svg"></img>

            </div>
            <h1>Contas à Ordem</h1>
        </div>

        <div class="products">
            <ul>
                @foreach($currents as $current)
                    @foreach($products as $product)
                        @if($product->id == $current->product_id)
                            <li class="products_name"><h1>{{ $product->name }}</h1></li>
                            <ul>
                                <li><p>{{ $product->description }}</p></li>
                                <li><p><strong>Montante mínimo:</strong> {{ $product->min_amount }}</p></li>
                                <li><p><strong>Condições de acesso:</strong> {{ $product->access_condition }}</p></li>
                                <li><p><strong>Custos de manutenção:</strong> {{ $current->maintenance_costs }}</p></li>
                            </ul>
                        @endif
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>
@endsection