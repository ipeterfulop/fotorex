<div class="px-6 py-5 w-full md:w-1/2 lg:w-1/3 h-64">
    <div class="w-full h-full relative border border-fotogray">
        <a class="w-full h-full" href="{{ $highlightedbox->url }}">
            <img class="w-full h-full" src="{{ $highlightedbox->image_url }}">
            <div class="absolute bottom-0 bg-opacity-75 bg-fotogray w-full h-14">
                <h1 class="uppercase w-full text-center font-semibold text-white text-xl">{{ $highlightedbox->title }}</h1>
                <h2 class="italic w-full text-center text-white">{{ $highlightedbox->subtitle }}</h2>
            </div>
        </a>
    </div>
</div>
