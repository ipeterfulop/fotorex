<div x-data="{menuOpen:false}">
    <div class="w-full flex flex-col justify-start items-start  fixed lg:relative z-10 lg:z-0">
    <div class="w-full flex justify-center bg-fotored">
        <div class="w-full max-width-container h-12 lg:h-8 bg-fotored text-white flex items-center justify-between px-8 text-white">
            <span class="block lg:hidden">Fotorex</span>
            <span class="hidden lg:inline">
                +36 (1) 470-4020
                1148 Budapest, Lengyel u. 16.
            </span>
            <span>
                <a href="{{ route('contactmessage_index') }}">Kapcsolat</a>
            </span>
            <button @click="menuOpen = !menuOpen" class="focus:outline-none active:outline-none h-8 w-8">
                <span class="block lg:hidden transition origin-center transition-transform ease-in-out duration-200"

                      x-bind:class="{'transform rotate-90': menuOpen}"
                >{!! config('heroicons.solid.menu') !!}</span>
            </button>
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
                <div class="ml-auto flex items-end text-right">
                    +36 (1) 470-4020<br>
                    1148 Budapest, Lengyel u. 16.
                </div>
            </div>
            <div class="h-2 bg-white w-full my-2"></div>
            <div class=" w-full justify-start items-center">
                <form method="get" action="{{ route('search_all') }}" class="flex flex-row">
                    <input type="text" class="flex-grow-1 w-4/5" placeholder="Keresés mindenben" name="search">
                    <button type="submit" class="hover-red-link px-2 h-12 w-12">{!! config('heroicons.outline.search')  !!}</button>
                </form>

            </div>
            <div class="h-2 bg-white w-full my-2"></div>
            <div class="py-1 w-full hover-red-link">Nyomtatók</div>
            <div class="py-1 w-full hover-red-link">Multifunkciós nyomtatók</div>
            <div class="py-1 w-full hover-red-link">Faxkészülékek</div>
            <div class="py-1 w-full hover-red-link">Nyomtatóbérlés</div>
            <div class="py-1 w-full hover-red-link">Interaktív monitorok</div>
            <div class="py-1 w-full hover-red-link">Irodaszerek</div>
        </div>
    </div>
    <div class="w-full justify-center hidden lg:flex">
    <div class="w-full max-width-container py-4 flex items-center justify-between">
        <div class="w-2/5">
            <img src="https://via.placeholder.com/500x160" alt="logo" class="w-full">
        </div>
        <div class="flex flex-row h-full items-center w-2/5 h-12">
            <form method="get" action="{{ route('search_all') }}" class="flex flex-row ">
                <input type="text" class="flex-grow-1 w-4/5" placeholder="Keresés mindenben" name="search">
                <button type="submit" class="hover-red-link px-2 h-12 w-12">{!! config('heroicons.outline.search')  !!}</button>
            </form>
        </div>
    </div>
</div>
<div class="hidden lg:flex w-full justify-center bg-fotoblue">
    <div class="w-full max-width-container flex items-center justify-start bg-fotoblue text-white uppercase">
        <div class="py-4 px-2 h-full hover-red-link  desktop-nav-menuitem">Nyomtatók</div>
        <div class="py-4 px-2 h-full hover-red-link  desktop-nav-menuitem">Multifunkciós nyomtatók</div>
        <div class="py-4 px-2 h-full hover-red-link  desktop-nav-menuitem">Faxkészülékek</div>
        <div class="py-4 px-2 h-full hover-red-link  desktop-nav-menuitem">Nyomtatóbérlés</div>
        <div class="py-4 px-2 h-full hover-red-link  desktop-nav-menuitem">Interaktív monitorok</div>
        <div class="py-4 px-2 h-full hover-red-link  desktop-nav-menuitem">Irodaszerek</div>
        <span class="ml-auto">
            <span>F</span>
            <span>ln</span>
            <span>g</span>
            <span>m</span>
        </span>
    </div>
</div>
</div>
