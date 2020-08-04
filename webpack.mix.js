const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss')

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


//public
mix.js('resources/js/app.js', 'public/js/fotorex.js');
mix.sass('resources/sass/app.scss', 'public/css/fotorex.css', {}, [tailwindcss('tailwind.config.js')])
    .options({
        processCssUrls: false
    });

//admin
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
    .sass('resources/sass/mintontheme.scss', 'public/css/minton.css');
