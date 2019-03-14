<style>
    .grid-item-row .blog-post {
        display: flex;
    }
    .grid-item-row .blog-post .post-thumb {
        flex-basis: 40%;
        max-height: 15em;
    }
    .grid-item-row .blog-post .post-thumb img {
        max-height: 100%;
    }
    .isotope-layout-selector-button {
        display: flex;
        align-items: center;
        cursor: pointer;
        margin-left: 5px;
    }
    .isotope-layout-selector-button:hover {
        opacity: .7
    }
</style>

<script>
    var layoutMode = 'masonry';
    try {
        layoutMode = window.localStorage.getItem('isotope-layout-{{ $isotopeContainerId }}');
    } catch (e) {}

    var gridBaseData = {
        itemSelector: '.grid-item',
        transitionDuration: '0.7s',
        masonry: {
            columnWidth: '.grid-sizer',
            gutter: '.gutter-sizer'
        },
        layoutMode: layoutMode
    }

    var $grid = $('.isotope-grid').imagesLoaded(function() {
        $grid.isotope(gridBaseData);
        if (layoutMode == 'vertical') {
            $('.isotope-grid').removeClass('cols-3').addClass('cols-1');
            $('.isotope-grid').find('.grid-item').addClass('grid-item-row');
        }
    });
    function changeIsotopeLayout(layout, itemClass, itemClassToRemove, gridClass, gridClassToRemove) {
        gridBaseData['layoutMode'] = layout;
        $('.isotope-grid').find('.grid-item').removeClass(itemClassToRemove).addClass(itemClass);
        $('.isotope-grid').removeClass(gridClassToRemove).addClass(gridClass)
        $grid.isotope(gridBaseData);
    }

    function changeIsotopeLayoutToGrid(isotopeElementId)
    {
        try {
            window.localStorage.setItem('isotope-layout-'+isotopeElementId, 'masonry');
        } catch(e) {}
        return changeIsotopeLayout('masonry', '', 'grid-item-row', 'cols-3', 'cols-1');
    }

    function changeIsotopeLayoutToRows(isotopeElementId)
    {
        try {
            window.localStorage.setItem('isotope-layout-'+isotopeElementId, 'vertical');
        } catch(e) {}
        return changeIsotopeLayout('vertical', 'grid-item-row', '', 'cols-1', 'cols-3');
    }
</script>