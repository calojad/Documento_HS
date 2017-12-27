@extends('layouts.mante')
@section('content')
    <div class="row"></div>
    <div class="col-md-12">
        <div class="panel panel-default panel-bot-0">
            <div class="panel-heading">
                PARRAFOS
            </div>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <a href="{{URL::to('/mantenimiento/crearparrafo')}}" class="btn btn-primary pull-right" title="Crear Nuevo Parrafo"><i class="fa fa-plus-square"></i> Crear</a>
            </div>
        </div>
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
                <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Titulo</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($parrafos as $parrafo)
                    <tr>
                        <td>{{$parrafo->id}}</td>
                        <td>{{$parrafo->titulo}}</td>
                        <td>
                            <a href="{{URL::to('/mantenimiento/editarparrafo/').'/'.$parrafo->id}}" title="EDITAR"><i class="fa fa-edit"></i></a>
                            <a href="{{URL::to('/mantenimiento/eliminarparrafo/').'/'.$parrafo->id}}" title="ELIMINAR"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('mantenimientos.scripts')
@endsection