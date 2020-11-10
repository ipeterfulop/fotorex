<div class="filter-header">
{{ $label }}
</div>
<div class="fotorex-filter"
     data-field="{{ $field }}"
     data-filtertype="text"
>
    <input class="fotorex-filter-{{ $type }} w-full"
           type="text"
           value="{{ $value }}">
    <button @click="loadContent(true)" class="filter-button">Keresés</button>
</div>
