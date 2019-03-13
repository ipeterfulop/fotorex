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
    'resources/vendor/unishop/js/scripts.min.js',
], 'public/js/unishop.js')
    .scripts([
        'resources/vendor/unishop/js/vendor.min.js',
        'resources/vendor/unishop/js/card.min.js',
        'resources/vendor/unishop/js/modernizr.min.js',
    ], 'public/js/unishop-vendor.js')
    .sass('resources/vendor/unishop/scss/styles.scss', 'public/css/unishop.css')
    .sass('resources/vendor/unishop/vendor/bootstrap/bootstrap.scss', 'public/css/bootstrap.css')
    .styles([
        'resources/vendor/unishop/vendor/css/bootstrap.min.css',
        'resources/vendor/unishop/vendor/css/feather.min.css',
        'resources/vendor/unishop/vendor/css/iziToast.min.css',
        'resources/vendor/unishop/vendor/css/material-icons.min.css',
        'resources/vendor/unishop/vendor/css/pe-icon-7-stroke.min.css',
        'resources/vendor/unishop/vendor/css/photoswipe.min.css',
        'resources/vendor/unishop/vendor/css/socicon.min.css',
    ], 'public/css/vendor.css')