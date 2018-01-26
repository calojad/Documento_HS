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
                {!! Form::model($articulo, array('method'=>'post','class'=>'row-border','enctype'=>'multipart/form-data')) !!}
                <div class="form-group">
                    <label class="col-md-2 control-label">* Riesgo:</label>
                    <div class="col-md-7">
                        <input name="riesgo_id" type="hidden" value="{{$articulo->riesgo_id != null ?$articulo->riesgo_id:0}}">
                        <input name="riesgo" class="form-control" type="text" value="{{$articulo->riesgo_id != null ?$articulo->riesgo->riesgo:''}}" required>
                    </div>
                    <div>
                        <a id="btnSeleccionarRiesgo" class="btn btn-twitter" data-toggle="modal" data-target="#modalSelectRiesgos"><i class="fa fa-list-alt"></i></a>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">* Artículo:</label>
                    <div class="col-md-10">
                        <textarea name="articulo" class="ckeditor form-control" rows="6" required>{{$articulo->articulo}}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary pull-right" type="submit">Guardar</button>
                <a href="{{URL::to('mantenimiento/articulos')}}" class="btn btn-default pull-left">Regresar</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    
    <div id="modalSelectRiesgos" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Seleccionar un Riesgo</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Tipo</th>
                                <th>Riesgo</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($riesgos as $riesgo)
                            <tr>
                                <td>{{$riesgo->id}}</td>
                                <td>{{$riesgo->tipoRiesgo->riesgo}}</td>
                                <td>
                                    <a id="RiesgoSeleccionado" class="btn col-md-12" riesgoId="{{$riesgo->id}}" riesgo="{{$riesgo->riesgo}}" style="text-align: left" data-dismiss="modal">{{$riesgo->riesgo}}</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</a>
                </div>
            </div>
        </div>
    </div>
    @include('mantenimientos.articulo.form_script')
@endsection
@section('script')
    <!-- CKEditor -->
    <script src="{{ asset('/vendors/ckeditor/ckeditor.js') }}"></script>
@endsection
