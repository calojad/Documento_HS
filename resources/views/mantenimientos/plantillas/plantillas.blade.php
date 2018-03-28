@extends('layouts.mante')
@section('content')
    <div class="row"></div>
    <div class="col-md-12">
        <div class="panel panel-default panel-bot-0">
            <div class="panel-heading">
                PLANTILLAS
            </div>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <a href="{{URL::to('mantenimiento/crearplantilla')}}" class="btn btn-primary pull-right" title="Crear Nueva Plantilla"><i class="fa fa-plus-square"></i> Crear</a>
            </div>
        </div>
        <div class="col-md-12 box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Plantilla</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($plantillas as $plantilla)
                    <tr>
                        <td>{{$plantilla->id}}</td>
                        <td>{{$plantilla->titulo}}</td>
                        <td>
                            <a href="{{URL::to('mantenimiento/editarplantilla/').'/'.$plantilla->id}}" title="Editar"><i class="fa fa-edit"></i></a>
                            <a href="{{URL::to('mantenimiento/descargarplantilla').'/'.$plantilla->id}}" title="Descargar"><i class="fa fa-download"></i></a>
                            <a id="btnEliminarPlantilla" plantillaId="{{$plantilla->id}}" title="Eliminar"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('mantenimientos.scripts')
@endsection