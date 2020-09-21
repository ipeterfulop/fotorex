<div class="flex flex-col w-full items-stretch justify-start mb-4  p-2 bg-fotoverylightred border border-red-200">
    <h4 class="font-bold text-sm pb-1 mb-1 border-b border-gray-400">{{ $title }}</h4>
    @forelse($similarPrinters as $similarPrinter)
        <div class="w-full flex flex-row items-stretch justify-between">
            <div class="w-1/4"><img src="{{ $similarPrinter->similarprinter->mainPhotoThumbnailUrl() }}" class="w-full"></div>
            <div class="w-2/4"><a href="{{ route('printer_details', ['slug' => $similarPrinter->similarprinter->slug]) }}">{{ $similarPrinter->similarprinter->name }}</a></div>
            <div class="w-1/4 text-fotored">{{ $similarPrinter->similarprinter->price }}</div>
        </div>
    @empty
        <div class="mt-8">Nincs megjeleníthető termék</div>
    @endforelse
</div>
