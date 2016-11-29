@extends('layouts.template_guest')


@push('css')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/products_list.css')}}">
@endpush

@section('products_list')
    <div class="products">
        <div class="loans">
            <div class="circle-img">
                <img src="/img/loan.svg"></img>

            </div>
            <h1>Créditos</h1>
        </div>

        <div class="products">
            <ul>
                @foreach($loans as $loan)
                    @foreach($products as $product)
                        @if($product->id == $loan->product_id)
                            <li class="products_name"><h1>{{ $product->name }}</h1></li>
                            <ul>
                                <li><p>{{ $product->description }}</p></li>
                                <li><p><strong>Montante mínimo:</strong> {{ $product->min_amount }}</p></li>
                                <li><p><strong>Montante máximo:</strong> {{ $loan->max_amount }}</p></li>
                                <li><p><strong>Prestações:</strong> {{ $loan->duration }} meses</p></li>
                                <li><p><strong>Taxa de Juro (TANL):</strong> {{ $loan->tanl }}%</p></li>
                                <li><p><strong>Condições de acesso:</strong> {{ $product->access_condition }}</p></li>
                            </ul>
                        @endif
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>
@endsection