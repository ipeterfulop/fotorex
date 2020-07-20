<div x-data="{menuOpen:false}">
    <div class="w-full flex flex-col justify-start items-start  fixed lg:relative z-10 lg:z-0">
    <div class="w-full flex justify-center bg-fotored">
        <div class="w-full max-width-container h-12 lg:h-8 bg-fotored text-white flex items-center justify-between px-8 text-white">
            <span class="block lg:hidden">Fotorex</span>
            <span>
                +36 (1) 470-4020
                1148 Budapest, Lengyel u. 16.
            </span>
            <span>
                Kapcsolat
            </span>
            <span class="block lg:hidden transition origin-center transition-transform ease-in-out duration-200"
                  @click="menuOpen = !menuOpen"
                  x-bind:class="{'transform rotate-90': menuOpen}"
            >{!! config('heroicons.solid.menu') !!}</span>
        </div>
    </div>
        <div x-show="menuOpen"
             @click.away="menuOpen = false"
             class="flex flex-col w-full items-start justify-start bg-fotoblue text-white uppercase p-2 shadow-lg">
            <div class="flex flex-row w-full items-between justify-center my-1">
                <span>F</span>
                <span>ln</span>
                <span>g</span>
                <span>m</span>
                <div class="ml-auto flex items-end">
                    <input type="text" class="flex-grow-1 w-4/5" placeholder="Keresés mindenben">
                    <button>{!! config('heroicons.outline.search')  !!}</button>
                </div>
            </div>
            <div class="py-1 w-full hover:bg-fotored transition duration-200 ease-in-out transition-colors">Nyomtatók</div>
            <span>Multifunkciós nyomtatók</span>
            <span>Faxkészülékek</span>
            <span>Nyomtatóbérlés</span>
            <span>Interaktív monitorok</span>
            <span>Irodaszerek</span>
        </div>
    </div>
    <div class="w-full justify-center hidden lg:flex">
    <div class="w-full max-width-container py-4 flex items-center justify-between">
        <div class="w-2/5">
            <img src="https://via.placeholder.com/500x160" alt="logo" class="w-full">
        </div>
        <div class="flex flex-row h-full items-center w-2/5">
                <input type="text" class="flex-grow-1 w-4/5" placeholder="Keresés mindenben">
                <button>{!! config('heroicons.outline.search')  !!}</button>
        </div>
    </div>
</div>
<div class="hidden lg:flex w-full justify-center bg-fotoblue">
    <div class="w-full max-width-container flex items-center justify-between bg-fotoblue text-white uppercase">
        <div class="py-4 px-2 h-full hover:bg-fotored transition duration-200 ease-in-out transition-colors">Nyomtatók</div>
        <span>Multifunkciós nyomtatók</span>
        <span>Faxkészülékek</span>
        <span>Nyomtatóbérlés</span>
        <span>Interaktív monitorok</span>
        <span>Irodaszerek</span>
        <span class="ml-4">
            <span>F</span>
            <span>ln</span>
            <span>g</span>
            <span>m</span>
        </span>
    </div>
</div>
</div>
