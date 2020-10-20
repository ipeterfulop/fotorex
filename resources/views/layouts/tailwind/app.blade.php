<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($pageTitle) ? $pageTitle.' - '  : ''}}{{ config('app.name') }}</title>
<!--
    <script src="{{ asset('js/fa/all.min.js') }}"></script>
    <script src="{{ asset('js/fa/brands.min.js') }}"></script>
-->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.4.1/dist/alpine.js" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="{{ asset('css/fotorex.css') }}" rel="stylesheet">
<!--
    <link href="{{ asset('css/fa/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fa/brands.min.css') }}" rel="stylesheet">
-->
    <style>
    </style>
</head>
<body class="w-full font-body" style="background-color: #f4f4f4">
<main>
    @include('layouts.tailwind.nav')
    <div class="pt-16 lg:pt-2">
        @yield('content')
    </div>
    @include('layouts.tailwind.footer')
</main>
@if(session()->has('status'))
<div id="notification" x-data="{show: true}">
    <div class="fixed top-0 left-0 w-full h-full absolute bg-gray-700 bg-opacity-75 flex items-center justify-center" x-show="show">
        <div class="bg-white w-5/12 h-auto p-8 flex flex-col items-center justify-center shadow-lg rounded-lg">
            {{ session()->pull('status') }}
            <button @click="show = false"
                    class="btn bg-fotored text-white text-xl font-extrabold mt-8"
            >Bezár</button>
        </div>
    </div>
</div>
@endif
<script src="{{ asset('js/fotorex.js') }}"></script>
@include('public.partials.nospam-email-script')
</body>
</html>
