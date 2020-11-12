@extends('layouts.tailwind.app')
@section('content')
    @if((string)request()->get('search') != '')
        <div class="w-full bg-transparent flex justify-center">
            <div class="w-full max-width-container-bordered bg-white">
                <h1 class="text-center font-bolder text-2xl text-fotored  py-8">Keresési eredmények a(z) "{{ request()->get('search') }}" kifejezésre</h1>
            </div>
        </div>
        <div class="w-full bg-transparent flex justify-center">
            <div class="w-full max-width-container-bordered bg-white">
                <h1 class="text-xl text-white bg-fotored uppercase py-2 mb-2 pl-2 w-full font-bold">Cikkek</h1>
                <x-ajax-list-or-grid-view :url="route('list_articles_ajax', [
                    'categorySlug' => \App\Articlecategory::find(1)->custom_slug_base,
                ])"
                                          :sorting-options="\App\Article::getSortingOptionsArray()"
                                          :filters="$articleFilters"
                ></x-ajax-list-or-grid-view>
            </div>
        </div>
        <div class="w-full bg-transparent flex justify-center my-8">
            <div class="w-full max-width-container-bordered bg-white">
                <h1 class="text-xl text-white bg-fotored uppercase py-2 mb-2 pl-2 w-full font-bold">Termékek</h1>
                <x-ajax-list-or-grid-view :url="route('list_printers')"
                                          :sorting-options="\App\Printer::getSortingOptionsArray()"
                                          :filters="$productFilters"
                ></x-ajax-list-or-grid-view>
            </div>
        </div>
        <div class="w-full bg-transparent flex justify-center my-8">
            <div class="w-full max-width-container-bordered bg-white">
                <h1 class="text-xl text-white bg-fotored uppercase py-2 mb-2 pl-2 w-full font-bold">Kijelzők</h1>
                <x-ajax-list-or-grid-view :url="route('list_displays')"
                                          :sorting-options="\App\Printer::getSortingOptionsArray()"
                                          :filters="$displayFilters"
                ></x-ajax-list-or-grid-view>
            </div>
        </div>
    @else
        <div class="w-full bg-transparent flex justify-center">
            <div class="w-full max-width-container-bordered bg-white">
                <h1 class="text-center font-bolder text-2xl fotored  py-8">A kereséshez írjon be a szövegmezőbe egy kifejezést!</h1>
            </div>
        </div>
    @endif
@endsection
