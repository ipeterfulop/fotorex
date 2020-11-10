<div class="filter-header">
    {{ $label }}
</div>
<div class="fotorex-filter"
     data-field="{{ $field }}"
     data-filtertype="checkboxgroup"
>
    @foreach($valueset as $optionValue => $optionLabel)
        <label>
        <input class="fotorex-filter-{{ $type }}"
               type="checkbox"
               value="{{ $optionValue }}">
            {{ $optionLabel }}
        </label>
    @endforeach
        <button @click="loadContent(true)" class="filter-button">Keresés</button>
</div>
