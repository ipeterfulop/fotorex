<div class="flex flex-col w-full items-stretch justify-start mb-4  p-2 bg-fotoverylightred border border-red-200">
    <h4 class="font-bold text-sm pb-1 mb-1 border-b border-gray-400">{{ $title }}</h4>
    @forelse($similarPrinters as $similarPrinter)
        <div class="w-full flex flex-row items-stretch justify-between mb-2 text-sm">
            @if($similarPrinter->similar_printer_id != null)
                <div class="w-1/4"><img src="{{ $similarPrinter->similarprinter->getMainImageThumbnailUrl() }}" class="w-full border border-fotodarkgray"></div>
                <div class="w-2/4 pl-2 pt-2"><a href="{{ $similarPrinter->similarprinter->getDetailsUrl() }}" class="text-blue-500 hover:text-blue-700 hover:underline">{{ $similarPrinter->final_label }}</a></div>
                <div class="w-1/4 text-fotored text-sm pl-1">{!! $similarPrinter->similarprinter->price_label !!} </div>
            @else
                <div class="w-1/4"></div>
                <div class="w-3/4"><a href="{{ $similarPrinter->final_url }}">{{ $similarPrinter->final_label }}</a></div>
            @endif
        </div>
    @empty
        <div class="mt-8">Nincs megjeleníthető termék</div>
    @endforelse
</div>
