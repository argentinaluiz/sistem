@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h3>Bem-vindo ao sistema FNO</h3>
                </br>
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                            Você está logado!
                        @endif

                        <p>Nome: {{ Auth::user()->name }}</p>
                        <p>CPF: {{ Auth::user()->cpf }}</p>
                        <p>Telefone: {{ Auth::user()->phone }}</p>
                        <p>E-mail: {{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Lista de documentos</div>
                    <div class="panel-body">
                        <h4>Teste.</h4>
                        <ul>
                            @foreach($users as $user)
                                <li>{{ $user->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
