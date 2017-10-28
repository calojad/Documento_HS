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
                    <div class="panel-heading"><i class="fa fa-check-circle"></i> OBJETO Y ÁMBITO DE APLICACIÓN</div>
                    <div class="panel-body">
                        {!! Form::open(['url'=>'documento/objetivosambito', 'method'=>'post','class'=>'form-horizontal row-border']) !!}
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label class="col-md-12 control-label">Objeto:</label>
                                    <button type="button" class="btn btn-twitter pull-right" data-toggle="modal" data-target="#modalObjetivos"><i class="fa fa-plus-square"></i> Añadir</button>
                                </div>
                                <div class="col-md-9">
                                    {!! Form::select('objeto[]',$objetivos,$doc_obj,array('multiple' => true, 'class' => 'multi-select', 'id' => 'objeto', 'required'=>'required')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label class="col-md-12 control-label">Ámbito de aplicación:</label>
                                    <button type="button" class="btn btn-twitter pull-right" data-toggle="modal" data-target="#modalAmbitos"><i class="fa fa-plus-square"></i> Añadir</button>
                                </div>
                                <div class="col-md-9">
                                    {!! Form::select('ambito[]',$ambitos,$doc_amb,array('multiple' => true, 'class' => 'multi-select', 'id' => 'ambito','required'=>'required')) !!}
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
    <div id="modalObjetivos" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Añadir un Objetivo</h4>
                </div>
                {!! Form::open(['url'=>'objetivos/crear', 'method'=>'post']) !!}
                <div class="modal-body row form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-3">Titulo:</label>
                        <div class="col-md-8">
                            <input name="titulo" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Descripción:</label>
                        <div class="col-md-8">
                            <textarea name="descripcion" class="form-control" type="text"></textarea>
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
    <div id="modalAmbitos" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Añadir un Ambito</h4>
                </div>
                {!! Form::open(['url'=>'ambitos/crear', 'method'=>'post']) !!}
                <div class="modal-body row form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-3">Titulo:</label>
                        <div class="col-md-8">
                            <input name="titulo" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Descripción:</label>
                        <div class="col-md-8">
                            <input name="descripcion" class="form-control" type="text">
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
    @include('documento.objetivosAmbito.form_scripts')
@endsection

@section('script')
    <!-- iCheck 1.0.1 -->
    <script src="{{asset('/plugins/iCheck/icheck.min.js')}}"></script>
@endsection
