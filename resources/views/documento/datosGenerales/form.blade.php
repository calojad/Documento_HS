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
                    <div class="panel-heading"><i class="fa fa-user"></i> DATOS GENERALES</div>
                    <div class="panel-body">
                        {!! Form::open(['url'=>'/documento/datosgenerales','method'=>'post','class'=>'form-horizontal row-border','enctype'=>'multipart/form-data']) !!}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-4">Tipo de Organización: </label>
                                <div class="col-md-8">
                                    <label class="col-md-4">
                                        <input name="tipoEmpresa" type="radio" value="1" {{$empresa->tipoEmpresa == 1 ? 'checked' :''}} checked>
                                        Empresa
                                    </label>
                                    <label class="col-md-4">
                                        <input name="tipoEmpresa" type="radio" value="2" {{$empresa->tipoEmpresa == 2 ? 'checked' :''}}>
                                        Institución
                                    </label>
                                    <label class="col-md-4">
                                        <input name="tipoEmpresa" type="radio" value="3" {{$empresa->tipoEmpresa == 3 ? 'checked' :''}}>
                                        Sin Fines de Lucro
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Privada / Publica: </label>
                                <div class="col-md-8">
                                    <label class="col-md-4">
                                        <input name="privada_publica" type="radio" value="1" {{$empresa->privada_publica == 1 ? 'checked' :''}} checked>
                                        Privada
                                    </label>
                                    <label class="col-md-4">
                                        <input name="privada_publica" type="radio" value="2" {{$empresa->privada_publica == 1 ? 'checked' :''}}>
                                        Publica
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Nombre Empresa: </label>
                                <div class="col-md-8">
                                    <input name="nombre" class="form-control" type="text" value="{{$empresa->nombre != null ? $empresa->nombre : old('nombre')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Logo: </label>
                                <div class="col-md-5">
                                    <img style="margin: 1em 0" width="100px" src="{{Storage::url($empresa->logo)}}">
                                    <input name="logo" class="form-control" type="file" style="height: inherit;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Registro Único de Contribuyentes (RUC): </label>
                                <div class="col-md-8">
                                    <input name="ruc" class="form-control" required type="text" value="{{$empresa->ruc != null ? $empresa->ruc : old('ruc')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Razón Social: </label>
                                <div class="col-md-8">
                                    <input name="razonSocial" class="form-control" required type="text" value="{{$empresa->razonSocial != null ?$empresa->razonSocial:old('razonSocial')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Actividad Económica: </label>
                                <div class="col-md-8">
                                    <input name="actiEconomica" class="form-control" required type="text" value="{{$empresa->actiEconomica != null ?$empresa->actiEconomica:old('actiEconomica')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Tamaño de la Empresa/Institución: </label>
                                <div class="col-md-8">
                                    <div class="radio">
                                        <label>
                                            <input name="tamaño" type="radio" value="1" checked required {{$empresa->tamaño == 1 ? 'checked' :''}}>
                                            Microempresa: 1 a 9
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input name="tamaño" type="radio" value="2" {{$empresa->tamaño == 2 ? 'checked' :''}}>
                                            Pequeña empresa: 10 a 49
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input name="tamaño" type="radio" value="3" {{$empresa->tamaño == 3 ? 'checked' :''}}>
                                            Mediana empresa A: 50 a 99
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input name="tamaño" type="radio" value="4" {{$empresa->tamaño == 4 ? 'checked' :''}}>
                                            Mediana empresa B: 100 a 199
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input name="tamaño" type="radio" value="5" {{$empresa->tamaño == 5 ? 'checked' :''}}>
                                            Gran empresa: 200 en adelante
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">N° Hombre: </label>
                                <div class="col-md-4">
                                    <input name="hombres" class="form-control" type="number" value="{{$empresa->hombres != null ?$empresa->hombres:0}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">N° Mujeres: </label>
                                <div class="col-md-4">
                                    <input name="mujeres" class="form-control" required type="number" value="{{$empresa->mujeres != null ?$empresa->mujeres:0}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">N° Menores: </label>
                                <div class="col-md-4">
                                    <input name="menores" class="form-control" required type="number" value="{{$empresa->menores != null ?$empresa->menores :0}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">N° Personal Vulnerables: </label>
                                <div class="col-md-4">
                                    <input name="vulnerables" class="form-control" required type="number" value="{{$empresa->vulnerables != null ?$empresa->vulnerables:0}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Centros de Trabajo: </label>
                                <div class="col-md-8">
                                    <div class="radio">
                                        <label>
                                            <input name="centros" type="radio" value="1" checked required {{$empresa->centros == 1 ? 'checked' :''}}>
                                            1
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input name="centros" type="radio" value="2" {{$empresa->centros == 2 ? 'checked' :''}}>
                                            2
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input name="centros" type="radio" value="3" {{$empresa->centros == 3 ? 'checked' :''}}>
                                            3
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input name="centros" type="radio" value="4" {{$empresa->centros == 4 ? 'checked' :''}}>
                                            4 a 10
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input name="centros" type="radio" value="5" {{$empresa->centros == 5 ? 'checked' :''}}>
                                            10 a 22
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input name="centros" type="radio" value="6" {{$empresa->centros == 6 ? 'checked' :''}}>
                                            <input id="otrosCentros" name="otrosCentros" type="number" placeholder="Otros" disabled value="{{$empresa->otrosCentros != null ?$empresa->otrosCentros:old('otrosCentros')}}">
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Matriz:</label>
                                <div class="col-md-8">
                                    <input name="direccion_matriz" class="form-control" required type="text" placeholder="Dirección" value="{{$empresa->id != null ?$empresa->direccionMatriz($empresa->id)->direccion:old('direccionMatriz')}}">
                                </div>
                            </div>
                            <div id="divDireccionSucursal" class="col-md-12">
                                {{--INPUTS CON DIRECCION DE SUCURSALES AGREGADOS CON JQUERY--}}
                                @if($empresa->centros > 1)
                                    @foreach($Sucdirecciones as $direccion)
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Sucursal: </label>
                                            <div class="col-md-8">
                                                <input name="direccion_sucursal_{{$direccion->sucursal}}" class="form-control" required type="text" value="{{$direccion->direccion}}">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="page-header col-md-12"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <h4 class="col-md-5 control-label"><b>La Empresa Cuenta Con: </b></h4>
                                <div class="col-md-7"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label">Comité de Seguridad e Higiene de Trabajo: </label>
                                <div class="radio">
                                    <label>
                                        <input name="comiteSH" type="radio" value="1" checked {{$empresa->comiteSH == 1 ?'checked':''}}>
                                        Si
                                    </label>
                                    <label>
                                        <input name="comiteSH" type="radio" value="0" {{$empresa->comiteSH == 0 ?'checked':''}}>
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label">Unidad o Departamento de Seguridad: </label>
                                <div class="radio">
                                    <label>
                                        <input name="unidadSeg" type="radio" value="1" checked {{$empresa->unidadSeg == 1 ?'checked':''}}>
                                        Si
                                    </label>
                                    <label>
                                        <input name="unidadSeg" type="radio" value="0" {{$empresa->unidadSeg == 0 ?'checked':''}}>
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label">Servicio Médico: </label>
                                <div class="radio">
                                    <label>
                                        <input name="servicioMed" type="radio" value="1" checked {{$empresa->servicioMed == 1 ?'checked':''}}>
                                        Si
                                    </label>
                                    <label>
                                        <input name="servicioMed" type="radio" value="0" {{$empresa->servicioMed == 0 ?'checked':''}}>
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label">Programas de capacitación en prevención de riesgos: </label>
                                <div class="radio">
                                    <label>
                                        <input name="capacitacionRiesgo" type="radio" value="1" checked {{$empresa->capacitacionRiesgo == 1 ?'checked':''}}>
                                        Si
                                    </label>
                                    <label>
                                        <input name="capacitacionRiesgo" type="radio" value="0" {{$empresa->capacitacionRiesgo == 0 ?'checked':''}}>
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label">Planes de Contingencia y control de accidentes mayores: </label>
                                <div class="radio">
                                    <label>
                                        <input name="contingencia" type="radio" value="1" checked {{$empresa->contingencia == 1 ?'checked':''}}>
                                        Si
                                    </label>
                                    <label>
                                        <input name="contingencia" type="radio" value="0" {{$empresa->contingencia == 0 ?'checked':''}}>
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label">Registro estadístico de accidentes e incidentes: </label>
                                <div class="radio">
                                    <label>
                                        <input name="registroEstadist" type="radio" value="1" checked {{$empresa->registroEstadist == 1 ?'checked':''}}> Si
                                    </label>
                                    <label>
                                        <input name="registroEstadist" type="radio" value="0" {{$empresa->registroEstadist == 0 ?'checked':''}}> No
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-5">Registro de la mobilidad laboral: </label>
                                <div class="radio">
                                    <label>
                                        <input name="registroMobilidad" type="radio" value="1" checked {{$empresa->registroMobilidad == 1 ?'checked':''}}> Si
                                    </label>
                                    <label>
                                        <input name="registroMobilidad" type="radio" value="0" {{$empresa->registroMorbilidad == 0 ?'checked':''}}> No
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-5 control-label">Exámenes médicos preventivo y periódicos: </label>
                                <div class="radio">
                                    <label>
                                        <input name="examenMedico" type="radio" value="1" checked {{$empresa->examenMedico == 1 ?'checked':''}}> Si
                                    </label>
                                    <label>
                                        <input name="examenMedico" type="radio" value="0" {{$empresa->examenMedico == 0 ?'checked':''}}> No
                                    </label>
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
@include('documento.datosGenerales.form_scripts')
@endsection

@section('script')
    <!-- iCheck 1.0.1 -->
    <script src="{{asset('/plugins/iCheck/icheck.min.js')}}"></script>
@endsection
