<div class="pr-10 h-100 w-72 hover:shadow-md my-4">
    <a href="{{ $item->printer->getDetailsUrl() }}" class="w-full h-full  flex flex-col items-stretch justify-start p-2">
        <img src="{{ $item->printer->getMainImageUrl(request()->get('printerphotoroles')->get('index')) }}" class="object-contain">
        <h4 class="text-fotored uppercase text-xl" >
            {{ $item->printer->displayname }}
        </h4>
        <div class="text-sm">{{ $item->printer->highlighted_features }}</div>
        <div class="text-base font-bold mt-auto w-full mb-8">{!! $item->printer->price_label !!} </div>
    </a>

</div>
