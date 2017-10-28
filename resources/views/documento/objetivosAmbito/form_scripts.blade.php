<!-- Multi-Select -->
<script src="{{ asset('plugins/jquery-multi-select/js/jquery.multi-select.js')}}"></script>
<script src="{{ asset('plugins/jquery-multi-select/js/multi-select-init.js') }}"></script>
<script type="text/javascript">
    $(document).keyup(function(event){
        if(event.which === 116)
            window.location.href = "/documento/objetivosambito";
    });
    /*$(document).on('change','#objeto',function () {
       if($(this).val().length >= 3){
           alert($(this).val());
       }
    });*/
</script>