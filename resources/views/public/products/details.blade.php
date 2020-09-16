@extends('layouts.tailwind.app')
@section('content')
    <div class="w-full bg-transparent flex flex-col justify-center my-8">
        <div class="w-full max-width-container border border-gray-200 bg-white p-4">
            <div class="flex flex-col lg:flex-row">
                <div class="w-full lg:w-1/3 flex flex-col items-stretch justify-start h-64">
                    @include('public.partials.imageviewer', ['printerphotos' => $printer->printer_photos])
                </div>
                <div class="w-full lg:w-1/3 flex flex-col items-stretch justify-start h-64">
                    <h2>{{ $printer->name }}</h2>
                    <p class="w-full bg-gray-300">
                        @if($printer->request_for_price == 1)
                            Az árért keressen bennünket!
                        @else
                            {{ \App\Helpers\PriceFormatter::formatToInteger($printer->price) }}
                        @endif
                    </p>
                </div>
                <div class="w-full lg:w-1/3 flex flex-col items-stretch justify-start h-64">
                    <div class="bg-fotogray hover:bg-fotored hover:text-white w-full flex items-center justify-center font-bold py-3 flex-grow m-1">Összehasonlítás más termékkel</div>
                    <div class="bg-fotogray hover:bg-fotored hover:text-white w-full flex items-center justify-center font-bold py-3 flex-grow m-1">PDF nyomtatás</div>
                    <div class="bg-fotogray hover:bg-fotored hover:text-white w-full flex items-center justify-center font-bold py-3 flex-grow m-1">Küldés e-mailben</div>
                    <div class="bg-fotogray hover:bg-fotored hover:text-white w-full flex items-center justify-center font-bold py-3 flex-grow m-1">Érdekel az ajánlat</div>
                </div>
            </div>
        </div>
        <div class="w-full max-width-container border border-gray-200 bg-white p-4 flex flex-col lg:flex-row">
            {!! $printer->description !!}
        </div>
    </div>

@endsection
