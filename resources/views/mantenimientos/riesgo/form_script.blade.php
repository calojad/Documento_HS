<script type="text/javascript">
    var contador = {{count($articulos)}};
    $('#inpContador').val(contador)
    $(document).on('click','#btnAddArticulo',function () {
        var divArticulos = $('#divArticulos');
        contador++;
        if(contador > 1){
            $('#btnQuitarArticulo').remove();
        }
        divArticulos.append('' +
            '<div id="div_arti_'+contador+'" class="form-group">' +
                '<label class="col-md-2 control-label">* Articulo '+contador+' :</label>' +
                '<div class="col-md-7">' +
                    '<textarea name="articulo_'+contador+'" class="form-control txtarea" required rows="6"></textarea>' +
                '</div>' +
                '<div id="divQuitarArticulo_'+contador+'">' +
                    '<a id="btnQuitarArticulo" class="btn btn-danger" contador="'+contador+'">X</a>' +
                '</div>' +
            '</div>'
        );
        $('#inpContador').val(contador)
    });
    $(document).on('click','#btnQuitarArticulo',function () {
        var div = $(this).attr('contador');
        var divaux = div-1;
        var divArticulo = $('#div_arti_'+div);
        var divQuitarArticulo = $('#divQuitarArticulo_'+divaux);
        divArticulo.remove();
        divQuitarArticulo.append('<a id="btnQuitarArticulo" class="btn btn-danger" contador="'+divaux+'">X</a>');
        contador--;
        $('#inpContador').val(contador)
    });
    $('textarea').on('keydown', function (e) {
        var keyCode = e.keyCode || e.which;

        if (keyCode === 9) {
            e.preventDefault();
        var start = this.selectionStart;
        var end = this.selectionEnd;

        // set textarea value to: text before caret + tab + text after caret
        $(this).val($(this).val().substring(0, start)
                    + "     "
                    + $(this).val().substring(end));

        // put caret at right position again
        this.selectionStart =
        this.selectionEnd = start + 5;
    }
});
</script>