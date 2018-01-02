@extends('layouts.mante')
@section('content')
    <div class="row"></div>
    <div class="col-md-12">
        <div class="panel panel-default panel-bot-0">
            <div class="panel-heading">
                EMPRESAS
            </div>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <a href="{{URL::to('mantenimiento/crearempresa/')}}" class="btn btn-primary pull-right" title="Crear Nueva Empresa"><i class="fa fa-plus-square"></i> Crear</a>
            </div>
        </div>
        <div class="col-md-12 box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
                <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Empresa</th>
                    <th>Ruc</th>
                    <th>Actividad Economica</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($empresas as $empresa)
                    <tr>
                        <td>{{$empresa->id}}</td>
                        <td>{{$empresa->nombre}}</td>
                        <td>{{$empresa->ruc}}</td>
                        <td>{{$empresa->actiEconomica}}</td>
                        <td>
                            <a href="{{URL::to('mantenimiento/editarempresa/').'/'.$empresa->id}}" title="EDITAR"><i class="fa fa-edit"></i></a>
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