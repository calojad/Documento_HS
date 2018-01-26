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
                <input id="inpContador" name="contador" type="hidden" value="0">
                <div id="divArticulos">
                    {{-- DIV EN DONDE SE GENERARAN NUEVOS ARTICULOS --}}
                    @if($articulos != null)
                        @foreach($articulos as $articulo)
                    <div id="div_arti_{{$articulo->num_articulo}}" class="form-group">
                        <label class="col-md-2 control-label">* Articulo {{$articulo->num_articulo}}:</label>
                        <div class="col-md-7">
                            <textarea name="articulo_{{$articulo->num_articulo}}" class="form-control" rows="6" required>{{$articulo->articulo}}</textarea>
                        </div>
                        <div id="divQuitarArticulo_{{$articulo->num_articulo}}"></div>
                    </div>
                        @endforeach
                    @endif
                </div>
                <div class="form-group" style="margin-left: 18%;">
                    <a id="btnAddArticulo" class="btn btn-primary pull-left"><i class="fa fa-plus-square"></i> Añadir Articulo</a>
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary pull-right" type="submit">Guardar</button>
                <a href="{{URL::to('mantenimiento/riesgos')}}" class="btn btn-default pull-left">Regresar</a>
            </div>
                {!! Form::close() !!}
        </div>
    </div>
    @include('mantenimientos.riesgo.form_script')
@endsection