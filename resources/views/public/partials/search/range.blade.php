<div class="filter-header">
    {{ $label }}
</div>
<div class="fotorex-filter"
     data-field="{{ $field }}"
     data-filtertype="range"
>
    <x-price-slider :min="$min" :max="$max" :field="$field"></x-price-slider>
    <button @click="loadContent(true)" class="filter-button">Keresés</button>
</div>
