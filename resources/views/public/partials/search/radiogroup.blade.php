<div class="w-full p-1 font-bold bg-gray-400 text-sm">{{ $label }}</div>
<div class="p-4 border-gray-200 border flex flex-col items-start justify-start fotorex-filter"
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
    <button @click="loadContent(true)" class="bg-fotored hover-gray-link p-2 my-2 text-white uppercase">Keresés</button>
</div>
