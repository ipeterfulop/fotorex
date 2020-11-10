<div class="filter-header">
    {{ $label }}
</div>
<div class="fotorex-filter"
     data-field="{{ $field }}"
     data-filtertype="radiogroup"
>
    <label>
        <input class="fotorex-filter-{{ $type }}"
               type="radio"
               name="{{ $field }}"
               @if($value == -1) checked @endif
               value="-1">
        Nem adott
    </label>

    @foreach($valueset as $optionValue => $optionLabel)
        <label>
            <input class="fotorex-filter-{{ $type }}"
                   type="radio"
                   name="{{ $field }}"
                   @if($value == $optionValue) checked @endif
                   value="{{ $optionValue }}">
            {{ $optionLabel }}
        </label>
    @endforeach
    <button @click="loadContent(true)" class="filter-button">Keresés</button>
</div>
