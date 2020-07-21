<div class="w-full p-1 font-bold bg-gray-400">{{ $label }}</div>
<div class="p-4 border-gray-200 border flex flex-col items-start justify-start">
    <input class="fotorex-filter fotorex-filter-{{ $type }}"
           type="text"
           data-field="{{ $field }}" value="{{ $value }}">
    <button @click="loadContent(true)" class="bg-fotogray hover-red-link p-2 my-2 text-white uppercase">Keresés</button>
</div>
