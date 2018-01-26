<script type="text/javascript">
    $(function () {
        $('.table').DataTable({
            "paging": true,
            "aaSorting": [[ 1, 'Desc' ]],
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "autoWidth": false
        });
    });
    $(document).on('click','#RiesgoSeleccionado',function () {
        var inpRiesgoId = $('input[name=riesgo_id]');
        var inpRiesgoName = $('input[name=riesgo]');
        inpRiesgoId.val($(this).attr('riesgoId'));
        inpRiesgoName.val($(this).attr('riesgo'));
    });
</script>