@extends('layouts.mante')
@section('content')
    <div class="row"></div>
    <div class="col-md-12">
        <div class="panel panel-default panel-bot-0">
            <div class="panel-heading">
                ARTICULOS
            </div>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <a href="{{URL::to('mantenimiento/creararticulo')}}" class="btn btn-primary pull-right" title="Crear Nuevo Articulo"><i class="fa fa-plus-square"></i> Crear</a>
            </div>
        </div>
        <div class="col-md-12 box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Riesgo/Peligro</th>
                    <th>Articulo</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($articulos as $articulo)
                    <tr>
                        <td>{{$articulo->num_articulo}}</td>
                        <td>{{$articulo->riesgo->riesgo}}</td>
                        <td>{{$articulo->articulo}}</td>
                        <td>
                            <a href="{{URL::to('mantenimiento/editararticulo/').'/'.$articulo->id}}" title="EDITAR"><i class="fa fa-edit"></i></a>
                            <a href="{{URL::to('mantenimiento/eliminararticulo/').'/'.$articulo->id}}" title="ELIMINAR"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('mantenimientos.scripts')
@endsection