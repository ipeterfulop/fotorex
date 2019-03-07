<script>
    $('.datepicker').datepicker({
        format: "yyyy.mm.dd",
        language: "hu-HU"
    });
    $('.monthpicker').datepicker({
        format: "yyyy. MM",
        language: "hu-HU",
        startView: "months",
        minViewMode: "months",
        autoclose: true
    });
    $('.select2').select2();

    @stack('formelement-initialization')

</script>