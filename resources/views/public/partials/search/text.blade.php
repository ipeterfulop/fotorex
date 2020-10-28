<div class="w-full p-1 font-bold bg-fotolightgray text-sm">{{ $label }}</div>
<div class="p-4 border-gray-200 border flex flex-col items-start justify-start fotorex-filter"
     data-field="{{ $field }}"
     data-filtertype="text"
>
    <input class="fotorex-filter-{{ $type }} w-full"
           type="text"
           value="{{ $value }}">
    <button @click="loadContent(true)" class="bg-fotored hover-gray-link p-2 my-2 text-white uppercase">Keresés</button>
</div>
