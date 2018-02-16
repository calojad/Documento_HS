@extends('layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="row">
            {!! Alert::render() !!}
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-check"></i> IDENTIFICACIÓN Y EVALUACIÓN INICIAL DE RIESGOS</div>
                </div>
                <div class="panel-body">
                    <input id="riesgosEmpresa" type="hidden" value="{{$riesgosEmp}}">
                    {!! Form::open(['url'=>'/documento/identificariesgos','method'=>'post','id'=>'formIdentRiesgos','class'=>'form-horizontal row-border']) !!}
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            @foreach($tipoRiesgos as $triesgo)
                                @if($triesgo->id == 1)
                            <li class="active"><a href="#tab_{{$triesgo->id}}" data-toggle="tab">{{$triesgo->riesgo}}</a></li>
                                @else
                            <li><a href="#tab_{{$triesgo->id}}" data-toggle="tab">{{$triesgo->riesgo}}</a></li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="tab-content" style="height:100%;">
                            @foreach($tipoRiesgos as $tr)
                            @if($tr->id == 1)
                            <div class="tab-pane active" id="tab_{{$tr->id}}" style="overflow-x: auto;">
                            @else
                            <div class="tab-pane" id="tab_{{$tr->id}}" style="overflow-x: auto;">
                            @endif
                                <div class="col-md-12 riesgos">
                                    <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
                                        <thead>
                                        <tr>
                                            <th style="width: 10px;">#</th>
                                            <th>Riesgo</th>
                                            <th>Seleccionar</th>
                                            <th>Probabilidad</th>
                                            <th>Consecuencia</th>
                                            <th>Estimación</th>
                                            {{--<th>Control</th>--}}
                                            {{--<th>Accion</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <!-- {{ $count=0 }} -->
                                        @foreach($riesgos as $riesgo)
                                            @if($riesgo->tipoRiesgo_id == $tr->id)
                                            <!-- {{ $count++ }} -->
                                            <tr>
                                                <td>{{$count}}</td>
                                                <td>{{$riesgo->riesgo}}</td>
                                                <td>
                                                    <input id="{{$riesgo->id}}" class="inpSeleccionar" name="riesgos[]" type="checkbox" value="{{$riesgo->id}}">
                                                </td>
                                                <td id="selProbabilidad_{{$riesgo->id}}">
                                                    No Seleccionado
                                                </td>
                                                <td id="selConsecuencias_{{$riesgo->id}}">
                                                    No Seleccionado
                                                </td>
                                                <td id="labEstimacion_{{$riesgo->id}}">
                                                </td>
                                                {{--<td>
                                                    {!! Form::select('control[]',$control,0,array('required'=>'required')) !!}
                                                </td>--}}
                                                {{--<td>
                                                    <a id="btnEditarRiesgo" data-toggle="modal" data-target="#modalRiesgos" riesgoId="{{$riesgo->id}}"><i class="fa fa-edit"></i></a>
                                                </td>--}}
                                            </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <a id="btnGuardarRiesgos" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Guardar</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div id="modalRiesgos" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar Riesgo</h4>
                </div>
                {!! Form::open(['url'=>'riesgo/riesgoeditar', 'method'=>'post']) !!}
                <input id="modalEditarId" name="modalRiesgoId" type="hidden">
                <div class="modal-body form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-3">Riesgo:</label>
                        <div class="col-md-8">
                            <input id="modalEditarRiesgo" name="riesgo" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Descripción:</label>
                        <div class="col-md-8">
                            <textarea id="modalEditarDescripcion" name="descripcion" class="form-control" type="text" rows="3"></textarea>
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
    @include('documento.matrizRiesgos.form_scripts')
@endsection