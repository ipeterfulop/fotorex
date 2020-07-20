<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>
    <script src="{{ asset('js/fa/all.min.js') }}"></script>
    <script src="{{ asset('js/fa/brands.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.4.1/dist/alpine.js" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="{{ asset('css/fotorex.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fa/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fa/brands.min.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <style>

    </style>
    <script>
        const sliderValues = {
            'defaultMargin': 0,
            'marginMovement': 100,
        }

        function sliderSlideLeft(sliderId) {
            let slider = document.getElementById(sliderId);
            let newIndex = parseInt(slider.getAttribute('data-slide-index')) + 1;
            if (slider.querySelectorAll('.slider-slide').length <= newIndex) {
                newIndex = 0;
            }
            slider.setAttribute(
                'data-slide-index',
                newIndex
            );
            slideTo(sliderId, slider.getAttribute('data-slide-index'));
            sliderSetLinkActive(sliderId);
        }

        function sliderSetLinkActive(sliderId) {
            let slider = document.getElementById(sliderId);
            document.querySelectorAll('#'+sliderId+' .slider-link').forEach((link) => {
                if (link.getAttribute('data-index') == slider.getAttribute('data-slide-index')) {
                    link.classList.add('slider-link-active');
                } else {
                    link.classList.remove('slider-link-active');
                }
            })
        }

        function slideTo(sliderId, slideIndex) {
            if (slideIndex == 0) {
                return sliderReset(sliderId);
            }
            let element = document.querySelector('#'+sliderId+' .slider-slide');
            let slider = document.getElementById(sliderId);
            let movement = slider.getAttribute('data-slide-movement');
            if (movement != 'element-size') {
                element.style.marginLeft = (sliderValues.defaultMargin - (sliderValues.marginMovement * slideIndex))+'vw';
            } else {
                element.style.marginLeft = (sliderValues.defaultMargin - (element.getBoundingClientRect().width * slideIndex))+'px';
            }
            slider.setAttribute('data-slide-index', slideIndex);
            sliderSetLinkActive(sliderId);
        }

        function sliderReset(sliderId) {
            let element = document.querySelector('#'+sliderId+' .slider-slide');
            element.style.marginLeft = sliderValues.defaultMargin+'vw';
            let slider = document.getElementById(sliderId);
            slider.setAttribute('data-slide-index', 0);
            sliderSetLinkActive(sliderId);
        }

        function autoSlide(sliderId) {
            let element = document.querySelector('#'+sliderId+' .slider-slide');
            if (!document.getElementById(sliderId).classList.contains('slider-hover')) {
                sliderSlideLeft(sliderId);
                let m = element.style.marginLeft == '' ? 0 : parseInt(element.style.marginLeft);
                let slider = document.getElementById(sliderId);
                let movement = slider.getAttribute('data-slide-movement');
                if (movement != 'element-size') {
                    if (m <= (sliderValues.defaultMargin - (parseInt(document.querySelector('#'+sliderId).getAttribute('data-slide-count')) * sliderValues.marginMovement))) {
                        sliderReset(sliderId);
                    }
                } else {
                    let lastElement = slider.querySelector('.slider-slide:last-child');
                    if (lastElement.getBoundingClientRect().width + lastElement.getBoundingClientRect().x < window.innerWidth) {
                        sliderReset(sliderId);
                    }
                }

            }
        }

        function handleSliderLinkClick(event) {
            slideTo(event.target.getAttribute('data-slider-id'), event.target.getAttribute('data-index'));
        }

        function initSlider(sliderId) {
            let slider = document.getElementById(sliderId);
            slider.setAttribute('data-slide-count', document.querySelectorAll('#'+sliderId+' .slider-slide').length);
            slider.setAttribute('data-slide-index', 0);
            sliderReset(sliderId);
            let index = 0;
            if (slider.querySelector('.slider-links') != null) {
                document.querySelectorAll('#' + sliderId + ' .slider-slide').forEach((item) => {
                    let n = document.createElement('a');
                    n.classList.add('slider-link');
                    if (index == 0) {
                        n.classList.add('slider-link-active');
                    }
                    n.setAttribute('data-index', index);
                    n.setAttribute('data-slider-id', sliderId);
                    n.addEventListener('click', (event) => {
                        handleSliderLinkClick(event)
                    });
                    slider.querySelector('.slider-links').appendChild(n);
                    index++;
                });
            }
            slider.addEventListener('mouseover', (element) => {
                slider.classList.add('slider-hover');
            });
            slider.addEventListener('mouseout', (element) => {
                slider.classList.remove('slider-hover');
            });


            window.setInterval(autoSlide, slider.getAttribute('data-slider-delay'), sliderId);
        }
        function initAllSliders() {
            document.querySelectorAll('.slider').forEach((slider) => {
                initSlider(slider.id);
            });
        }

    </script>
</head>
<body class="w-full font-body" style="background-color: #f4f4f4">
<main>
    @include('layouts.tailwind.nav')
    @yield('content')
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
<script>
    initAllSliders();
</script>
</body>
</html>
