<div class="fotorex-list-item-list-view py-4">
    <div class="w-full flex flex-col lg:flex-row pb-16 lg:pb-2">
        <div class="w-full lg:w-1/3 overflow-y-hidden  border border-fotogray" style="max-height: 15rem">
            @if($element->index_image != null)
                <img src="{{ \App\Article::IMAGES_PATH.'/'.$element->index_image }}" class="w-full">
            @endif
        </div>
        <div class="w-full lg:w-2/3 p-0 lg:pl-4 flex flex-col items-start justify-start">
            <h1 class="uppercase text-fotored font-bold mt-4 lg:mt-0">{{ $element->title }}</h1>
            <h2 class="text-sm text-gray-600 my-2 pl-2">{{ $element->published_at->format('Y-m-d') }}</h2>
            <div class="pb-4 lg:p-0 overflow-y-hidden" style="height: 8rem; max-height: 8rem">{!! $element->summary  !!} </div>
            <a class="w-full lg:w-auto bg-fotored hover-gray-link py-2 px-4 mt-auto text-white text-sm" href="{{ $element->url }}">Bővebben...</a>
        </div>
    </div>
</div>
<div class="fotorex-list-item-grid-view p-2">
        <div class="w-full h-128 md:h-96 lg:h-72 relative border border-fotogray overflow-y-hidden">
            <a  style="width:350px; height:195px; overflow-y:hidden" href="{{ $element->url }}">
                <img class="w-full" src="{{ \App\Article::IMAGES_PATH.'/'.$element->index_image }}">
                <div class="absolute bottom-0 bg-opacity-75 bg-gray-800 w-full h-24 flex flex-col items-center justify-center">
                    <h1 class="uppercase w-full text-center font-semibold text-white text-xl">{{ $element->title }}</h1>
                </div>
            </a>
        </div>

</div>
