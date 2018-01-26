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
                    <div class="panel-heading"><i class="fa fa-check-circle"></i> POLÍTICA DE SEGURIDAD Y SALUD EN EL TRABAJO</div>
                    <div class="panel-body">
                        {!! Form::open(['url'=>'documento/politicasalud', 'method'=>'post','class'=>'form-horizontal row-border', 'enctype'=>'multipart/form-data']) !!}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Reprecentante legal: </label>
                                <div class="col-md-9">
                                    <input name="reprecentante" class="form-control" type="text" required placeholder="Nombres y Apellidos" value="{{$reprecentante != null ?$reprecentante->nombre:old('reprecentante')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Cedula: </label>
                                <div class="col-md-9">
                                    <input name="cedula" class="form-control" type="text" required value="{{$reprecentante != null ?$reprecentante->cedula:old('reprecentante')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Firma: </label>
                                <div class="col-md-9">
                                    <img style="margin: 1em 0" width="100px" src="{{Storage::url($reprecentante->firma)}}">
                                    <input name="firma" class="form-control" type="file" style="height: inherit;">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label class="col-md-12 control-label">Políticas: </label>
                                    <button type="button" class="btn btn-twitter pull-right" data-toggle="modal" data-target="#modalPoliticas"><i class="fa fa-plus-square"></i> Añadir</button>
                                </div>
                                <div class="col-md-9">
                                    {!! Form::select('politicas[]',$politicas,$doc_politicas,array('multiple' => true, 'class' => 'searchable', 'id' => 'politicas','required'=>'required')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary pull-right" type="submit"><i class="fa fa-arrow-right"></i>
                                Siguiente</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modalPoliticas" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Añadir una Política</h4>
                </div>
                {!! Form::open(['url'=>'politica/crear', 'method'=>'post']) !!}
                <div class="modal-body form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-3">Titulo:</label>
                        <div class="col-md-8">
                            <input name="titulo" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Descripción:</label>
                        <div class="col-md-8">
                            <textarea name="descripcion" class="form-control" type="text" style="resize: vertical;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @include('documento.politicaSalud.form_scripts')
@endsection

@section('script')
    <!-- Quick Search Jquery -->
    <script src="{{asset('/plugins/jquery-libs/jquery.quicksearch.js')}}" type="text/javascript"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{asset('/plugins/iCheck/icheck.min.js')}}"></script>
    <!-- Multi-Select -->
    <script src="{{asset('plugins/jquery-multi-select/js/jquery.multi-select.js')}}"></script>
    <script src="{{asset('plugins/jquery-multi-select/js/multi-select-init.js')}}"></script>
@endsection
