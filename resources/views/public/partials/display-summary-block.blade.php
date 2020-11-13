<div class="fotorex-list-item-list-view">
    <div class="w-full flex flex-row items-start" >
        <div class="w-1/3 ">
            <a href="{{ route('display_details', ['slug' => $element->slug]) }}" class="w-full h-full">
                <img src="{{ $element->getMainImageUrl(request()->get('printerphotoroles')->get('index')) }}"
                     class="object-contain" style="object-position:left top">
            </a>
        </div>
        <div class="w-2/3 pl-4 flex flex-col items-start justify-start">
            <h1 class="text-2xl font-bold mb-4"><a href="{{ route('display_details', ['slug' => $element->slug]) }}">{{ $element->display_name }}</a></h1>
            <div class="mt-4 text-sm">
                {!! $element->key_features  !!}
            </div>
            <div class="w-full flex items-center justify-end mt-4 pr-2 h-16">
                <div class="w-1/2 bg-fotolightgray bg-opacity-50 text-right p-4 flex flex-col items-end justify-center h-full text-xl">
                    {!! $element->price_label !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="fotorex-list-item-grid-view">
    <div class="pr-10 h-72 w-72 hover:shadow-md my-4">
        <a href="{{ route('display_details', ['slug' => $element->slug]) }}" class="w-full h-full  flex flex-col items-stretch justify-start p-2 relative">
            <img src="{{ $element->getMainImageUrl(request()->get('printerphotoroles')->get('index')) }}" class="object-contain">
            <div class="absolute bottom-0 w-full mb-2">
                <h4 class="text-fotored uppercase text-xl" >
                    {{ $element->displayname }}
                </h4>
                <div class="text-sm">{{ $element->key_features }}</div>
                <div class="text-base font-bold">{!! $element->price_label !!} </div>

            </div>
        </a>

    </div>
</div>
