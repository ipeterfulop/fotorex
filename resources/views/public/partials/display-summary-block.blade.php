<div class="fotorex-list-item-list-view">
    <div class="w-full flex flex-row items-start" >
        <div class="w-1/3 ">
            <a href="{{ $element->getDetailsUrl() }}" class="w-full h-full">
                <img src="{{ $element->getMainImageUrl(request()->get('printerphotoroles')->get('index')) }}"
                     class="object-contain" style="object-position:left top">
            </a>
        </div>
        <div class="w-2/3 pl-4 flex-col items-start justify-start">
            <h1 class="text-2xl font-bold mb-4"><a href="{{ $element->getDetailsUrl() }}">{{ $element->display_name }}</a></h1>
            <div class="hidden lg:flex w-full flex flex-col items-stretch">
                <div class="mt-4 text-sm">
                    {!! $element->highlighted_features_label  !!}
                </div>
                <div class="w-full flex items-center justify-end mt-4 pr-2 h-16">
                    <div class="w-full lg:w-1/2 bg-fotolightgray bg-opacity-50 text-right p-4 flex flex-col items-end justify-center h-full text-xl">
                        {!! $element->price_label !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex lg:hidden w-full pl-4 flex-col items-start justify-start">
        <div class="mt-4 text-sm">
            {!! $element->highlighted_features_label  !!}
        </div>
        <div class="w-full flex items-center justify-end mt-4 pr-2 h-16 pb-8 mb-4 border border-t-0 border-b border-l-0 border-r-0 border-fotogray">
            <div class="w-full lg:w-1/2 bg-fotolightgray bg-opacity-50 text-right p-4 flex flex-col items-end justify-center h-full text-xl">
                {!! $element->price_label !!}
            </div>
        </div>
    </div>

</div>
<div class="fotorex-list-item-grid-view">
    <div class="pr-10 h-100 my-4">
        <a href="{{ $element->getDetailsUrl() }}" class="hover:shadow-md w-full h-full  flex flex-col items-stretch justify-start p-2 relative border border-fotolightgray">
            <img src="{{ $element->getMainImageUrl(request()->get('printerphotoroles')->get('index')) }}" class="object-cover" style="height: 50%">
            <div class="flex flex-col items-stretch justify-start mt-3">
                <h4 class="text-fotored uppercase text-xl" >
                    {{ $element->displayname }}
                </h4>
                <div class="text-sm overflow-y-hidden relative" style="max-height: 4rem;">
                    {!! $element->highlighted_features_label !!}
                </div>
            </div>
            <div class="mt-auto w-full">
                <div class="w-full text-left px-0 pt-1 flex flex-col items-start justify-center text-base">
                    {!! $element->price_label !!}
                </div>

            </div>
        </a>

    </div>
</div>
