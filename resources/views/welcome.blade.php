@extends('layouts.tailwind.app')
@section('content')
    <div class="w-full bg-transparent flex justify-center my-8">
        <div class="w-full max-width-container border border-gray-200 bg-white p-4 flex flex-wrap flex-row items-center justify-between">
            @for($t = 0; $t < 7; $t++)
                @include('public.partials.highlightedbox', [
                    'highlightedbox' => (object)[
                        'image_url' => 'https://via.placeholder.com/350x180',
                        'title' => 'Cím '.$t,
                        'subtitle' => 'Pár szavas alcím '.$t,
                        'url' => '#',
                    ]
                ])
            @endfor
            <div class="w-full flex flex-col mx-6 mt-10">
                <div class="w-full bg-fotored h-10 pl-8 uppercase text-white text-xl flex items-center justify-start">Akciós ajánlatok</div>
                @include('public.partials.item-slider-list', ['items' => $highlightedprinters, 'view' => 'public.partials.highlightedprinter'])
            </div>
        </div>
    </div>

@endsection
