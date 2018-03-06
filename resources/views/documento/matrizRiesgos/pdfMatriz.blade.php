<!DOCTYPE html>
<html lang="en">
<head>
    <title> Matrix riesgos </title>
    {{--<link rel="shortcut icon" href="{{ URL::to('/images/citas/ico.ico')}}">--}}
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th{
            font-size: 9pt;
        }
        div.fecha{
            font-size: 9pt;
            font-weight: bold;
        }
        div.titulo{
            font-size: 18pt;
            font-weight: bolder;
            text-align: center;
        }
    </style>
</head>
<body>
    <div>
        <div class="titulo">
            Identificación y Evaluación de Riesgos
            @if($empresa != null)
            <br>{{$empresa->nombre}}
            @endif
        </div>
        <div class="fecha" align="right">
            <label>Fecha: {{date('d-m-Y')}}</label>
        </div>
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tipo Riesgo</th>
                    <th>Peligro</th>
                    <th>Probabilidad</th>
                    <th>Consecuencias</th>
                    <th>Estimación del Riesgo</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- {{$contador = 0}} -->
            @foreach($numTipo as $nt)
                <!-- {{$aux = true}} -->
                @foreach($riesgos as $riesgo)
                    @if($riesgo->tipoRiesgo_id == $nt->tipoRiesgo_id)
                    <!-- {{$contador ++}} -->
                    <tr>
                        <td>{{$contador}}</td>
                        @if($aux == true)
                        <td rowspan="{{$nt->numero}}">{{$riesgo->tipoRiesgo->riesgo}}</td>
                        <!-- {{$aux = false}} -->
                        @endif
                        <td>{{$riesgo->riesgo}}</td>
                        <td style="text-align: center">@if($empresa != null) {{$riesgo->probabilidad}} @endif</td>
                        <td style="text-align: center">@if($empresa != null) {{$riesgo->consecuencia}} @endif</td>
                        <td style="text-align: center">@if($empresa != null) {{$riesgo->estimacion}} @endif</td>
                        <td></td>
                    </tr>
                    @endif
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>