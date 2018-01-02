@extends('layouts.mante')
@section('content')
    <div class="row"></div>
    <div class="col-md-12">
        <div class="panel panel-default panel-bot-0">
            <div class="panel-heading">
                OBJETIVOS
            </div>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <a href="{{URL::to('/mantenimiento/crearobjetivo')}}" class="btn btn-primary pull-right" title="Crear Nuevo Objetivo"><i class="fa fa-plus-square"></i> Crear</a>
            </div>
        </div>
        <div class="col-md-12 box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
                <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Objetivo</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($objetivos as $objetivo)
                    <tr>
                        <td>{{$objetivo->id}}</td>
                        <td>{{$objetivo->titulo}}</td>
                        <td>
                            <a href="{{URL::to('/mantenimiento/editarobjetivo/').'/'.$objetivo->id}}" title="EDITAR"><i class="fa fa-edit"></i></a>
                            <a href="{{URL::to('/mantenimiento/eliminarobjetivo/').'/'.$objetivo->id}}" title="ELIMINAR"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('mantenimientos.scripts')
@endsection