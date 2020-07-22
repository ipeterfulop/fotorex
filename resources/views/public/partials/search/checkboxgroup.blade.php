<div class="w-full p-1 font-bold bg-gray-400">{{ $label }}</div>
<div class="p-4 border-gray-200 border flex flex-col items-start justify-start fotorex-filter"
     data-field="{{ $field }}"
     data-filtertype="checkboxgroup"
>
    @foreach($valueset as $optionValue => $optionLabel)
        <label>
        <input class="fotorex-filter fotorex-filter-{{ $type }}"
               type="checkbox"
               value="{{ $optionValue }}">
            {{ $optionLabel }}
        </label>
    @endforeach
    <button @click="loadContent(true)" class="bg-fotogray hover-red-link p-2 my-2 text-white uppercase">Keresés</button>
</div>
