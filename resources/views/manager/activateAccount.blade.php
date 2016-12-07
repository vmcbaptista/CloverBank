@extends('manager.layout.template')
@push('css')
<link rel="stylesheet" type="text/css" href="/css/forms.css">
<link rel="stylesheet" type="text/css" href="/css/manager/activateAccount.css">
@endpush
@section('main_content')
    @if($step == 1)
        <div class="container">
            <table>
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Nif</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Estado da Conta</th>
                    <th>Ação</th>
                </tr>
                </thead>
                <tbody>
                @if (count($inactiveAccounts ) === 0)
                    <tr>
                        <td colspan="6">Não existem contas para serem ativadas.</td>
                    </tr>
                @else
                    @foreach($inactiveAccounts as $account)
                        <tr>
                            <form method="POST" action="/account/activate">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <td><input type="text" name="name" value="{{ $account->name }}" readonly></td>
                                <td><input type="text" name="nif" value="{{ $account->nif }} " readonly></td>
                                <td><input type="text" name="phone" value="{{ $account->phone }} " readonly></td>
                                <td><input type="text" name="email" value="{{ $account->email }} " readonly></td>
                                <td>
                                    @if($account->accoutState == 0)
                                        Inativa
                                    @else
                                        Ativa
                                    @endif
                                </td>
                                <input type="hidden" name="step" value="{{$step + 1}}">
                                <td><button>Selecionar Conta</button></td>
                            </form>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    @elseif($step == 2)
        <div class="container">
            <!--Unlock the account give the user a base account, initial ammount of money
               and a branch-->
            <label>Dados do Cliente</label>
            <div>
                <table>
                    <thead>
                    <th colspan="2">1º Titular</th>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Nome</td>
                        <td>{{ $request->name }}</td>
                    </tr>
                    <tr>
                        <td>Número de Contribuinte</td>
                        <td>{{ $request->nif }}</td>
                    </tr>
                    <tr>
                        <td>Telefone</td>
                        <td>{{ $request->phone }}</td>
                    </tr>
                    <tr>
                        <td>E-mail</td>
                        <td>{{ $request->email }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <form method="POST" action="/account/activate/finalstep">
                <label>Dados da Conta</label>
                <div class="form-wrapper">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="name" value="{{ $request->name }}">
                    <input type="hidden" name="nif" value="{{ $request->nif }}">
                    <input type="hidden" name="phone" value="{{ $request->phone }}">
                    <input type="hidden" name="email" value="{{ $request->email }}">
                    <label for="amount">Saldo Inicial: </label>
                    <input type="text" name="amount" >

                    <!-- Balcon -->
                    <label> Balcão </label>
                    <select  name="branch">
                        @foreach( $branchs as $branch)
                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                        @endforeach
                    </select>
                    <!-- Product-->
                    <label> Produto </label>
                    <select name="product">
                        @foreach($allProducts as $product)
                            <option  value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>

                    <input type="hidden" name="step" value="{{$step + 1}}">
                </div>
                <button>Desbloquear Conta</button>
            </form>
        </div>
    @elseif($step == 3)
        <!--Final info to the manager-->
        <div class="container confirmation">
            <p>A conta do cliente {{$request->name}} encontra-se ativa.</p>
            <p>O produto base é: {{ $request->product }} </p>
            <p>Deverá contactar o balcão {{ $request->branch }}.</p>
            <p>O cliente depositou {{ $request->amount }} € na conta.</p>
            <p>Clique <a href="/manager/home">aqui</a> para continuar.</p>
        </div>
    @endif

@endsection

@section('javascript')

@endsection