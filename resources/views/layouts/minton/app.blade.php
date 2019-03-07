<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php($cacheBuster = config('app.bustCacheForFrontendAssets', false) ? '?ver='.str_random(8) : '')

    <link href="{{ asset('css/admin.css') }}{{ $cacheBuster }}" rel="stylesheet">

    <title>{{ config('app.title', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
</head>
<body class="fixed-left">
<div id="wrapper" class="">
    @include('layouts.minton.topbar')
    @include('layouts.minton.left-side-menu')
    <div class="content-page">
        <div id="app" role="main" class="content">
            <div id="content" class="container-fluid">
                @if(!isset($skipTitlePart))
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                @yield('title-content')
                            </div>
                        </div>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
    @include('layouts.minton.footer')
    @include('layouts.minton.script-includes.basescripts')
    @include('layouts.minton.script-includes.datatables')
    @include('layouts.minton.script-includes.highcharts')
    @include('layouts.minton.script-includes.initializers')

    @stack('extra-scripts') <!--    <script src="/js/plugins/ckeditor/ckeditor.js"></script> -->

    @stack('customscript-initialization')
</div>
<div id="loader-container" style="display:none">
    <div id="loader">

    </div>
</div>
</body>
</html>
