<div x-data="{menuOpen:false}">
    <div class="w-full flex flex-col justify-start items-start  fixed lg:relative z-10 lg:z-0">
        <div class="w-full flex justify-center bg-fotored">
            <div class="w-full max-width-container h-10 bg-fotored text-white flex items-center justify-between text-white">
                <div class="block lg:hidden">Fotorex</div>
                <div class="hidden lg:flex items-center justify-start flex-row">
                    <span class="mr-2 h-8 w-8 flex flex-grow-0">{!! config('heroicons.solid.phone') !!}</span>
                    +36 (1) 470-4020
                    <span class="ml-2 mr-2 h-8 w-8 flex flex-grow-0">{!! config('heroicons.solid.location-marker') !!}</span>
                    1148 Budapest, Lengyel u. 16.
                </div>
                <div class="hidden lg:flex items-center justify-end flex-row">
                    <a href="{{ route('contactmessage_index') }}">Kapcsolat</a>
                    <span class="ml-2 h-8 w-8 flex flex-grow-0">{!! config('heroicons.solid.arrow-circle-right') !!}</span>
                </div>
                <button @click="menuOpen = !menuOpen"
                        class="focus:outline-none active:outline-none h-8 w-8  lg:hidden ">
                <span class="block transition origin-center transition-transform ease-in-out duration-200"

                      x-bind:class="{'transform rotate-90': menuOpen}"
                >{!! config('heroicons.solid.menu') !!}</span>
                </button>
            </div>
        </div>
        <!--mobile menu-->
        <div x-show="menuOpen"
             @click.away="menuOpen = false"
             class="flex flex-col w-full items-start justify-start bg-fotoblue text-white uppercase p-2 shadow-lg">
            <div class="flex flex-row w-full items-between justify-center my-1">
                <a href="https://www.facebook.com/FotorexIrodatechnika" target="_blank"><img class="h-8"
                                                                                             src="/images/assets/fblogo.png"></a>
                <div class="ml-auto flex items-end text-right">
                    +36 (1) 470-4020<br>
                    1148 Budapest, Lengyel u. 16.
                </div>
            </div>
            <div class="h-2 bg-white w-full my-2"></div>
            <div class=" w-full justify-start items-center">
                <form method="get" action="{{ route('search_all') }}" class="flex flex-row">
                    <input type="text" class="flex-grow-1 w-4/5 text-black" placeholder="Keresés mindenben"
                           name="search">
                    <button type="submit"
                            class="hover-red-link px-2 h-12 w-12 text-white">{!! config('heroicons.outline.search')  !!}</button>
                </form>

            </div>
            <div class="h-2 bg-white w-full my-2"></div>
            @foreach($publicmenuitems as $label => $link)
                <a class="py-1 w-full hover-red-link" href="{{ $link }}">{{ $label }}</a>
            @endforeach
        </div>
    </div>
    <!--desktop menu-->
    <div class="w-full justify-center hidden lg:flex h-36">
        <div class="w-full max-width-container py-4 flex items-center justify-between">
            <div class="w-2/5 h-24">
                <a class="w-full h-full" href="/">
                    <img src="/images/assets/fotorex-logo.jpg" alt="logo" class="h-full">
                </a>
            </div>
            <div class="w-3/5 flex flex-row h-full items-center h-16 justify-end">
                <form method="get" action="{{ route('search_all') }}"
                      class="flex flex-row justify-end items-center w-full">
                    <input type="text"
                           class="flex-grow-1 w-3/5 h-16 bg-white border border-fotogray font-bold text-xl italic"
                           placeholder="Keresés mindenben..." name="search">
                    <button type="submit"
                            class="hover-red-link px-2 h-16 w-16 bg-fotogray border border-fotogray text-white">{!! config('heroicons.solid.search')  !!}</button>
                </form>
            </div>
        </div>
    </div>
    <div class="hidden lg:flex w-full justify-center bg-fotoblue text-xs h-12">
        <div class="w-full max-width-container flex items-center justify-start bg-fotoblue text-white uppercase text-xl">
            <a href="/" class="flex items-center flex-row justify-center px-4 h-full hover-red-link  desktop-nav-menuitem">
                {!! config('heroicons.solid.home') !!}
            </a>
            @foreach($publicmenuitems as $label => $link)
                <a class="flex items-center flex-row justify-center px-4 h-full hover-red-link  desktop-nav-menuitem" href="{{ $link }}">{{ $label }}</a>
            @endforeach
            <a class="ml-auto" href="https://www.facebook.com/FotorexIrodatechnika" target="_blank"><img class="h-8"
                                                                                         src="/images/assets/fblogo.png"></a>
        </span>
        </div>
    </div>
</div>
