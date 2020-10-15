<div class="fotorex-list-item-list-view">
    <div class="w-full flex flex-row m-2 items-start" style="height: 20rem">
        <div class="w-1/3 ">
            <a href="{{ route('printer_details', ['slug' => $element->slug]) }}" class="w-full h-full">
            <img src="{{ $element->getMainImageUrl(request()->get('printerphotoroles')->get('index')) }}"
                 class="object-contain" style="object-position:left top">
            </a>
        </div>
        <div class="w-2/3 pl-2 flex flex-col items-start justify-start">
            <h1 class="text-2xl font-bold mb-4"><a href="{{ route('printer_details', ['slug' => $element->slug]) }}">{{ $element->name }}</a></h1>
            @include('public.partials.printers.detail-boxes', ['printer' => $element])
            <div class="mt-4 flex flex-col md:flex-row text-sm">

                <div class="w-full md:w-1/2">
                    <p><strong>Munkakörnyezet</strong>:{{ $element->usergroupsize->name }}</p>
                    <p><strong>Funkciók</strong>:</p>
                    <p><strong>Színkezelés</strong>:</p>
                    <p><strong>Helyi/Hálózatos</strong>:</p>
                </div>
                <div class="w-full md:w-1/2">
                    <p><strong>Sebesség fekete-fehér max.(A4)</strong>:</p>
                    <p><strong>Hardveres felbontás</strong>:</p>
                    <p><strong>Nyomtatási méret, max</strong>:</p>
                    <p><strong>Ajánlott terhelhetőség / hó (max.)</strong>:</p>

                </div>
            </div>
            <div class="w-full flex items-center justify-end mt-2 pr-2">
                <div class="w-1/2 bg-fotogray bg-opacity-50 text-fotored text-xl font-bold text-right p-4 flex flex-col items-end justify-center ">
                    {{ $element->price_label }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="fotorex-list-item-grid-view p-2">
    <div class="w-full relative z-0 h-48">
        <a href="{{ route('printer_details', ['slug' => $element->slug]) }}" class="w-full h-full  flex flex-col items-stretch justify-start">
            <img src="{{ $element->getMainImageUrl(request()->get('printerphotoroles')->get('index')) }}" class="object-contain">
            <h4 class="text-fotored uppercase" >
                {{ $element->name }}
            </h4>
            <div class="text-sm">{{ $element->description }}</div>
            <div class="text-base font-bold">{{ $element->price_label }}</div>
        </a>
    </div>
</div>
