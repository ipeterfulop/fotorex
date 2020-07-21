@extends('layouts.tailwind.app')
@section('content')
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
