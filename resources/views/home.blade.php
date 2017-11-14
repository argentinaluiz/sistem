@extends(layout())

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
                    <h4>Checklist eletrônico e relação dos documentos necessários a elaboração de Projeto de captação de recursos de fomento através do Programa FNO - Amazônia sustentável, na modalidade investimento misto do Banco da Amazônia S/A.</h4>
                    <p><a href="{{ asset("archive/Checklist_Projeto_FNO_maio_17.pdf") }}">Checklist Projeto FNO</a></p>
                    <p><a href="{{ asset("archive/Checklist-FNO_nao_Rural.xlsm") }}">Checklist FNO não rural</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
