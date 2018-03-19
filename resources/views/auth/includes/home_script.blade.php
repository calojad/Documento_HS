<script type="text/javascript">
    $(function () {
        $('.table').DataTable({
            "pagingType": "full_numbers",
            "paging": true,
            "aaSorting": [[ 1, 'Desc' ]],
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "autoWidth": false
        });
    });
    $(document).ready(function() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '5%' // optional
        });
        $('.radEncabezado').on('ifClicked', function(event){
            var valor = $(this).val();
            var imagenEnca = $('#imgEncabezado');
            if(valor == 1)
                imagenEnca.attr('src','{{asset('/images/encabesados/Encabezado_1.JPG')}}');
            else if(valor == 2)
                imagenEnca.attr('src','{{asset('/images/encabesados/Encabezado_2.JPG')}}');
            else
                imagenEnca.attr('src','{{asset('/images/encabesados/Encabezado_3.JPG')}}');
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
        var imagenEnca = $('#imgEncabezado');

        $('#documentoId').val(docId);

        if(docEncabezado == 1){
            $('#radEnca_1').iCheck('check');
            imagenEnca.attr('src','{{asset('/images/encabesados/Encabezado_1.JPG')}}')
        } else if(docEncabezado == 2){
            $('#radEnca_2').iCheck('check');
            imagenEnca.attr('src','{{asset('/images/encabesados/Encabezado_2.JPG')}}')
        } else {
            $('#radEnca_3').iCheck('check');
            imagenEnca.attr('src','{{asset('/images/encabesados/Encabezado_3.JPG')}}')
        }
    });
</script>