@extends('layouts.mante')
@section('content')
    <div class="row"></div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{$titulo}}
            </div>
        </div>
        <div class="panel-body">
            <div class="col-md-12 form-horizontal">
                {!! Form::model($empresa, array('method'=>'post','class'=>'row-border','enctype'=>'multipart/form-data')) !!}
                <div class="form-group">
                    <label class="col-md-2 control-label">Nombre:</label>
                    <div class="col-md-7">
                        <input name="titulo" class="form-control" type="text" value="{{$empresa->titulo}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Descripción:</label>
                    <div class="col-md-7">
                        <textarea name="descripcion" class="form-control" rows="4">{{$empresa->descripcion}}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary pull-right" type="submit">Guardar</button>
                <a href="{{URL::to('mantenimiento/empresas')}}" class="btn btn-default pull-left">Regresar</a>
            </div>
                {!! Form::close() !!}
        </div>
    </div>
@endsection