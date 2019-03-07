<script>
    window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!}
    function setElementContentToLoader(selector) {
        $(selector).html($('#loader').html());
    }

    function clearElementContent(selector) {
        $(selector).html('');
    }
</script>

<script src="{{ asset('js/admin.js') }}{!! $cacheBuster !!}"></script>
<script src="{{ asset('js/admin-vendor.js') }}{!! $cacheBuster !!}"></script>

<script>
    var resizefunc = [];
</script>
