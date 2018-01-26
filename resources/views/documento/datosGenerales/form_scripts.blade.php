<script type="text/javascript">
    var aux_contador=0;
    //        RADIOBUTTONS
    $(document).ready(function(){
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    //        RADIO CENTROS DE TRABAJOS OTROS
        $('input[name=centros]').on('ifClicked', function(event){
            var valor = $(this).val();
            var inputOtros =  $('#otrosCentros');
            var divDireccSucur = $('#divDireccionSucursal');
//          ACTIVAR INPUT OTROS
            if(valor == 6)
                inputOtros.prop('disabled',false);
            else
                inputOtros.prop('disabled',true);
//          NUMERO DE SUCURSALES
            if(valor == 5)
                valor = 10;
            divDireccSucur.empty();
            for(var i=2; i<=valor; i++){
                divDireccSucur.append('' +
                    '<div class="form-group">' +
                        '<label class="col-md-4 control-label">Sucursal:</label>' +
                        '<div class="col-md-8">' +
                            '<input name="direccion_sucursal_'+i+'" class="form-control" required type="text" placeholder="Dirección">' +
                        '</div>' +
                    '</div>'
                );
            }
            if(valor >= 4){
                aux_contador = valor;
                divDireccSucur.append(
                    '<div id="divAddSucursal"> </div>' +
                    '<div class="col-md-12">' +
                        '<a class="btn btn-twitter pull-right" onclick="addSucursal()">Añadir</a>' +
                    '</div>' +
                    '<hr>');
            }
        });
    });
    function addSucursal() {
        var divDireccSucur = $('#divAddSucursal');
        aux_contador++;
        divDireccSucur.append('' +
            '<div class="form-group">' +
                '<label class="col-md-4 control-label">Sucursal:</label>' +
                '<div class="col-md-8">' +
                    '<input name="direccion_sucursal_'+aux_contador+'" class="form-control" required type="text" placeholder="Dirección">' +
                '</div>' +
            '</div>'
        );
    }
</script>