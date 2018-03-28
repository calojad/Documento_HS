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
                {!! Form::model($plantilla, array('method'=>'post','class'=>'row-border','enctype'=>'multipart/form-data')) !!}
                <div class="form-group">
                    <label class="col-md-2 control-label">* Titulo:</label>
                    <div class="col-md-7">
                        <input name="titulo" class="form-control" type="text" value="{{$plantilla->titulo}}" required title="Titulo de la PLantilla">
                    </div>
                </div>
                @if($plantilla->plantilla != null || $plantilla->plantilla != '')
                <div class="form-group">
                    <label class="col-md-2 control-label">Archivo Actual:</label>
                    <div class="col-md-7">
                        <img src="{{asset('images/formularios/miniatura_word.PNG')}}">
                        <label>{{ explode("/", $plantilla->plantilla)[2] }}</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Actualizar: </label>
                    <div class="col-md-7">
                        <input name="plantilla" type="file" accept=".docx, .doc" title="Archivo plantilla">
                    </div>
                </div>
                @else
                <div class="form-group">
                    <label class="col-md-2 control-label">* Archivo: </label>
                    <div class="col-md-7">
                        <input name="plantilla" type="file" accept=".docx, .doc" required title="Archivo plantilla">
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary pull-right" type="submit">Guardar</button>
                <a href="{{URL::to('mantenimiento/plantillas')}}" class="btn btn-default pull-left">Regresar</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection