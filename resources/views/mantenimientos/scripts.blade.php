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
    $(document).on('click','#btnEliminarUser',function () {
        var userId = $(this).attr('userId');
        $.confirm({
            icon: 'fa fa-warning',
            title: 'Eliminar',
            content: '¿Esta seguro que desea eliminar este registro? <br>'
            +'<hr style="margin: 7px 0"><p style="font-size: 10pt">Los <strong>documentos</strong> creados por este usuario se <strong style="color: red;">perderan</strong></p>',
            type: 'red',
            typeAnimated: true,
            escapeKey: 'close',
            buttons: {
                Aceptar: {
                    text: 'Eliminar',
                    btnClass: 'btn-red',
                    action: function(){
                        var url = '{{URL::to('/mantenimineto/eliminarusuario')}}/'+userId;
                        $.get(url,function (json) {
                            window.location.href = json;
                        },'json');
                    }
                },
                close: function () {}
            }
        });
    });
    $(document).on('click','#btnEliminarPlantilla',function () {
        var plantillaId = $(this).attr('plantillaId');
        $.confirm({
            icon: 'fa fa-warning',
            title: 'Eliminar',
            content: '¿Esta seguro que desea eliminar este registro? <br>'
            +'<hr style="margin: 7px 0"><p style="font-size: 10pt">Es posible que algunos documentos no se puedan generar.</p>',
            type: 'red',
            typeAnimated: true,
            escapeKey: 'close',
            buttons: {
                Aceptar: {
                    text: 'Eliminar',
                    btnClass: 'btn-red',
                    action: function(){
                        var url = '{{URL::to('/mantenimiento/eliminarplantilla')}}/'+plantillaId;
                        $.get(url,function (json) {
                            window.location.href = json;
                        },'json');
                    }
                },
                close: function () {}
            }
        });
    });
</script>