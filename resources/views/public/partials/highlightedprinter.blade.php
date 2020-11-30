<div class="pr-10 h-100 my-4">
    <a href="{{ $item->printer->getDetailsUrl() }}" class="hover:shadow-lg  w-full h-full  flex flex-col items-stretch justify-start p-2 relative  border border-fotolightgray  hover:shadow-md">
        <img src="{{ $item->printer->getMainImageUrl(request()->get('printerphotoroles')->get('index')) }}" class="object-cover" style="height: 50%">
        <div class="flex flex-col items-stretch justify-start mt-3">
            <h4 class="text-fotored uppercase text-xl" >
                {{ $item->printer->displayname }}
            </h4>
            <div class="text-sm overflow-y-hidden relative" style="max-height: 3rem;">
                {{ $item->printer->highlighted_features ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris in tempus enim. Etiam quis massa sit amet leo semper tristique nec a dui. Sed non blandit odio.' }}
            </div>
        </div>
        <div class="mt-auto w-full">
            <div class="w-full text-left px-0 pt-1 flex flex-col items-start justify-center text-base">
                {!! $item->printer->price_label !!}
            </div>

        </div>
    </a>

</div>
