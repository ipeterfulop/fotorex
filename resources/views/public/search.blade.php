@extends('layouts.tailwind.app')
@section('content')
    @if($minLengthReached)
        <div class="w-full bg-transparent flex justify-center">
            <div class="w-full max-width-container-bordered bg-white">
                <h1 class="text-center font-bolder text-2xl text-fotored  py-8">Keresési eredmények a(z) "{{ request()->get('search') }}" kifejezésre</h1>
            </div>
        </div>
        @if($printers->count() > 0)
            <div class="w-full bg-transparent flex justify-center my-8">
                <div class="w-full max-width-container-bordered bg-white fotorex-list-container" style="min-height:0px" x-data="{showDetails: false}">
                    <h1 class="text-xl cursor-pointer text-white bg-fotored uppercase py-2 pl-4 w-full font-bold flex justify-between items-center"
                        @click="showDetails = !showDetails"
                    >
                        Nyomtatók és multifunkciós nyomtatók ({{ $printers->count() }})
                        <span x-bind:class="{'rotate-90' : !showDetails}"
                              class="outline-none focus:outline-none transform transition-transform ease-in-out duration-150 mr-4 text-3xl cursor-pointer"

                        >&#9660;</span>
                    </h1>
                    <div x-show="showDetails" class="mt-4">
                        @forelse($printers as $printer)
                            @include('public.partials.printer-summary-block', ['element' => $printer, 'configuration' => $printerConfiguration])
                        @empty
                            <h3 class="w-full my-8 text-xl text-center">Nincs találat</h3>
                        @endforelse
                    </div>
                </div>
            </div>
        @endif
        @if($rentals->count() > 0)
            <div class="w-full bg-transparent flex justify-center my-8">
                <div class="w-full max-width-container-bordered bg-white fotorex-list-container" style="min-height:0px" x-data="{showDetails: false}">
                    <h1 class="text-xl cursor-pointer text-white bg-fotored uppercase py-2 pl-4 w-full font-bold flex justify-between items-center"
                        @click="showDetails = !showDetails"
                    >
                        Bérelhető nyomtatók ({{ $rentals->count() }})
                        <span x-bind:class="{'rotate-90' : !showDetails}"
                              class="outline-none focus:outline-none transform transition-transform ease-in-out duration-150 mr-4 text-3xl cursor-pointer"

                        >&#9660;</span>
                    </h1>
                    <div x-show="showDetails" class="mt-4">
                        @forelse($rentals as $rental)
                            @include('public.partials.printer-summary-block', ['element' => $rental, 'configuration' => $printerConfiguration])
                        @empty
                            <h3 class="w-full my-8 text-xl text-center">Nincs találat</h3>
                        @endforelse
                    </div>
                </div>
            </div>
        @endif
        @if($displays->count() > 0)
            <div class="w-full bg-transparent flex justify-center my-8">
                <div class="w-full max-width-container-bordered bg-white fotorex-list-container" style="min-height:0px" x-data="{showDetails: false}">
                    <h1 class="text-xl cursor-pointer text-white bg-fotored uppercase py-2 pl-4 w-full font-bold flex justify-between items-center"
                        @click="showDetails = !showDetails"
                    >
                        Kijelzők ({{ $displays->count() }})
                        <span x-bind:class="{'rotate-90' : !showDetails}"
                              class="outline-none focus:outline-none transform transition-transform ease-in-out duration-150 mr-4 text-3xl cursor-pointer"
                              @click="showDetails = !showDetails"
                        >&#9660;</span>
                    </h1>
                    <div x-show="showDetails" class="mt-4">
                        @forelse($displays as $display)
                            @include('public.partials.display-summary-block', ['element' => $display, 'configuration' => $displayConfiguration])
                        @empty
                            <h3 class="w-full my-8 text-xl text-center">Nincs találat</h3>
                        @endforelse
                    </div>
                </div>
            </div>
        @endif
        @if($articles->count() > 0)
            <div class="w-full bg-transparent flex justify-center">
                <div class="w-full max-width-container-bordered bg-white fotorex-list-container" style="min-height:0px" x-data="{showDetails: false}">
                    <h1 class="text-xl cursor-pointer text-white bg-fotored uppercase py-2 pl-4 w-full font-bold flex justify-between items-center"
                        @click="showDetails = !showDetails"
                    >
                        Egyéb tartalmak ({{ $articles->count() }})
                        <span x-bind:class="{'rotate-90' : !showDetails}"
                              class="outline-none focus:outline-none transform transition-transform ease-in-out duration-150 mr-4 text-3xl cursor-pointer"

                        >&#9660;</span>
                    </h1>
                    <div x-show="showDetails" class="mt-4">
                        @forelse($articles as $article)
                            @include('public.partials.article-summary-block', ['element' => $article])
                        @empty
                            <h3 class="w-full my-8 text-xl text-center">Nincs találat</h3>
                        @endforelse
                    </div>
                </div>
            </div>
        @endif
        <div class="h-16 bg-transparent w-full"></div>
    @else
        <div class="w-full bg-transparent flex justify-center">
            <div class="w-full max-width-container-bordered bg-white">
                <h1 class="text-center font-bolder text-2xl fotored  py-8">A kereséshez írjon be legalább három karaktert a szövegmezőbe!</h1>
            </div>
        </div>
    @endif
@endsection
