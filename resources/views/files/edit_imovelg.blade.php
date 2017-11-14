@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Enviar Arquivos</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('upload-files.index') }}"> Voltar</a>
                </div>
            </div>
        </div>

        {!!  Form::model($imovelg, ['method' => 'PATCH', 'route' => ['upload-imovelg.update', $imovelg->id] ]) !!}

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Nome:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Enviar arquivo:</strong>
                    {!! Form::file('product_image', array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Detalhes:</strong>
                    {!! Form::textarea('details', null, array('placeholder' => 'Details','class' => 'form-control','style'=>'height:100px')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                {{--<button type="submit" class="btn btn-primary">Submit</button>--}}
                {!! Form::submit('Atualizar', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>

@endsection