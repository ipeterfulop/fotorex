const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js([
    'resources/js/mintontheme.js',
], 'public/js/minton.js')
    .scripts([
        //"resources/vendor/minton/js/jquery.min.js",
        "resources/vendor/minton/js/popper.min.js",
        //"resources/vendor/minton/js/bootstrap.min.js",
        "resources/vendor/minton/js/detect.js",
        "resources/vendor/minton/js/fastclick.js",
        "resources/vendor/minton/js/jquery.slimscroll.js",
        "resources/vendor/minton/js/jquery.blockUI.js",
        "resources/vendor/minton/js/waves.js",
        "resources/vendor/minton/js/wow.min.js",
        "resources/vendor/minton/js/jquery.nicescroll.js",
        "resources/vendor/minton/js/jquery.scrollTo.min.js",
        "resources/vendor/minton/js/plugins/switchery/switchery.min.js",
        // "resources/vendor/minton/js/plugins/moment/moment.js",
        // "resources/vendor/minton/js/plugins/moment/src/locale/hu.js",
        "resources/vendor/minton/js/plugins/waypoints/lib/jquery.waypoints.min.js",
        "resources/vendor/minton/js/plugins/counterup/jquery.counterup.min.js",
        "resources/vendor/minton/js/plugins/jquery-circliful/js/jquery.circliful.min.js",
        "resources/vendor/minton/js/plugins/jquery-sparkline/jquery.sparkline.min.js",
        "resources/vendor/minton/js/plugins/skyicons/skycons.min.js",
        "resources/vendor/minton/js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js",
        "resources/vendor/minton/js/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.hu.min.js",
        //"resources/vendor/minton/js/plugins/bootstrap-daterangepicker/daterangepicker.js",
        "resources/vendor/minton/js/plugins/select2/js/select2.full.js",
        "resources/vendor/minton/js/pages/jquery.dashboard.js",
        "resources/vendor/minton/js/jquery.core.js",
        "resources/vendor/minton/js/jquery.app.js",
    ], 'public/js/minton-vendor.js')
    .scripts([
        'resources/vendor/minton/js/plugins/datatables/jquery.dataTables.min.js',
        'resources/vendor/minton/js/plugins/datatables/dataTables.bootstrap4.min.js',
        'resources/vendor/minton/js/plugins/datatables/dataTables.buttons.min.js',
        'resources/vendor/minton/js/plugins/datatables/buttons.bootstrap4.min.js',
        'resources/vendor/minton/js/plugins/datatables/jszip.min.js',
        'resources/vendor/minton/js/plugins/datatables/pdfmake.min.js',
        'resources/vendor/minton/js/plugins/datatables/vfs_fonts.js',
        'resources/vendor/minton/js/plugins/datatables/buttons.html5.min.js',
        'resources/vendor/minton/js/plugins/datatables/buttons.print.min.js',
        'resources/vendor/minton/js/plugins/datatables/dataTables.keyTable.min.js',
        'resources/vendor/minton/js/plugins/datatables/dataTables.responsive.min.js',
        'resources/vendor/minton/js/plugins/datatables/responsive.bootstrap4.min.js',
        'resources/vendor/minton/js/plugins/datatables/dataTables.select.min.js',
    ], 'public/js/datatables.js')
    .sass('resources/sass/mintontheme.scss', 'public/css/minton.css');