<script type="text/javascript">
    var contenerdor_layout = $('#contenedor_inicial');
    contenerdor_layout.removeClass('container');
    $(function () {
        var riesgosEmpresa = JSON.parse($('#riesgosEmpresa').val());
        $.each(riesgosEmpresa,function (key, value) {
            $('#'+value.riesgo_id).attr('checked',true);
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
        obtEstimacion(prob,cons,estimacion);
    });
    $(document).on('change','.consecuencia',function(){
        var estimacion = $('#estimacion_'+$(this).attr('riesgoId'));
        var cons = $(this);
        var prob = $('#probabilidad_'+$(this).attr('riesgoId'));
        obtEstimacion(prob,cons,estimacion);
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
    function obtEstimacion(probabilidad, consecuencia, estimacion){
        if(probabilidad.val() > 0 && consecuencia.val() > 0){
            var suma = parseInt(probabilidad.val()) + parseInt(consecuencia.val());
            estimacion.removeClass();
            estimacion.empty();
            switch (suma) {
                case 2:
                    estimacion.addClass('label label-default');
                    estimacion.html('Trivial');
                    break;
                case 3:
                    estimacion.addClass('label label-info');
                    estimacion.html('Tolerable');
                    break;
                case 4:
                    estimacion.addClass('label label-success');
                    estimacion.html('Moderado');
                    break;
                case 5:
                    estimacion.addClass('label label-warning');
                    estimacion.html('Importante');
                    break;
                case 6:
                    estimacion.addClass('label label-danger');
                    estimacion.html('Intolerable');
            }
        }else{
            estimacion.removeClass();
            estimacion.empty();
        }
    }
</script>