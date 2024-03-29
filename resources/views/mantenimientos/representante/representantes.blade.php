@extends('layouts.mante')
@section('content')
    <div class="row"></div>
    <div class="col-md-12">
        <div class="panel panel-default panel-bot-0">
            <div class="panel-heading">
                REPRESENTANTES
            </div>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <a class="btn btn-primary pull-right" title="Crear Nuevo Representante"><i class="fa fa-plus-square"></i> Crear</a>
            </div>
        </div>
        <div class="col-md-12 box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
                <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Cedula</th>
                    <th>Empresa</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($representantes as $representante)
                    <tr>
                        <td>{{$representante->id}}</td>
                        <td>{{$representante->nombre}}</td>
                        <td>{{$representante->cedula}}</td>
                        <td>{{$representante->empresa->nombre}}</td>
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