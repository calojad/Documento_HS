@extends('layouts.app')
@section('style')
    <link href="{{asset('/plugins/iCheck/square/blue.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="row">
        {!! Alert::render() !!}
        <div class="col-md-11">
            <div class="panel panel-default">
                <div class="panel-heading">REGLAMENTO INTERNO DE HIGIENE Y SEGURIDAD</div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <a class="btn btn-primary" href="{{URL::to('/documento/datosgenerales')}}"><i class="fa fa-plus-square"></i> Nuevo</a>
                    </div>
                    <div class="col-md-12 h5 box-body table-responsive no-padding">
                        <table class="table table-striped table-bordered table-hover table-checkable datatable">
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
                                            <a title="Editar" href="{{URL::to('documento/datosgenerales/').'/'.$documento->id}}"><i class="fa fa-edit"></i></a>
                                            <a title="Descargar" href="{{URL::to('documento/exportplantilla/').'/'.$documento->id}}"><i class="fa fa-download"></i></a>
                                            <a id="btnEliminarDoc" title="Eliminar" docId="{{$documento->id}}"><i class="fa fa-trash"></i></a>
                                            <a id="btnConfigDoc" title="Configuración" docId="{{$documento->id}}" docEncabezado="{{$documento->encabezado}}" data-toggle="modal" data-target="#modalConfigurarDoc"><i class="fa fa-cog"></i></a>
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

<div id="modalConfigurarDoc" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-cog"></i> Configuraciones</h4>
            </div>
            {!! Form::open(['url'=>'documento/configdocumento', 'method'=>'post']) !!}
            <input id="documentoId" type="hidden" name="id" value="0">
            <div class="modal-body form-horizontal">
                <div class="form-group">
                    <label class="control-label col-md-3">Encabezado:</label>
                    <div class="col-md-8">
                        <label class="col-md-4" style="cursor: pointer;">Ninguno
                            <input id="radEnca_3" name="encabezado" type="radio" value="3" class="radEncabezado">
                        </label>
                        <label class="col-md-4" style="cursor: pointer;">Simple
                            <input id="radEnca_1" name="encabezado" type="radio" value="1" class="radEncabezado">
                        </label>
                        <label class="col-md-4" style="cursor: pointer;">ISO
                            <input id="radEnca_2" name="encabezado" type="radio" value="2" class="radEncabezado">
                        </label>
                    </div>
                </div>
                <div class="col-md-12 img-responsive" style="height: 130px;overflow-x: auto;">
                    <img id="imgEncabezado" class="col-md-12" src="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Aceptar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<script type="text/javascript">
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
    $(document).ready(function() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '5%' // optional
        });
        $('.radEncabezado').on('ifClicked', function(event){
            var valor = $(this).val();
            var imagenEnca = $('#imgEncabezado');
            if(valor == 1)
                imagenEnca.attr('src','{{asset('/images/encabesados/Encabezado_1.JPG')}}');
            else if(valor == 2)
                imagenEnca.attr('src','{{asset('/images/encabesados/Encabezado_2.JPG')}}');
            else
                imagenEnca.attr('src','{{asset('/images/encabesados/Encabezado_3.JPG')}}');
        });
    });
    $(document).keyup(function(event){
        if(event.which === 116){
            window.location.href = "/home";
        }
    });
    $(document).on('click','#btnEliminarDoc',function () {
        var docId = $(this).attr('docId');
        $.confirm({
            icon: 'fa fa-warning',
            title: 'Eliminar',
            content: '¿Desea eliminar este registro?',
            type: 'red',
            typeAnimated: true,
            escapeKey: 'close',
            buttons: {
                Aceptar: {
                    text: 'Eliminar',
                    btnClass: 'btn-red',
                    action: function(){
                        var url = '{{URL::to('/documento/eliminardocumento')}}/'+docId;
                        $.get(url,function (json) {
                            window.location.href = json;
                        },'json');
                    }
                },
                close: function () {}
            }
        });
    });
    $(document).on('click','#btnConfigDoc',function () {
        var docId = $(this).attr('docId');
        var docEncabezado = $(this).attr('docEncabezado');
        var imagenEnca = $('#imgEncabezado');

        $('#documentoId').val(docId);

        if(docEncabezado == 1){
            $('#radEnca_1').iCheck('check');
            imagenEnca.attr('src','{{asset('/images/encabesados/Encabezado_1.JPG')}}')
        } else if(docEncabezado == 2){
            $('#radEnca_2').iCheck('check');
            imagenEnca.attr('src','{{asset('/images/encabesados/Encabezado_2.JPG')}}')
        } else {
            $('#radEnca_3').iCheck('check');
            imagenEnca.attr('src','{{asset('/images/encabesados/Encabezado_3.JPG')}}')
        }
    });
</script>
@endsection
@section('script')
    <!-- iCheck 1.0.1 -->
    <script src="{{asset('/plugins/iCheck/icheck.min.js')}}"></script>
@endsection
