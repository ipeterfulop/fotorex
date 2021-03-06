@php($compactPriceView = isset($compactPriceView) ? $compactPriceView : false)
@push('pricelabel-'.$element->id.'-'.$configuration->id)
    @if($configuration->id == \App\Helpers\Productcategory::RENTALS_ID)
        @foreach($element->printerrentaloptions as $option)
            <div><strong class="text-fotored">Bérleti díj: </strong>
                {!! \App\Helpers\RentalPeriodUnit::formatPriceWithSuffix($element->rentalprice, $option->rentaloption->rental_period_unit) !!}
            </div>
            <div><strong class="text-fotored">Havi oldalszám (ff): </strong>
                {{ \App\Helpers\PriceFormatter::formatToInteger($option->rentaloption->number_of_pages_included_bw, '') }}
            </div>
            @if($element->color_management == \App\Helpers\ColorTechnology::COLOR_ID)
                <div><strong class="text-fotored">Havi oldalszám (színes):</strong>
                    {{ \App\Helpers\PriceFormatter::formatToInteger($option->rentaloption->number_of_pages_included_color, '') }}
                </div>
            @endif
        @endforeach
    @else
        {!! $element->price_label !!}
    @endif
@endpush

@push('details-'.$element->id.'-'.$configuration->id)
    <div class="w-full md:w-1/2">
        <p><strong>Munkakörnyezet</strong>:{{ $element->usergroupsize->name }}</p>
        <p><strong>Funkciók</strong>: {{ $element->functions_label }}</p>
        <p><strong>Színkezelés</strong>: {!! $element->color_management_label !!}</p>
        <p><strong>Helyi/Hálózatos</strong>: {{ $element->networked_label }}</p>
    </div>
    <div class="w-full md:w-1/2">
        <p><strong>Sebesség fekete-fehér max.(A4)</strong>: {{ $element->printing_speed_a4_bw_label }}</p>
        <p><strong>Hardveres felbontás</strong>: {{ $element->printing_resolution }}</p>
        <p><strong>Nyomtatási méret, max</strong>: {{ $element->max_papersize_label }}</p>
        <p><strong>Ajánlott terhelhetőség / hó (max.)</strong>: {{ $element->recommended_load_per_month_label }}</p>
    </div>
    @if($compactPriceView)
        <div class="w-full flex items-center justify-start my-4 pr-2 price-label-container">
            <div class="w-full lg:w-1/2 bg-fotolightgray bg-opacity-50 text-left p-1 flex flex-col items-start justify-center h-full text-base">
                @stack('pricelabel-'.$element->id.'-'.$configuration->id)
            </div>
        </div>
    @else
        <div class="w-full flex items-center justify-end my-4 pr-2 price-label-container">
            <div class="w-full lg:w-1/2 bg-fotolightgray bg-opacity-50 text-right p-1 flex flex-col items-end justify-center h-full text-base">
                @stack('pricelabel-'.$element->id.'-'.$configuration->id)
            </div>
        </div>
    @endif

@endpush
<div class="fotorex-list-item-list-view">
    <div class="w-full flex flex-row items-start" >
        <div class="w-1/3 ">
            <a href="{{ $element->getDetailsUrl($configuration->id) }}" class="w-full h-full">
                <img src="{{ $element->getMainImageUrl(request()->get('printerphotoroles')->get('index')) }}"
                     class="object-contain" style="object-position:left top">
            </a>
        </div>
        <div class="w-2/3 pl-4 flex flex-col items-start justify-start">
            <h1 class="text-2xl font-bold mb-4"><a href="{{ $element->getDetailsUrl($configuration->id) }}">{{ $element->shortdisplayname }}<span class="ml-2 italic font-normal">{{ $element->name }}</span></a></h1>

            <div class="flex items-center justify-start flex-wrap lg:flex-nowrap flex-row mb-4">
                @if($element->printing >= \App\Helpers\DeviceFunctionality::BW_ID)
                    <div class="printer-detail-box my-1 lg:my-0" style="background-color: #e30450">PRINT</div>
                @endif
                @if($element->copying >= \App\Helpers\DeviceFunctionality::BW_ID)
                    <div class="printer-detail-box my-1 lg:my-0" style="background-color: #ff5502">COPY</div>
                @endif
                @if($element->scanning >= \App\Helpers\DeviceFunctionality::BW_ID)
                    <div class="printer-detail-box my-1 lg:my-0" style="background-color: #e62899">SCAN</div>
                @endif
                <div class="printer-detail-box my-1 lg:my-0" style="background-color: #00aad2">
                    {{ $element->max_papersize->code }}
                </div>
                @if($element->networked >= 2)
                    <div class="printer-detail-box my-1 lg:my-0" style="background-color: #4891dc">NET<br>WORK</div>
                @endif
                <div class="printer-detail-box my-1 lg:my-0" style="{{ \App\Helpers\ColorTechnology::getDetailBoxCSS($element->printing) }}">
                    {!! \App\Helpers\ColorTechnology::getDetailBoxLabel($element->color_management) !!}
                </div>

            </div>
            <div class="hidden lg:flex mt-4 flex-col md:flex-row text-sm flex-wrap">
                @stack('details-'.$element->id.'-'.$configuration->id)
            </div>
        </div>
    </div>
    <div class="flex lg:hidden w-full flex-col items-stretch pb-4 mb-4 border border-t-0 border-b border-l-0 border-r-0 border-fotogray">
        @stack('details-'.$element->id.'-'.$configuration->id)
    </div>
</div>
<div class="fotorex-list-item-grid-view">
    <div class="pr-10 h-128 my-4">
        <a href="{{ $element->getDetailsUrl($configuration->id) }}" class="hover:shadow-lg  w-full h-full  flex flex-col items-stretch justify-start p-2 relative  border border-fotolightgray">
            <img src="{{ $element->getMainImageUrl(request()->get('printerphotoroles')->get('index')) }}" class="object-cover" style="height: 35%">
            <div class="flex flex-col items-stretch justify-start mt-3">
                <h4 class="text-fotored uppercase text-xl" >
                    <span class="whitespace-no-wrap">{{ $element->shortdisplayname }}</span><span class="italic font-normal ml-2 text-sm">{{ $element->name }}</span>
                </h4>
                <div class="text-sm overflow-y-hidden relative mt-4" style="max-height: 4rem;">
                    {{ $element->key_features_label }}
                </div>
            </div>
            <div class="mt-auto w-full">
                <div class="w-full text-left px-0 pt-1 flex flex-col items-start justify-center text-base">
                    @stack('pricelabel-'.$element->id.'-'.$configuration->id)
                </div>

            </div>
        </a>

    </div>
</div>
