@extends('layouts.tailwind.app')
@section('content')
    <div class="w-full bg-transparent flex justify-center">
        <div class="w-full max-width-container flex flex-col lg:flex-row items-start justify-between mt-4 bg-transparent">
            <div class="w-full lg:w-3/4 bg-transparent px-2 z-0 h-full">
                @include('public.partials.slider', [
                    'slider' => \App\Slider::getForFrontpage(),
                    'view' => 'public.partials.slide'
                ])

            </div>
            <div class="w-full lg:w-1/4 h-full flex flex-row lg:flex-col items-center justify-between py-12">
                <a class="bg-fotogray hover-red-link w-full flex items-center justify-center font-bold py-3 flex-grow m-1" href="/szolgaltatasok">Szolgáltatások</a>
                <div class="bg-fotogray hover-red-link w-full flex items-center justify-center font-bold py-3 flex-grow m-1">Megoldások</div>
                <a class="bg-fotogray hover-red-link w-full flex items-center justify-center font-bold py-3 flex-grow m-1" href="/hirek">Hírek</a>
                <div class="bg-fotogray hover-red-link w-full flex items-center justify-center font-bold py-3 flex-grow m-1">Cégünkről</div>
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
