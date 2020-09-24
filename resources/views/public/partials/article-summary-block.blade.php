<div class="fotorex-list-item-list-view">
    <div class="w-full flex flex-row pb-2">
        <div class="w-1/3">
            <img src="{{ \App\Article::IMAGES_PATH.'/'.$element->index_image }}" class="w-full shadow-md">
        </div>
        <div class="w-2/3 pl-4 flex flex-col items-start justify-start pb-4">
            <h1 class="uppercase text-fotored font-bold">{{ $element->title }}</h1>
            <h2 class="text-sm text-gray-600 my-2 pl-2">{{ $element->published_at->format('Y-m-d') }}</h2>
            <p>{{ $element->summary }}</p>
            <a class="bg-fotored hover-gray-link py-2 px-4 mt-auto text-white text-sm" href="{{ route('show_article', ['categorySlug' => $categorySlug, 'slug' => $element->slug]) }}">Bővebben...</a>
        </div>
    </div>
</div>
<div class="fotorex-list-item-grid-view  p-2">
    <div class="w-full relative z-0 h-48" style="background:url('{{ \App\Article::IMAGES_PATH.'/'.$element->index_image }}'); background-size: cover; background-repeat: no-repeat">
        <div class="w-full bg-opacity-75 bg-gray-500 absolute bottom-0 left-0 h-12 z-10 text-center uppercase text-white py-2">
            <strong><a href="{{ route('show_article', ['categorySlug' => $categorySlug, 'slug' => $element->slug]) }}">{{ $element->title }}</a></strong>
        </div>
    </div>
</div>
