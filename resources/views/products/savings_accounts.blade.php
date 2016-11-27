@extends('template')


@section('css')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/products_list.css')}}">
@endsection

@section('products_list')
    <div class="products">
        <div class="savings">
            <div class="circle-img">
                <img src="/img/piggy-bank.svg"></img>

            </div>
            <h1>Contas Poupança</h1>
        </div>

        <div class="products">
            <ul>
                @foreach($savings as $saving)
                    @foreach($products as $product)
                        @if($product->id == $saving->product_id)
                            <li class="products_name"><h1>{{ $product->name }}</h1></li>
                            <ul>
                                <li><p>{{ $product->description }}</p></li>
                                <li><p><strong>Montante mínimo:</strong> {{ $product->min_amount }}</p></li>
                                <li><p><strong>Montante máximo:</strong> {{ $saving->max_amount }}</p></li>
                                <li><p><strong>Duração:</strong> {{ $saving->duration }} meses</p></li>
                                <li><p><strong>Taxa de Juro (TANB):</strong> {{ $saving->tanb }}%</p></li>
                                <li><p><strong>Reforços:</strong>
                                        @if($saving->reinforcements)
                                            Permitido
                                        @else
                                            Não permitido
                                        @endif
                                    </p>
                                </li>
                                <li><p><strong>Condições de acesso:</strong> {{ $product->access_condition }}</p></li>
                            </ul>
                        @endif
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>
@endsection