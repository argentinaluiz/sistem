@extends('layouts.app')
@section('content')
    @if (!Auth::guest())
    <div class="container" xmlns="http://www.w3.org/1999/html">
        <div class="row">
            <div class="col-md-12">
                <h3>Seção para cadastramento das documentações necessárias para investimento</h3>
            </div>
        </div>
        </br>
        <div class="row">
            <div class="col-md-12">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Jurídica</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Contábil</a></li>
                    <li role="presentation"><a href="#tecfinanceira" aria-controls="tecfinanceira" role="tab" data-toggle="tab">Técnica/Financeira </a></li>
                    <li role="presentation"><a href="#civil" aria-controls="civil" role="tab" data-toggle="tab">Construção civil</a></li>
                    <li role="presentation"><a href="#garantia" aria-controls="garantia" role="tab" data-toggle="tab">Imóvel objeto de garantia</a></li>
                    <li role="presentation"><a href="#aquisicao" aria-controls="aquisicao" role="tab" data-toggle="tab">Imóvel objeto de aquisição</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        </br>
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <h2>Documentação Jurídica <small>a ser enviada:</small></h2>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-success" href="{{ route('upload-files.create') }}"> Enviar novo arquivo</a>
                            </div>
                        </div>
                        <table class="table table-responsive">
                            <tr>
                                {{--<th>No</th>--}}
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Data da criação</th>
                                <th>Data da ultima atualização</th>
                                <th>Arquivo</th>
                                <th>Editar</th>
                            </tr>
                            @if(Auth::check())
                                @foreach ($products as $product)

                                    <tr>
                                        {{--<td>{{ ++$i }}</td>--}}
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->details }}</td>
                                        <td>{{ $product->created_at->format('d/m/Y - h:m:s') }}</td>
                                        <td>{{ $product->updated_at->format('d/m/Y - h:m:s') }}</td>
                                        <td>
                                            <a href='{{ asset("images/$product->product_image") }}'>{{ $product->product_image }}</a>
                                        </td>
                                        <td><a href="{{ route('upload-files.edit', $product->id) }}">Editar</a></td>
                                    </tr>

                                @endforeach
                            @endif
                        </table>
                        {!! $products->render() !!}
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        </br>
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <h2>Documentação Contábil <small>a ser enviada:</small></h2>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-success" href="{{ route('upload-contabil.create') }}"> Enviar novo arquivo</a>
                            </div>
                        </div>
                        <table class="table table-responsive">
                            <tr>
                                {{--<th>No</th>--}}
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Data da criação</th>
                                <th>Data da última atualização</th>
                                <th>Arquivo</th>
                                <th>Editar</th>
                            </tr>
                            @foreach ($contabils as $contabil)
                                <tr>
                                    {{--<td>{{ ++$i }}</td>--}}
                                    <td>{{ $contabil->name }}</td>
                                    <td>{{ $contabil->details }}</td>
                                    <td>{{ $contabil->created_at->format('d/m/Y - h:m:s') }}</td>
                                    <td>{{ $contabil->updated_at->format('d/m/Y - h:m:s') }}</td>
                                    <td>
                                        <a href='{{ asset("images/contabil/$contabil->product_image") }}'>{{ $contabil->product_image }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('upload-contabil.edit', $contabil->id) }}">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {!! $contabils->render() !!}
                    </div>
                    <div role="tabpanel" class="tab-pane" id="tecfinanceira">
                        </br>
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <h2>Documentação Técnica/Financeira <small>a ser enviada:</small></h2>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-success" href="{{ route('upload-tecfin.create') }}"> Enviar novo arquivo</a>
                            </div>
                        </div>
                        <table class="table table-responsive">
                            <tr>
                                {{--<th>No</th>--}}
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Data da criação</th>
                                <th>Data da última atualização</th>
                                <th>Arquivo</th>
                                <th>Editar</th>
                            </tr>
                            @if(Auth::check())
                                @foreach ($tecfins as $tecfin)
                                    <tr>
                                        {{--<td>{{ ++$i }}</td>--}}
                                        <td>{{ $tecfin->name }}</td>
                                        <td>{{ $tecfin->details }}</td>
                                        <td>{{ $tecfin->created_at->format('d/m/Y - h:m:s') }}</td>
                                        <td>{{ $tecfin->updated_at->format('d/m/Y - h:m:s') }}</td>
                                        <td>
                                            <a href='{{ asset("images/tecfin/$tecfin->product_image") }}'>{{ $tecfin->product_image }}</a>
                                        </td>
                                        <td><a href="{{ route('upload-tecfin.edit', $tecfin->id) }}">Editar</a></td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                        {!! $tecfins->render() !!}
                    </div>
                    <div role="tabpanel" class="tab-pane" id="civil">
                        </br>
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <h2>Documentação Construção Civil <small>a ser enviada:</small></h2>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-success" href="{{ route('upload-civil.create') }}">Enviar novo arquivo</a>
                            </div>
                        </div>
                        <table class="table table-responsive">
                            <tr>
                                {{--<th>No</th>--}}
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Data da criação</th>
                                <th>Data da última atualização</th>
                                <th>Arquivo</th>
                                <th>Editar</th>
                            </tr>
                            @if(Auth::check())
                                @foreach ($civils as $civil)
                                    <tr>
                                        {{--<td>{{ ++$i }}</td>--}}
                                        <td>{{ $civil->name }}</td>
                                        <td>{{ $civil->details }}</td>
                                        <td>{{ $civil->created_at->format('d/m/Y - h:m:s') }}</td>
                                        <td>{{ $civil->updated_at->format('d/m/Y - h:m:s') }}</td>
                                        <td>
                                            <a href='{{ asset("images/civil/$civil->product_image") }}'>{{ $civil->product_image }}</a>
                                        </td>
                                        <td><a href="{{ route('upload-civil.edit', $civil->id) }}">Editar</a></td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                        {!! $civils->render() !!}
                    </div>
                    <div role="tabpanel" class="tab-pane" id="garantia">
                        </br>
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <h2>Documentação Imóvel Objeto de Garantia <small>a ser enviada:</small></h2>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-success" href="{{ route('upload-imovelg.create') }}">Enviar novo arquivo</a>
                            </div>
                        </div>
                        </br>
                        </br>
                            <table class="table table-responsive">
                                <tr>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Data da criação</th>
                                    <th>Data da última atualização</th>
                                    <th>Arquivo</th>
                                    <th>Editar</th>
                                </tr>
                                @if(Auth::check())
                                    @foreach ($imovelgs as $imovelg)
                                        <tr>
                                            {{--<td>{{ ++$i }}</td>--}}
                                            <td>{{ $imovelg->name }}</td>
                                            <td>{{ $imovelg->details }}</td>
                                            <td>{{ $imovelg->created_at->format('d/m/Y - h:m:s') }}</td>
                                            <td>{{ $imovelg->updated_at->format('d/m/Y - h:m:s') }}</td>
                                            <td>
                                                <a href='{{ asset("images/imovelg/$imovelg->product_image") }}'>{{ $imovelg->product_image }}</a>
                                            </td>
                                            <td><a href="{{ route('upload-imovelg.edit', $imovelg->id) }}">Editar</a></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        {!! $imovelgs->render() !!}
                    </div>
                    <div role="tabpanel" class="tab-pane" id="aquisicao">
                        </br>
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <h2>Documentação Imóvel Objeto de Aquisição <small>a ser enviada:</small></h2>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-success" href="{{ route('upload-imovela.create') }}">Enviar novo arquivo</a>
                            </div>
                        </div>
                        </br>
                        </br>
                        <table class="table table-responsive">
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Data da criação</th>
                                <th>Data da última atualização</th>
                                <th>Arquivo</th>
                                <th>Editar</th>
                            </tr>
                            @if(Auth::check())
                                @foreach ($imovelas as $imovela)
                                    <tr>
                                        {{--<td>{{ ++$i }}</td>--}}
                                        <td>{{ $imovela->name }}</td>
                                        <td>{{ $imovela->details }}</td>
                                        <td>{{ $imovela->created_at->format('d/m/Y - h:m:s') }}</td>
                                        <td>{{ $imovela->updated_at->format('d/m/Y - h:m:s') }}</td>
                                        <td>
                                            <a href='{{ asset("images/imovela/$imovela->product_image") }}'>{{ $imovela->product_image }}</a>
                                        </td>
                                        <td><a href="{{ route('upload-imovela.edit', $imovela->id) }}">Editar</a></td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                        {!! $imovelas->render() !!}
                    </div>
                </div>
            </div>

        </div>

    </div>
    @endif
@endsection