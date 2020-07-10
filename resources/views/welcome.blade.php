@extends('layouts.tailwind.app')
@section('content')
    <div class="w-full bg-transparent flex justify-center">
        <div class="w-full max-width-container flex items-start justify-between mt-4 bg-transparent">
            <div class="w-3/4 bg-transparent px-2 z-0">
                @include('public.partials.slider', [
                    'id' => 'offers-slider',
                    'itemWidthClass' => 'slider-slide-fullwidth',
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
            <div class="w-1/4 h-full flex flex-col items-center justify-between py-16">
                <div class="bg-fotogray hover:bg-fotored hover:text-white w-full flex items-center justify-center font-bold py-3">Szolgáltatások</div>
                <div class="bg-fotogray hover:bg-fotored hover:text-white w-full flex items-center justify-center font-bold py-3">Megoldások</div>
                <div class="bg-fotogray hover:bg-fotored hover:text-white w-full flex items-center justify-center font-bold py-3">Hírek</div>
                <div class="bg-fotogray hover:bg-fotored hover:text-white w-full flex items-center justify-center font-bold py-3">Cégünkről</div>
            </div>
        </div>
    </div>

    <div class="w-full bg-transparent flex justify-center my-8">
        <div class="w-full max-width-container border border-gray-200 bg-white p-4">
            @include('public.list-or-grid-view', [
                'view' => 'public.partials.article-summary-block',
                'elements' => \App\Article::all()
            ])
        </div>
    </div>

@endsection
