<div class="px-6 pb-10 w-full md:w-1/2 lg:w-1/3 h-128 md:h-96 lg:h-72">
    <div class="w-full h-full relative border border-fotogray overflow-y-hidden">
        <a  style="width:350px; height:195px; overflow-y:hidden" href="{{ $highlightedbox->url }}">
            <img class="w-full h-full object-cover" src="{{ $highlightedbox->image_url }}">
            <div class="absolute bottom-0 bg-opacity-75 bg-gray-800 w-full h-24 flex flex-col items-center justify-center">
                <h1 class="uppercase w-full text-center font-semibold text-white text-xl">{{ $highlightedbox->title }}</h1>
                @if($highlightedbox->subtitle != null)
                    <h2 class="italic w-full text-center text-white px-1">{{ $highlightedbox->subtitle }}</h2>
                @endif
            </div>
        </a>
    </div>
</div>
