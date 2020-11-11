@extends('layouts.tailwind.app')
@section('content')
    <div class="w-full bg-transparent flex justify-center my-8">
        <div class="w-full max-width-container-bordered bg-white p-4">
            <x-ajax-list-or-grid-view :url="route('list_articles_ajax', [
                'categorySlug' => $categorySlug,
            ])"
                                      :sorting-options="\App\Article::getSortingOptionsArray()"
            ></x-ajax-list-or-grid-view>
        </div>
    </div>

@endsection
