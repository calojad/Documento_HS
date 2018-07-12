<script type="text/javascript">
    $(function () {
        $('.table').DataTable({
            "pagingType": "full_numbers",
            "paging": true,
            "aaSorting": [[ 1, 'Desc' ]],
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "autoWidth": false,
        });
    });
    $(document).keyup(function(event){
        if(event.which === 116){
            window.location.href = "/home";
        }
    });
    $(document).on('click','#btnEliminarDoc',function () {
        var docId = $(this).attr('docId');
        $.confirm({
            icon: 'fa fa-warning',
            title: 'Eliminar',
            content: '¿Desea eliminar este registro?',
            type: 'red',
            typeAnimated: true,
            escapeKey: 'close',
            buttons: {
                Aceptar: {
                    text: 'Eliminar',
                    btnClass: 'btn-red',
                    action: function(){
                        var url = '{{URL::to('/documento/eliminardocumento')}}/'+docId;
                        $.get(url,function (json) {
                            window.location.href = json;
                        },'json');
                    }
                },
                close: function () {}
            }
        });
    });
    $(document).on('click','#btnConfigDoc',function () {
        var docId = $(this).attr('docId');
        var docEncabezado = $(this).attr('docEncabezado');
        $('#documentoId').val(docId);
        $('#encabezado').val(docEncabezado);
    });
</script>