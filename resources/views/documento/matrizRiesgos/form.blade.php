@extends('layouts.app')
{{--@section('style')
    <link href="{{asset('/plugins/iCheck/square/blue.css')}}" rel="stylesheet">
@endsection--}}
<style>
    input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
    input[type=number] {
        -moz-appearance:textfield;
        width: 30px;
        text-align: center;
    }
    tr.col-riezgos > td > input{
        width: 30px;
    }
    table{
        font-size: unset;
    }
</style>
@section('content')
    <div class="container" style="width: 1300px;">
        <div class="row">
            {!! Alert::render() !!}
            <div class="col-md-11">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-check"></i> IDENTIFICACIÓN Y EVALUACIÓN INICIAL DE RIESGOS</div>
                    <div class="panel-body">
                        {!! Form::open(['url'=>'/documento/identificariesgos','method'=>'post','class'=>'form-horizontal row-border','enctype'=>'multipart/form-data']) !!}
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
                                <thead>
                                <tr>
                                    <th rowspan="2">Tipo Riesgo</th>
                                    <th rowspan="2">Peligro Identificativo</th>
                                    <th colspan="3">Probabilidad</th>
                                    <th colspan="3">Consecuencias</th>
                                    <th colspan="5">Estimación del Riesgo</th>
                                    <th rowspan="2">Control</th>
                                    <th rowspan="2">Prioridad</th>
                                    <th rowspan="2">Observaciones</th>
                                    <th rowspan="2">Seguimiento</th>
                                </tr>
                                <tr>
                                    <th>B</th>
                                    <th>M</th>
                                    <th>A</th>
                                    <th>LD</th>
                                    <th>D</th>
                                    <th>ED</th>
                                    <th>T</th>
                                    <th>TO</th>
                                    <th>M</th>
                                    <th>I</th>
                                    <th>IN</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($riesgos as $riesgo)
                                    <tr class="col-riezgos">
                                        <td>{{$riesgo->tipoRiesgo_id}}</td>
                                        <td>{{$riesgo->riesgo}}</td>
                                        <td><input type="number"></td>
                                        <td><input type="number"></td>
                                        <td><input type="number"></td>
                                        <td><input type="number"></td>
                                        <td><input type="number"></td>
                                        <td><input type="number"></td>
                                        <td><input type="number"></td>
                                        <td><input type="number"></td>
                                        <td><input type="number"></td>
                                        <td><input type="number"></td>
                                        <td><input type="number"></td>
                                        <td><input type="text"></td>
                                        <td><input type="text"></td>
                                        <td><input type="text"></td>
                                        <td><input type="text"></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
    @include('documento.matrizRiesgos.form_scripts')
@endsection

{{--@section('script')
    <!-- iCheck 1.0.1 -->
    <script src="{{asset('/plugins/iCheck/icheck.min.js')}}"></script>
@endsection--}}
