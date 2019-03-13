<script>
    window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!}
    window.laravelLocale = '{{ app()->getLocale() }}'
    function setElementContentToLoader(selector) {
        $(selector).html($('#loader').html());
    }

    function clearElementContent(selector) {
        $(selector).html('');
    }
</script>

<script src="{{ asset('js/minton.js') }}{!! $cacheBuster !!}"></script>
<script src="{{ asset('js/minton-vendor.js') }}{!! $cacheBuster !!}"></script>

<script>
    var resizefunc = [];
</script>
