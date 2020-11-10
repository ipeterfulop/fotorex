<div class="pr-10 h-100 w-72 hover:shadow-md my-4">
    <a href="{{ route('printer_details', ['slug' => $item->printer->slug]) }}" class="w-full h-full  flex flex-col items-stretch justify-start p-2">
        <img src="{{ $item->printer->getMainImageUrl(request()->get('printerphotoroles')->get('index')) }}" class="object-contain">
        <h4 class="text-fotored uppercase text-xl" >
            {{ $item->printer->displayname }}
        </h4>
        <div class="text-sm">{{ $item->printer->description }}</div>
        <div class="text-base font-bold fixed bottom-0 w-full mb-8">{!! $item->printer->price_label !!} </div>
    </a>

</div>
