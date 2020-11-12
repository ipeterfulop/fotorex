@extends('layouts.tailwind.app')
@section('content')
    <div class="w-full bg-transparent flex justify-center my-8">
        <div class="w-full max-width-container-bordered bg-white p-4 flex flex-wrap flex-row items-center justify-between">
            @foreach($category->subcategories as $s)
                @include('public.partials.highlightedbox', [
                    'highlightedbox' => (object)[
                        'url' => route('list_articles', ['categorySlug' => $category->custom_slug_base, 'subcategorySlug' => $s->custom_slug_base]),
                        'image_url' => $s->image_url,
                        'title' => $s->name,
                        'subtitle' => null,
                    ]
                ])
            @endforeach
        </div>
    </div>
@endsection

