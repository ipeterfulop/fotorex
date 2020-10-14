<div class="fotorex-list-item-list-view">
    <div class="w-full flex flex-row m-2 items-start" style="height: 20rem">
        <img src="{{ $element->getMainImageUrl(request()->get('printerphotoroles')->get('index')) }}"
             class="w-1/3 object-contain" style="object-position:left top">
        <div class="w-2/3 pl-2 flex flex-col items-start justify-start">
            <h1 class="text-2xl font-bold mb-4">{{ $element->name }}</h1>
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
        </div>
    </div>
</div>
<div class="fotorex-list-item-grid-view p-2">
    <div class="w-full relative z-0 h-48" style="background:url('{{ $element->getMainImageUrl(request()->get('printerphotoroles')->get('index')) }}'); background-size: cover; background-repeat: no-repeat">
        <div class="w-full bg-gray-500 absolute bottom-0 left-0 h-20 z-10 text-center uppercase text-white py-2 text-sm flex items-center justify-center"
             style="background-color: rgba(64,64,64,.9)"
        >
            <a href="{{ route('printer_details', ['slug' => $element->slug]) }}"><strong>{{ $element->name }}</strong></a>
        </div>
    </div>
</div>
