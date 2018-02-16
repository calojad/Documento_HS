<script type="text/javascript">
    {{-- ELIMINAR LA CLASE 'CONTAINER' DEL LAYOUT PRINCIPAL --}}
    var contenerdor_layout = $('#contenedor_inicial');
    contenerdor_layout.removeClass('container');
//  MARCAR LOS RIESGOS QUE YA ESTAN CARGADOS EN LA BASE DE DATOS
    $(function () {
        var riesgosEmpresa = JSON.parse($('#riesgosEmpresa').val());
        $.each(riesgosEmpresa,function (key, value) {
//            CARGAR RIESGOS SELECCIONADOS
            $('#'+value.riesgo_id).attr('checked',true);
//            INICIAMOS LAS VARIABLES
            var selecProb = $('#selProbabilidad_'+value.riesgo_id);
            var selecConse = $('#selConsecuencias_'+value.riesgo_id);
            var labEstima = $('#labEstimacion_'+value.riesgo_id)
            var selectedProb = '<option value="0">--Seleccionar--</option><option value="1">B-Baja</option><option value="2">M-Media</option><option value="3">A-Alta</option>';
            switch (value.probabilidad) {
                case 1:
                    selectedProb='<option value="0">--Seleccionar--</option><option value="1" selected>B-Baja</option><option value="2">M-Media</option><option value="3">A-Alta</option>';
                    break;
                case 2:
                    selectedProb='<option value="0">--Seleccionar--</option><option value="1">B-Baja</option><option value="2" selected>M-Media</option><option value="3">A-Alta</option>';
                    break;
                case 3:
                    selectedProb='<option value="0">--Seleccionar--</option><option value="1">B-Baja</option><option value="2">M-Media</option><option value="3" selected>A-Alta</option>';
                    break;
            }
            var selectedConce = '<option value="0">--Seleccionar--</option><option value="1">LD-Ligeramente Dañino</option><option value="2">D-Dañino</option><option value="3">ED-Extremadamente Dañino</option>';
            switch (value.probabilidad) {
                case 1:
                    selectedConce = '<option value="0">--Seleccionar--</option><option value="1" selected>LD-Ligeramente Dañino</option><option value="2">D-Dañino</option><option value="3">ED-Extremadamente Dañino</option>';
                    break;
                case 2:
                    selectedConce = '<option value="0">--Seleccionar--</option><option value="1">LD-Ligeramente Dañino</option><option value="2" selected>D-Dañino</option><option value="3">ED-Extremadamente Dañino</option>';
                    break;
                case 3:
                    selectedConce = '<option value="0">--Seleccionar--</option><option value="1">LD-Ligeramente Dañino</option><option value="2">D-Dañino</option><option value="3" selected>ED-Extremadamente Dañino</option>';
                    break;
            }
//            CARGAR SELECT DE PROBABILIDADES
            selecProb.empty();
            selecProb.append('<select required="required" id="probabilidad_'+value.riesgo_id+'" riesgoId="'+value.riesgo_id+'" class="probabilidad" name="probabilidad[]">'+selectedProb+'</select>');
//            CARGAR SELECT DE CONSECUENCIAS
            selecConse.empty();
            selecConse.append('<select required="required" id="consecuencia_'+value.riesgo_id+'" riesgoId="'+value.riesgo_id+'" class="consecuencia" name="consecuencia[]">'+selectedConce+'</select>');
//            CARGAR LABEL DE ESTIMACION
            labEstima.empty();
            labEstima.append('<label id="estimacion_'+value.riesgo_id+'" class="label label-default" style="font-size: 10pt"></label>'+
                '<input id="inpEstimacion_'+value.riesgo_id+'" type="hidden" name="estimacion[]" value="'+value.estimacion+'">');
            obtEstimacion(value.probabilidad,value.consecuencia,$('#estimacion_'+value.riesgo_id),value.riesgo_id);
        });
    });
    $(function () {
        $('.table').DataTable({
            "paging": false,
            "aaSorting": [[ 1, 'Desc' ]],
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "autoWidth": false
        });
    });
    $(document).keyup(function(event){
        if(event.which === 116)
            window.location.href = "/documento/identificariesgos";
    });
    $(document).on('change','.probabilidad',function(){
        var estimacion = $('#estimacion_'+$(this).attr('riesgoId'));
        var prob = $(this);
        var cons = $('#consecuencia_'+$(this).attr('riesgoId'));
        obtEstimacion(prob.val(),cons.val(),estimacion,$(this).attr('riesgoId'));
    });
    $(document).on('change','.consecuencia',function(){
        var estimacion = $('#estimacion_'+$(this).attr('riesgoId'));
        var cons = $(this);
        var prob = $('#probabilidad_'+$(this).attr('riesgoId'));
        obtEstimacion(prob.val(),cons.val(),estimacion,$(this).attr('riesgoId'));
    });
    $(document).on('click','#btnGuardarRiesgos',function () {
        var numSeleccionados = $(".riesgos input:checked").length;
        if(numSeleccionados === 0){
            alert('Debe seleccionar por lo menos un Riesgo');
        }else{
            $('#formIdentRiesgos').submit();
        }
    });
    $(document).on('click','#btnEditarRiesgo',function () {
        var riesgoId = $(this).attr('riesgoId');
        var url = '{{URL::to('/riesgo/riesgoeditar')}}/'+riesgoId;
        $.get(url,function (json) {
            $('#modalEditarRiesgo').val(json.riesgo);
            $('#modalEditarDescripcion').val(json.descripcion);
            $('#modalEditarId').val(json.id);
        },'json');
    });
    $(document).on('click','.inpSeleccionar',function () {        
        var seleccionado = $(this);
        var id = seleccionado.val();
        var selecProb = $('#selProbabilidad_'+id);
        var selecConse = $('#selConsecuencias_'+id);
        var labEstima = $('#labEstimacion_'+id);
        if(seleccionado.prop('checked')){
            selecProb.empty();
                selecProb.append('<select required="required" id="probabilidad_'+id+'" riesgoId="'+id+'" class="probabilidad" name="probabilidad[]"><option value="0">--Seleccionar--</option><option value="1">B-Baja</option><option value="2">M-Media</option><option value="3">A-Alta</option></select>');
            selecConse.empty();
                selecConse.append('<select required="required" id="consecuencia_'+id+'" riesgoId="'+id+'" class="consecuencia" name="consecuencia[]"><option value="0">--Seleccionar--</option><option value="1">LD-Ligeramente Dañino</option><option value="2">D-Dañino</option><option value="3">ED-Extremadamente Dañino</option></select>');
            labEstima.empty();
                labEstima.append('<label id="estimacion_'+id+'" class="label label-default" style="font-size: 10pt"></label>'+
                    '<input id="inpEstimacion_'+id+'" type="hidden" name="estimacion[]">');
        }else{
            selecProb.empty();
            selecProb.append('No Seleccionado');
            selecConse.empty();
            selecConse.append('No Seleccionado');
            labEstima.empty();
        }
    });
    function obtEstimacion(probabilidad, consecuencia, estimacion,id){
        if(probabilidad > 0 && consecuencia > 0){
            var suma = parseInt(probabilidad) + parseInt(consecuencia);
            var inpEstima = $('#inpEstimacion_'+id);
            estimacion.removeClass();
            estimacion.empty();
            switch (suma) {
                case 2:
                    estimacion.addClass('label label-default');
                    estimacion.html('Trivial');
                    inpEstima.val(1);
                    break;
                case 3:
                    estimacion.addClass('label label-info');
                    estimacion.html('Tolerable');
                    inpEstima.val(2);
                    break;
                case 4:
                    estimacion.addClass('label label-success');
                    estimacion.html('Moderado');
                    inpEstima.val(3);
                    break;
                case 5:
                    estimacion.addClass('label label-warning');
                    estimacion.html('Importante');
                    inpEstima.val(4);
                    break;
                case 6:
                    estimacion.addClass('label label-danger');
                    estimacion.html('Intolerable');
                    inpEstima.val(5);
            }
        }else{
            estimacion.removeClass();
            estimacion.empty();
        }
    }
</script>