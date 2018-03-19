@extends('layouts.app')
{{--@section('style')
    <link href="{{asset('/plugins/iCheck/square/blue.css')}}" rel="stylesheet">
@endsection--}}
@section('content')
    <div class="col-md-12">
        <div class="row">
            {!! Alert::render() !!}
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-clipboard"></i> EXPORTAR MATRIZ</div>
                </div>
                <div class="panel-body">
                    <div class="col-md-12" align="right">
                        <a class="btn btn-primary" target="_blank" href="{{URL::to('/documento/exportmatrizpdf')}}" title="Exportar Matriz en blanco a PDF">Exportar PDF <i class="fa fa-file-pdf-o"></i></a>
                        <a class="btn btn-primary" target="_blank" href="{{URL::to('/documento/exportmatrizexcel')}}" title="Exportar Matriz en blanco a Excel">Exportar Excel <i class="fa fa-file-excel-o"></i></a>
                    </div>
                    <div class="col-md-12 box-body">
                        <table class="table table-striped table-bordered table-hover table-checkable datatable">
                            <thead>
                                <tr>
                                    <th>Empresa</th>
                                    <th>Documento</th>
                                    <th>Estado</th>
                                    <th>Exportar</th>
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
                                        <td>
                                            <a target="_blank" href="{{URL::to('/documento/exportmatrizemppdf/'.$documento->empresa->id)}}" title="Exportar matriz de la empresa seleccionada a PDF"><i class="fa fa-file-pdf-o col-md-2"></i></a>
                                            <a target="_blank" href="" title="Exportar matriz de la empresa seleccionada a Ecxel"><i class="fa fa-file-excel-o col-md-2"></i></a>
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
    <script type="text/javascript">
        $(function () {
            $('.table').DataTable({
                "paging": true,
                "aaSorting": [[ 1, 'Desc' ]],
                "lengthChange": true,
                "searching": true,
                "ordering": false,
                "autoWidth": false
            });
        });
    </script>
@endsection

{{--@section('script')
    <!-- iCheck 1.0.1 -->
    <script src="{{asset('/plugins/iCheck/icheck.min.js')}}"></script>
@endsection--}}