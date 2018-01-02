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
                    <div class="panel-heading"><i class="fa fa-check"></i> IDENTIFICACIÓN Y EVALUACIÓN INICIAL DE RIESGOS</div>
                </div>
                <div class="panel-body">
                    <input id="riesgosEmpresa" type="hidden" value="{{$riesgosEmp}}">
                    {!! Form::open(['url'=>'/documento/identificariesgos','method'=>'post','class'=>'form-horizontal row-border']) !!}
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
                                <div class="col-md-12">
                                    <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
                                        <thead>
                                        <tr>
                                            <th style="width: 10px;">#</th>
                                            <th>Riesgo</th>
                                            <th>Seleccionar</th>
                                            <th>Accion</th>
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
                                                    <input id="{{$riesgo->id}}" type="checkbox" name="riesgos[]" value="{{$riesgo->id}}">
                                                </td>
                                                <td><a><i class="fa fa-edit"></i></a>
                                                </td>
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
                    <button class="btn btn-primary pull-right">Guardar</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @include('documento.matrizRiesgos.form_scripts')
@endsection

{{--@section('script')
    <!-- iCheck 1.0.1 -->
    <script src="{{asset('/plugins/iCheck/icheck.min.js')}}"></script>
@endsection--}}
