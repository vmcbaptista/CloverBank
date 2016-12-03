@extends('manager.layout.template')

@section('main_content')
    <div class="container">
    @if($step == 1)
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
        <!--Unlock the account give the user a base account, initial ammount of money
           and a branch-->
        <div>
            <label> O nome do utilizador {{ $request->name }}</label>
            <br>
            <label> O seu NIF é : {{ $request->nif }} </label>
            <br>
            <lavel> O telefone é: {{ $request->phone }}</lavel>
            <br>
            <label> O mail é: {{ $request->email }}</label>
        </div>
        <form method="POST" action="/account/activate/finalstep">
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
            <button>Desbloquear Conta</button>
        </form>
    @elseif($step == 3)
        <!--Final info to the manager-->
        <p>A conta do cliente {{$request->name}} encontra-se ativa.</p>
        <p>O produto base é: {{ $request->product }} </p>
        <p>Deverá contactar o balcão {{ $request->branch }}.</p>
        <p>O cliente depositou {{ $request->amount }} € na conta.</p>
    @endif

@endsection

@section('javascript')

@endsection