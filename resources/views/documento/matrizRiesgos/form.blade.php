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
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="width: 10px;">#</th>
                                            <th>Riesgo</th>
                                            <th>Probabilidad</th>
                                            <th>Consecuencia</th>
                                            <th>Estimación</th>
                                            <th>Control</th>
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
                                                <td>{!! Form::select('probabilidad_$riesgo->id',$probabilidades,0,array('required'=>'required', 'id'=>'probabilidad_'.$riesgo->id, 'riesgoId'=>$riesgo->id, 'class'=>'probabilidad')) !!}</td>
                                                <td>{!! Form::select('consecuencia_$riesgo->id',$consecuencias,0,array('required'=>'required','id'=>'consecuencia_'.$riesgo->id, 'riesgoId'=>$riesgo->id, 'class'=>'consecuencia')) !!}</td>
                                                <td><label id="estimacion_{{$riesgo->id}}" class="label label-default" name="estimacion_{{$riesgo->id}}" style="font-size: 10pt"></label></td>
                                                <td>{!! Form::select('control[]',$control,0,array('required'=>'required')) !!}</td>
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
            </div>
        </div>
    </div>
    @include('documento.matrizRiesgos.form_scripts')
@endsection

{{--@section('script')
    <!-- iCheck 1.0.1 -->
    <script src="{{asset('/plugins/iCheck/icheck.min.js')}}"></script>
@endsection--}}
