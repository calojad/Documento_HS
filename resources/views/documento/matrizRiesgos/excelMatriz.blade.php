<!DOCTYPE html>
<html lang="en">
<head>
    <title> Matrix riesgos </title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th{
            font-size: 9pt;
            text-align: left;
        }
        div.titulo{
            font-weight: bolder;
            text-align: center;
            margin: 2% 0;
        }
        .vertical{
            writing-mode: vertical-lr;
            transform: rotate(180deg);
        }
    </style>
</head>
<body>
<div>
    <button id="btnExcel" type="button">Exportar a Excel</button>
</div>
<div id="contenedorT">
    <div class="titulo">
        @if($empresa != null)
            <br>{{$empresa->nombre}}
        @endif
    </div>
    <div class="titulo" style="width: 100%;">
        <table style="width: 100%;">
            <tr>
                <td rowspan="3" colspan="2"><h2 style="text-align: center">Matriz de Identificación y Evaluación de Riesgos</h2></td>
                <td>Codigo:</td>
            </tr>
            <tr>
                <td style="text-align: center">Fecha de elaboracion:</td>
            </tr>
            <tr>
                <td style="text-align: center">{{date('d-m-Y')}}</td>
            </tr>
        </table>
    </div>
    <div style="width: 100%;margin-bottom: 2%;">
        <table style="width: 100%;">
            <tr>
                <th width="320">Departamento: </th>
                <th width="60" bgcolor="#d3d3d3">Provincia:</th>
                <th width="120" colspan="2"> </th>
                <th width="60" bgcolor="#d3d3d3">Cantón:</th>
                <td colspan="4"></td>
            </tr>
            <tr>
                <th>Puesto de trabajo: </th>
                <th colspan="3" style="text-align: center" bgcolor="#d3d3d3">Tiempo de exposición (h/día):</th>
                <td></td>
                <th bgcolor="#d3d3d3" colspan="2">Nº de trabajadores: H/M/ </th>
                <td colspan="2"></td>
            </tr>
            <tr>
                <th>Responsable Directo: </th>
                <th colspan="3" bgcolor="#d3d3d3">Responsable de Seguridad y Salud Ocupacional: </th>
                <th colspan="5"></th>
            </tr>
            <tr>
                <th style="text-align: center" bgcolor="#d3d3d3">Actividades Rutinarias</th>
                <th colspan="4" style="text-align: center" bgcolor="#d3d3d3">Población Vulnerable</th>
                <th colspan="4" style="text-align: center" bgcolor="#d3d3d3">Evaluación</th>
            </tr>
            <tr>
                <th style="height: 60px;" rowspan="3"></th>
                <th>Maternidad</th>
                <th width="1"> </th>
                <th rowspan="3" colspan="2" valign="top">Detalle:</th>
                <th>Inicial:</th>
                <th width="35"> </th>
                <th>Periodica:</th>
                <th></th>
            </tr>
            <tr>
                <th>Discapacidad</th>
                <th></th>
                <th colspan="4">Fecha Evaluación:</th>
            </tr>
            <tr>
                <th width="70">Edades Extremas</th>
                <th></th>
                <th colspan="4">Fecha última evaluación:</th>
            </tr>
            <tr>
                <th style="text-align: center" bgcolor="#d3d3d3">Actividades No Rutinarias</th>
                <th colspan="8" style="text-align: center" bgcolor="#d3d3d3">Descripción de útiles, herramientas, maquinaria y equipo de trabajo</th>
            </tr>
            <tr>
                <td style="height: 80px;"></td>
                <td style="height: 40px;" colspan="8"></td>
            </tr>
        </table>
    </div>
    <div style="width:1050px;">
        <table style="width: 100%;">
            <thead>
            <tr>
                <th rowspan="3" style="text-align: center" width="2">#</th>
                <th rowspan="3" style="text-align: center" width="10">Factor de Riesgo</th>
                <th rowspan="3" style="text-align: center" width="400">Peligro Identificado</th>
                <th colspan="3" style="text-align: center" width="5">Probabilidad</th>
                <th colspan="3" style="text-align: center" width="5">Consecuencias</th>
                <th colspan="5" style="text-align: center" width="80">Estimación del Riesgo</th>
                <th rowspan="3" style="text-align: center" width="190">Observaciones</th>
            </tr>
            <tr>
                <th bgcolor="#e9967a" align="center">B</th>
                <th bgcolor="yellow" align="center">M</th>
                <th bgcolor="red" align="center">A</th>
                <th bgcolor="#e9967a" align="center">LD</th>
                <th bgcolor="yellow" align="center">D</th>
                <th bgcolor="red" align="center">ED</th>
                <th bgcolor="#f0e68c" align="center">T</th>
                <th bgcolor="yellow" align="center">TO</th>
                <th bgcolor="#e9967a" align="center">MO</th>
                <th bgcolor="gray" align="center">I</th>
                <th bgcolor="red" align="center">IN</th>
            </tr>
            <tr>
                <th bgcolor="#e9967a" align="center">1</th>
                <th bgcolor="yellow" align="center">2</th>
                <th bgcolor="red" align="center">3</th>
                <th bgcolor="#e9967a" align="center">1</th>
                <th bgcolor="yellow" align="center">2</th>
                <th bgcolor="red" align="center">3</th>
                <th bgcolor="#f0e68c" align="center">2</th>
                <th bgcolor="yellow" align="center">3</th>
                <th bgcolor="#e9967a" align="center">4</th>
                <th bgcolor="gray" align="center">5</th>
                <th bgcolor="red" align="center">6</th>
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
                                <td rowspan="{{$nt->numero}}" style="writing-mode: vertical-lr;
            transform: rotate(180deg);">{{$riesgo->tipoRiesgo->riesgo}}</td>
                            <!-- {{$aux = false}} -->
                            @endif
                            <td>{{$riesgo->riesgo}}</td>
                            @if($empresa != null)
                                {{-- COLUMNAS PROBABILIDAD --}}
                                <td style="text-align: center" bgcolor="{{$riesgo->probabilidad==1?'#e9967a':''}}">{{$riesgo->probabilidad==1?'x':''}}</td>
                                <td style="text-align: center" bgcolor="{{$riesgo->probabilidad==2?'yellow':''}}">{{$riesgo->probabilidad==2?'x':''}}</td>
                                <td style="text-align: center" bgcolor="{{$riesgo->probabilidad==3?'red':''}}">{{$riesgo->probabilidad==3?'x':''}}</td>
                                {{-- COLUMNAS CONSECUENCIAS --}}
                                <td style="text-align: center" bgcolor="{{$riesgo->consecuencia==1?'#e9967a':''}}">{{$riesgo->consecuencia==1?'x':''}}</td>
                                <td style="text-align: center" bgcolor="{{$riesgo->consecuencia==2?'yellow':''}}">{{$riesgo->consecuencia==2?'x':''}}</td>
                                <td style="text-align: center" bgcolor="{{$riesgo->consecuencia==3?'red':''}}">{{$riesgo->consecuencia==3?'x':''}}</td>
                                {{-- COLUMNAS ESTIMACION --}}
                                <td style="text-align: center" bgcolor="{{$riesgo->estimacion==1?'#f0e68c':''}}">{{$riesgo->estimacion==1?'x':''}}</td>
                                <td style="text-align: center" bgcolor="{{$riesgo->estimacion==2?'yellow':''}}">{{$riesgo->estimacion==2?'x':''}}</td>
                                <td style="text-align: center" bgcolor="{{$riesgo->estimacion==3?'#e9967a':''}}">{{$riesgo->estimacion==3?'x':''}}</td>
                                <td style="text-align: center" bgcolor="{{$riesgo->estimacion==4?'gray':''}}">{{$riesgo->estimacion==4?'x':''}}</td>
                                <td style="text-align: center" bgcolor="{{$riesgo->estimacion==5?'red':''}}">{{$riesgo->estimacion==5?'x':''}}</td>
                                <td></td>
                            @else
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            @endif
                        </tr>
                    @endif
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- jQuery 3.2.1 -->
<script src="{{ asset('/plugins/jquery-libs/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    var tableToExcel = (function() {
        var uri = 'data:application/vnd.ms-excel;base64,'
            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
            , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
            , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
        return function(table, name) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
            window.location.href = uri + base64(format(template, ctx))
        }
    })();
    $('#btnExcel').on('click',function () {
        window.open('data:application/vnd.ms-excel,' + $('#contenedorT').html());
        e.preventDefault();
    });
</script>
</body>
</html>