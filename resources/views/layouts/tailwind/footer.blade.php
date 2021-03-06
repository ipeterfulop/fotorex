<div class="w-full bg-fotoblue pb-8 flex flex-col justify-center">
    <div class="flex flex-col items-center justify-start px-4 lg:px-0">
        <div class="w-full max-width-container pt-4 flex flex-col lg:flex-row items-center lg:items-start justify-between">
            <div class="w-full lg:w-1/4 mt-8 lg:mt-0 flex flex-col items-start text-gray-200 text-base mr-8 mb-8 lg:mb-0 pl-3 lg:pl-0">
                <div class="h-12 border-t-0 border-l-0 border-r-0 border-b-4 border-fotogray w-full pl-0 lg:pl-3 mb-4 uppercase  text-xl flex flex-row items-center justify-start">
                    Megoldások
                </div>
                @foreach(\App\Articlecategory::findBySlug('megoldasok')->subcategories as $solution)
                    <a class="w-full py-1 pl-3 bg-transparent hover-gray-link" href="{{ $solution->url }}">{{ $solution->name }}</a>
                @endforeach
            </div>
            <div class="w-full lg:w-1/4 mt-8 lg:mt-0 flex flex-col items-start text-gray-200 text-base mr-8  pl-3 lg:pl-0">
                <div class="h-12 border-t-0 border-l-0 border-r-0 border-b-4 border-fotogray w-full pl-0 lg:pl-3 mb-4 uppercase  text-xl flex flex-row items-center justify-start">
                    Márkák
                </div>
                @foreach(\App\Manufacturer::orderBy('name', 'asc')->get() as $manufacturer)
                    <a href="{{ route('search_all', ['search' => $manufacturer->name]) }}"
                       class="w-full py-1 pl-3 bg-transparent hover-gray-link">{{ $manufacturer->name }}
                    </a>
                @endforeach
            </div>
            <div class="w-full lg:w-1/4 mt-8 lg:mt-0 flex flex-col items-start text-gray-200 text-base mr-8  pl-3 lg:pl-0">
                <div class="h-12 border-t-0 border-l-0 border-r-0 border-b-4 border-fotogray w-full pl-0 lg:pl-3 mb-4 uppercase  text-xl flex flex-row items-center justify-start">
                    Akciós ajánlatok
                </div>
                @foreach(\App\Highlightedprinter::orderBy('position', 'asc')->get() as $highlightedprinter)
                    <a class="w-full py-1 pl-3 bg-transparent hover-gray-link"
                       href="{{ $highlightedprinter->printer->getDetailsUrl() }}"
                    >{{ $highlightedprinter->printer->shortdisplayname }}</a>
                @endforeach
            </div>
            <div class="w-full lg:w-1/4 mt-8 lg:mt-0  flex flex-col items-start text-white text-base mr-2">
                <div class="h-10 w-full pl-3 mb-0 uppercase  text-xl flex flex-row items-center justify-start"></div>
                @foreach($publicmenuitems as $label => $data)
                    <a class="bg-fotogray hover-red-link w-full flex items-center justify-center font-bold py-1 mt-1 h-12" target="{{ $data['target'] }}" href="{{ $data['url'] }}">{{ $label }}</a>
                @endforeach
            </div>
        </div>
        <div class="w-full max-width-container py-0 pl-3 pt-4 flex flex-row items-center justify-start">
            <a href="https://www.facebook.com/FotorexIrodatechnika" target="_blank"><img class="h-8" src="/images/assets/fblogo.png"></a>
            <span class="mx-4 text-white text-xl">|</span>
            <a class="text-white" href="{{ optional(\App\Article::findBySlug('adatvedelem-es-jog', false))->url }}">Adatvédelem</a>
        </div>
    </div>

</div>
<div class="w-full bg-fotored px-8 pb-1 pt-4 text-sm text-white h-20 flex items-start justify-center">
    <div class="w-full max-width-container flex flex-col items-start justify-start">
        <p>© 2009-2020 {{ config('company.name') }}</p>
        <p>A weboldalon található anyagok kizárólag a {{ config('company.name') }} hozzájárulásával és a forrás megjelölésével használhatóak fel.</p>
    </div>
</div>