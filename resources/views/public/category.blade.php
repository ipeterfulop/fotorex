@extends('layouts.tailwind.app')
@section('content')
        <div class="w-full bg-transparent flex justify-center my-8">
            <div class="w-full max-width-container border border-gray-200 bg-white">
                <h1 class="text-xl text-white bg-fotored uppercase py-2 mb-2 pl-2 w-full font-bold">{{ $categoryLabel }}</h1>
                <x-ajax-list-or-grid-view :url="$ajaxUrl"
                                          :sorting-options="\App\Printer::getSortingOptionsArray()"
                                          :filters="$productFilters"
                ></x-ajax-list-or-grid-view>
            </div>
        </div>
@endsection
