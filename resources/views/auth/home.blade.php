@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        {!! Alert::render() !!}
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading">REGLAMENTO INTERNO DE HIGIENE Y SEGURIDAD</div>
                <div class="panel-body">
                    {{--@if (session('status'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">
                                <i class="fa fa-times"></i>
                            </button>
                            {{ session('status') }}
                        </div>
                    @endif--}}
                    <div class="col-md-12">
                        <a class="btn btn-primary" href="{{URL::to('/documento/datosgenerales')}}"><i class="fa fa-plus-square"></i> Nuevo</a>
                    </div>
                    <div class="col-md-12 h5 box-body table-responsive no-padding">
                        <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
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
                                            <a style="margin: 0 1em" title="Editar" href="{{URL::to('documento/datosgenerales/').'/'.$documento->id}}"><i class="fa fa-edit"></i></a>
                                            <a style="margin: 0 1em" title="Descargar" href="{{URL::to('documento/exportplantilla/').'/'.$documento->id}}"><i class="fa fa-download"></i></a>
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
<script type="text/javascript">
    $(document).keyup(function(event){
        if(event.which === 116)
            window.location.href = "/home";
    });
    $(function () {
        $('.table').DataTable({
            "pagingType": "full_numbers",
            "paging": true,
            "aaSorting": [[ 1, 'Desc' ]],
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "autoWidth": false
        });
    });
</script>
@endsection