@extends('layouts.tailwind.app')
@section('content')
    <div class="w-full bg-transparent flex flex-col justify-center my-8">
        <div class="w-full max-width-container border border-gray-200 bg-white p-4">
            <div class="flex flex-col lg:flex-row">
                <div class="w-full lg:w-2/6 flex flex-col items-stretch justify-start h-64">
                    @include('public.partials.imageviewer', ['printerphotos' => $printer->getAllPhotoUrls()])
                </div>
                <div class="w-full lg:w-3/6 flex flex-col items-stretch justify-start h-64">
                    <h2 class="font-bold">{{ $printer->name }}</h2>
                    @include('public.partials.printers.detail-boxes')
                    <p class="w-full bg-gray-300">
                        @if($printer->request_for_price == 1)
                            Az árért keressen bennünket!
                        @else
                            {{ \App\Helpers\PriceFormatter::formatToInteger($printer->price) }}
                        @endif
                    </p>
                </div>
                <div class="w-full lg:w-1/6 flex flex-col items-stretch justify-start h-64">
                    <div class="bg-fotogray hover:bg-fotored hover:text-white w-full flex items-center justify-center font-bold py-3 flex-grow m-1">Összehasonlítás más termékkel</div>
                    <div class="bg-fotogray hover:bg-fotored hover:text-white w-full flex items-center justify-center font-bold py-3 flex-grow m-1">PDF nyomtatás</div>
                    <div class="bg-fotogray hover:bg-fotored hover:text-white w-full flex items-center justify-center font-bold py-3 flex-grow m-1">Küldés e-mailben</div>
                    <button class="bg-fotogray hover:bg-fotored hover:text-white w-full flex items-center justify-center font-bold py-3 flex-grow m-1"
                            onclick="document.getElementById('contact-form-container').classList.remove('hidden'); document.getElementById('contact-form-container').scrollIntoView()"
                    >Érdekel az ajánlat</button>
                </div>
            </div>
        </div>
        <div class="w-full max-width-container border border-gray-200 bg-white p-4 flex flex-col lg:flex-row">
            <div class="w-3/4">
                {!! $printer->description !!}
            </div>
            <div class="w-1/4 flex flex-col">
                @include('public.partials.printers.similars', ['title' => 'Hasonló termékek', 'similarPrinters' => $printer->similarprinters])
                @include('public.partials.printers.similars', ['title' => 'Más látogatók az alábbi termékeket tekintették meg', 'similarPrinters' => $printer->printersviewedbyothers])
            </div>
        </div>
    </div>
    <div class="flex flex-row items-start justify-start py-4 w-full hidden" id="contact-form-container">
        @include('public.partials.contactform', [
            'ajax' => true,
            'action' => route('contactmessage_submit'),
            'defaultMessage' => 'Tárgy: kérdés a(z) '.$printer->name.' termékkel kapcsolatban'."\n\n"
        ])
    </div>
@endsection
