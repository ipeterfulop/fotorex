<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($pageTitle) ? $pageTitle.' - '  : ''}}{{ config('app.name') }}</title>
    <meta name="description" content="{{ $pageDescription ?? 'Fotorex' }}">
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
<body class="w-full font-body" style="background-color: #f4f4f4; font-size: 14px">
<main>
    @include('layouts.tailwind.nav')
    <div class="pt-16 lg:pt-2">
        <div class="w-full bg-transparent flex justify-center  mb-6">
            <div class="w-full max-width-container flex flex-col lg:flex-row items-start justify-between mt-4 bg-transparent h-auto lg:h-80">
                <div class="w-full lg:w-3/4 bg-transparent px-2 z-0 h-32 md:h-64 lg:h-full">
                    @include('public.partials.slider', [
                        'slider' => \App\Slider::getForFrontpage(),
                        'view' => 'public.partials.slide'
                    ])

                </div>
                <div class="w-full lg:w-1/4 h-full flex flex-row flex-wrap lg:flex-no-wrap lg:flex-col items-center justify-between text-base lg:text-2xl uppercase pl-2 lg:pl-6 pr-2 lg:pr-0 font-semibold mt-4 lg:mt-0">
                    <div class="p-1 lg:p-0 w-1/2 lg:w-full h-18"><a class="w-full h-full bg-fotomediumgray hover-red-link  flex items-center justify-center lg:justify-start pl-0 lg:pl-4 mr-2 lg:mr-0 lg:flex-grow mb-2" href="/szolgaltatasok">
                        <span class="hidden md:block mr-2 h-16 text-white main-menu-svg-container text-fotored" style="width: 3.5rem">{!! config('heroicons.solid.cog') !!}</span>
                        Szolgáltatások
                    </a></div>
                    <div class="p-1 lg:p-0 w-1/2 lg:w-full  h-18"><a class="w-full h-full bg-fotomediumgray hover-red-link  flex items-center justify-center lg:justify-start pl-0 lg:pl-4 lg:flex-grow mt-0 lg:mt-2 mb-2" href="/megoldasok">
                        <span class="hidden md:block mr-2 h-16 text-white main-menu-svg-container text-fotored" style="width: 3.5rem">{!! config('heroicons.solid.cube') !!}</span>
                        Megoldások
                    </a></div>
                    <div class="p-1 lg:p-0 w-1/2 lg:w-full  h-18"><a class="w-full h-full bg-fotomediumgray hover-red-link  flex items-center justify-center lg:justify-start pl-0 lg:pl-4 mr-2 lg:mr-0 lg:flex-grow mt-0 lg:mt-2 mb-2" href="/hirek">
                        <span class="hidden md:block mr-2 h-16 text-white main-menu-svg-container text-fotored" style="width: 3.5rem">{!! config('heroicons.solid.document-text') !!}</span>
                        Hírek
                    </a></div>
                    <div class="p-1 lg:p-0 w-1/2 lg:w-full  h-18"><a class="w-full h-full bg-fotomediumgray hover-red-link  flex items-center justify-center lg:justify-start pl-0 lg:pl-4 lg:flex-grow mt-0 lg:mt-2" href="#">
                        <span class="hidden md:block mr-2 h-16 text-white main-menu-svg-container text-fotored" style="width: 3.5rem">{!! config('heroicons.solid.menu-alt-2') !!}</span>
                        Cégünkről
                    </a></div>
                </div>
            </div>
        </div>

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
