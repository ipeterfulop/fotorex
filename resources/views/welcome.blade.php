@extends('layouts.tailwind.app')
@section('content')
    <div class="max-width-container w-full flex justify-center h-64">
        <x-price-slider :min="0" :max="5000" :field="'field'"></x-price-slider>
    </div>
    <div class="w-full bg-transparent flex justify-center">
        <div class="w-full max-width-container flex flex-col lg:flex-row items-start justify-between mt-4 bg-transparent">
            <div class="w-full lg:w-3/4 bg-transparent px-2 z-0">
                @include('public.partials.slider', [
                    'id' => 'offers-slider',
                    'itemWidthClass' => 'slider-slide-fullwidth flex items-center justify-center',
                    'sliderInnerClass' => 'm-0',
                    'heightClass' => 'h-96',
                    'delay' => '5000',
                    'bgClass' => 'bg-transparent',
                    'contents' => [
                        '<img src="https://via.placeholder.com/800x300">',
                        '<img src="https://via.placeholder.com/800x300">',
                    ]
                ])

            </div>
            <div class="w-full lg:w-1/4 h-full flex flex-row lg:flex-col items-center justify-between py-12">
                <div class="bg-fotogray hover:bg-fotored hover:text-white w-full flex items-center justify-center font-bold py-3 flex-grow m-1">Szolgáltatások</div>
                <div class="bg-fotogray hover:bg-fotored hover:text-white w-full flex items-center justify-center font-bold py-3 flex-grow m-1">Megoldások</div>
                <div class="bg-fotogray hover:bg-fotored hover:text-white w-full flex items-center justify-center font-bold py-3 flex-grow m-1">Hírek</div>
                <div class="bg-fotogray hover:bg-fotored hover:text-white w-full flex items-center justify-center font-bold py-3 flex-grow m-1">Cégünkről</div>
            </div>
        </div>
    </div>

    <div class="w-full bg-transparent flex justify-center my-8">
        <div class="w-full max-width-container border border-gray-200 bg-white p-4">
            <x-ajax-list-or-grid-view :url="route('list_articles', [
                'categorySlug' => \App\Articlecategory::find(1)->custom_slug_base,
            ])"
                                      :sorting-options="\App\Article::getSortingOptionsArray()"
            ></x-ajax-list-or-grid-view>
        </div>
    </div>

@endsection
