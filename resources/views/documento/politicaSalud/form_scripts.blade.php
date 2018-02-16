<script type="text/javascript">
    $(document).keyup(function(event){
        if(event.which === 116)
            window.location.href = "/documento/politicasalud";
    });
    $(document).on('click','#btnGuardarPolitica',function () {
        var form = $('#formCrearPolitica');
        var inpTitulo = $('#inpTitulo');
        var txtDescrip = $('#txtDescripcion');
        inpTitulo.val(txtDescrip.val());
        form.submit();
    });
</script>