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
                {!! Form::model($riesgo, array('method'=>'post','class'=>'row-border','enctype'=>'multipart/form-data')) !!}
                <div class="form-group">
                    <label class="col-md-2 control-label">* Riesgo:</label>
                    <div class="col-md-7">
                        <input name="riesgo" class="form-control" type="text" value="{{$riesgo->riesgo}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">* Categoria:</label>
                    <div class="col-md-7">
                        {!! Form::select('tipoRiesgo_id', $tipoRiesgos, $riesgo->tipoRiesgo_id == null ? null : $riesgo->tipoRiesgo_id,array('class' => 'form-control','required'=>'required')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">* Descripcion:</label>
                    <div class="col-md-7">
                        <textarea name="descripcion" class="form-control" rows="6" required>{{$riesgo->descripcion}}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary pull-right" type="submit">Guardar</button>
                <a href="{{URL::to('mantenimiento/riesgos')}}" class="btn btn-default pull-left">Regresar</a>
            </div>
                {!! Form::close() !!}
        </div>
    </div>
@endsection