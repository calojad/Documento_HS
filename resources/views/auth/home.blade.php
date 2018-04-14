@extends('layouts.app')
@section('style')
    <link href="{{asset('/plugins/iCheck/square/blue.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="row">
        {!! Alert::render() !!}
        @include('layouts.includes.alerts')
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading">REGLAMENTO INTERNO DE HIGIENE Y SEGURIDAD</div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <a class="btn btn-primary" href="{{URL::to('/documento/datosgenerales')}}" title="Crear Nuevo Documento"><i class="fa fa-plus-square"></i> Nuevo</a>
                    </div>
                    <div class="col-md-12 h5 box-body table-responsive no-padding">
                        <table class="table table-striped table-bordered table-hover table-checkable datatable">
                            <thead>
                                <tr>
                                    <th>Empresa</th>
                                    <th>Documento</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documentos as $documento)
                                    <tr>
                                        <td>{{$documento->empresa->nombre}}</td>
                                        <td>{{$documento->titulo}}</td>
                                        <td>
                                            @if($documento->estado == 1)
                                                <label class="label label-warning">En Proceso</label>
                                            @elseif($documento->estado == 2)
                                                <label class="label label-info">Terminado</label>
                                            @elseif($documento->estado == 3)
                                                <label class="label label-success">Impreso</label>
                                            @endif
                                        </td>
                                        <td style="width: 100px">
                                            <a title="Editar" href="{{URL::to('documento/datosgenerales/').'/'.$documento->id}}"><i class="fa fa-edit"></i></a>
                                            <a title="Descargar" href="{{URL::to('documento/exportplantilla/').'/'.$documento->id}}"><i class="fa fa-download"></i></a>
                                            <a id="btnEliminarDoc" title="Eliminar" docId="{{$documento->id}}"><i class="fa fa-trash"></i></a>
                                            <a id="btnConfigDoc" title="Configuración" docId="{{$documento->id}}" docEncabezado="{{$documento->encabezado}}" data-toggle="modal" data-target="#modalConfigurarDoc"><i class="fa fa-cog"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modalConfigurarDoc" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-cog"></i> Configuraciones</h4>
            </div>
            {!! Form::open(['url'=>'documento/configdocumento', 'method'=>'post']) !!}
            <input id="documentoId" type="hidden" name="id" value="0">
            <div class="modal-body form-horizontal">
                <div class="form-group">
                    <label class="control-label col-md-3">Encabezado:</label>
                    <div class="col-md-8">
                        {!! Form::select('encabezado',$plantillas,null,['class'=>'form-control','id'=>'encabezado']) !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Aceptar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
    @include('auth.includes.home_script')
@endsection
@section('script')
    <!-- iCheck 1.0.1 -->
    <script src="{{asset('/plugins/iCheck/icheck.min.js')}}"></script>
@endsection
