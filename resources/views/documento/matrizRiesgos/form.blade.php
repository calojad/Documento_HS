@extends('layouts.app')
{{--@section('style')
    <link href="{{asset('/plugins/iCheck/square/blue.css')}}" rel="stylesheet">
@endsection--}}
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
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">#</th>
                                        <th>Riesgo</th>
                                        <th>Probabilidad</th>
                                        <th>Consecuencia</th>
                                        <th>Estimación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{ $count=0 }}
                                    @foreach($riesgos as $riesgo)
                                    {{ $count++ }}
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$riesgo->riesgo}}</td>
                                        <td><select></select></td>
                                        <td><select></select></td>
                                        <td><label id="estimacion" class="label"></label></td>
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
