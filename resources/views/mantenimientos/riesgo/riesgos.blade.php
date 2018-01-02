@extends('layouts.mante')
@section('content')
    <div class="row"></div>
    <div class="col-md-12">
        <div class="panel panel-default panel-bot-0">
            <div class="panel-heading">
                RIESGOS
            </div>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <a href="{{URL::to('/mantenimiento/creariesgo')}}" class="btn btn-primary pull-right" title="Crear Nuevo Riesgo"><i class="fa fa-plus-square"></i> Crear</a>
            </div>
        </div>
        <div class="col-md-12 box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
                <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Riesgo</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($riesgos as $riesgo)
                    <tr>
                        <td>{{$riesgo->id}}</td>
                        <td>{{$riesgo->riesgo}}</td>
                        <td>{{$riesgo->tipoRiesgo->riesgo}}</td>
                        <td>
                            <a href="{{URL::to('/mantenimiento/editariesgo/').'/'.$riesgo->id}}" title="EDITAR"><i class="fa fa-edit"></i></a>
                            <a href="{{URL::to('/mantenimiento/eliminariesgo/').'/'.$riesgo->id}}" title="ELIMINAR"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('mantenimientos.scripts')
@endsection