<div class="w-full p-1 font-bold bg-gray-400 text-sm">{{ $label }}</div>
<div class="p-4 border-gray-200 border flex flex-col items-start justify-start fotorex-filter"
     data-field="{{ $field }}"
     data-filtertype="range"
>
    <x-price-slider :min="$min" :max="$max" :field="$field"></x-price-slider>
    <button @click="loadContent(true)" class="bg-fotored hover-gray-link p-2 my-2 text-white uppercase">Keresés</button>
</div>
