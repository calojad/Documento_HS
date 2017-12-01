<script type="text/javascript">
	$(function () {
        $('.table').DataTable({
            "pagingType": "full_numbers",
            "paging": true,
            "aaSorting": [[ 1, 'Desc' ]],
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "autoWidth": false
        });
    });
</script>