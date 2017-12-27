@extends('layouts.mante')
@section('content')
    <div class="row"></div>
    <div class="col-md-12">
        <div class="panel panel-default panel-bot-0">
            <div class="panel-heading">
                TIPO DE RIESGOS
            </div>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <a class="btn btn-primary pull-right" title="Crear Nuevo Tipo"><i class="fa fa-plus-square"></i> Crear</a>
            </div>
        </div>
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
                <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Tipo Riesgo</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tipoRiesgos as $riesgo)
                    <tr>
                        <td>{{$riesgo->id}}</td>
                        <td>{{$riesgo->riesgo}}</td>
                        <td>
                            <a title="EDITAR"><i class="fa fa-edit"></i></a>
                            <a title="ELIMINAR"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('mantenimientos.scripts')
@endsection