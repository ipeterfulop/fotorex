@extends('layouts.tailwind.app', [
    'pageTitle' => $printer->html_page_title,
    'pageDescription' => $printer->html_page_meta_description,
    'canonicalUrl' => $printer->getCanonicalUrl(),
])
@section('content')
    <div class="w-full bg-transparent flex flex-col justify-center items-center my-8">
        <div class="w-full flex flex-col justify-center items-center my-8">
            <div class="w-full max-width-container-bordered bg-white px-5 lg:px-3" style="border-bottom: 0px">
                <div class="w-full">
                    <div class="my-6 flex flex-row items-center justify-start">
                        {!! $breadcrumbData->map(function($item) {
                            return '<a class="text-fotored underline" href="'.$item['url'].'">'.$item['label'].'</a>';
                        })->implode('&nbsp;&gt;&gt;&nbsp;') !!}
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row  h-auto lg:h-100">
                    <div class="w-full lg:w-2/6 flex flex-col items-stretch justify-start h-128 lg:h-full">
                        @include('public.partials.imageviewer', ['printerphotos' => $printer->getAllPhotoUrls()])
                    </div>
                    <div class="w-full lg:w-4/6 flex flex-col items-stretch justify-start h-auto lg:h-full lg:pl-12">
                        <h2 class="font-bold text-2xl mb-4">{{ $printer->shortdisplayname }}<span class="italic font-normal ml-2">{{ $printer->name }}</span></h2>
                        <div class="w-full flex flex-col lg:flex-row">
                            <div class="w-full lg:w-2/3">
                                @if($configuration->id != \App\Helpers\Productcategory::DISPLAYS_ID)
                                    @include('public.partials.printers.detail-boxes', ['printer' => $printer])
                                 @else
                                    {!! $printer->highlighted_features_label !!}
                                @endif

                                <div class="w-full lg:w-1/2 py-4 flex flex-col items-start justify-center bg-fotolightgray bg-opacity-50 mt-4 pl-2">
                                    @if($configuration->id == \App\Helpers\Productcategory::RENTALS_ID)
                                        @foreach($printer->printerrentaloptions as $option)
                                            <div class=""><strong class="text-fotored">Bérleti díj: </strong>
                                                {!! \App\Helpers\RentalPeriodUnit::formatPriceWithSuffix($printer->rentalprice, $option->rentaloption->rental_period_unit) !!}
                                            </div>
                                            <div class=""><strong class="text-fotored">Havi oldalszám (ff): </strong>
                                                {{ \App\Helpers\PriceFormatter::formatToInteger($option->rentaloption->number_of_pages_included_bw, '') }}
                                            </div>
                                            @if($printer->color_management == \App\Helpers\ColorTechnology::COLOR_ID)
                                                <div class=""><strong class="text-fotored">Havi oldalszám (színes):</strong>
                                                    {{ \App\Helpers\PriceFormatter::formatToInteger($option->rentaloption->number_of_pages_included_color, '') }}
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div class="text-xl w-full h-full">{!! $printer->price_label !!}</div>
                                    @endif
                                </div>
                                <div class="w-full py-4 flex flex-col items-start justify-center">
                                    <a class="text-blue-500 hover:underline hover:text-blue-700" href="#leiras">Leírás</a>
                                    <a class="text-blue-500 hover:underline hover:text-blue-700" href="#technikaiadatok">Technikai adatok</a>
                                    @if($printer->specification_sheet != null)
                                        <a class="text-blue-500 hover:underline hover:text-blue-700" href="#letoltesek">Letöltések</a>
                                    @endif
                                    @if($printer->product_url_on_manufacturer_website != null)
                                        <a target="_blank" class="text-blue-500 hover:underline hover:text-blue-700" href="{{ $printer->product_url_on_manufacturer_website }}">Gyártói oldal</a>
                                    @endif
                                </div>

                            </div>
                            <div class="w-full lg:w-1/3 flex flex-col items-stretch justify-center h-auto lg:h-full">
                                @if($configuration->id != \App\Helpers\Productcategory::DISPLAYS_ID)
                                    <a class="bg-fotomediumgray hover:bg-fotored hover:text-white w-full flex items-center justify-start font-bold h-14 flex-grow mb-2 pl-4 lg:pl-2" href="{{ route('compare_products', ['first' => $printer->slug]) }}">
                                        <span class="hidden md:block mr-2 h-full w-12 text-white main-menu-svg-container text-fotored">{!! config('heroicons.solid.arrows-expand') !!}</span>
                                        Összehasonlítás más termékkel
                                    </a>
                                @endif
                                <button class="bg-fotomediumgray hover:bg-fotored hover:text-white w-full flex items-center justify-start font-bold h-14 flex-grow mb-2 pl-4 lg:pl-2" form="print-to-pdf">
                                    <span class="hidden md:block mr-2 h-full w-12 text-white main-menu-svg-container text-fotored">{!! config('heroicons.solid.printer') !!}</span>
                                    PDF nyomtatás</button>
                                <button class="bg-fotomediumgray hover:bg-fotored hover:text-white w-full flex items-center justify-start font-bold h-14 flex-grow mb-2 pl-4 lg:pl-2"
                                        onclick="showSendForm()"
                                ><span class="hidden md:block mr-2 h-full w-12 text-white main-menu-svg-container text-fotored">{!! config('heroicons.solid.mail') !!}</span>
                                    Küldés e-mailben</button>
                                <button class="bg-fotomediumgray hover:bg-fotored hover:text-white w-full flex items-center justify-start font-bold h-14 flex-grow mb-2 pl-4 lg:pl-2"
                                        onclick="showContactForm()"
                                ><span class="hidden md:block mr-2 h-full w-12 text-white main-menu-svg-container text-fotored">{!! config('heroicons.solid.cursor-click') !!}</span>
                                    Érdekel az ajánlat</button>
                                <a class="bg-fotomediumgray hover:bg-fotored hover:text-white w-full flex items-center justify-start font-bold h-14 flex-grow mb-2 pl-4 lg:pl-2"
                                   href="{{ $printer->specification_sheet }}"
                                ><span class="hidden md:block mr-2 h-full w-12 text-white main-menu-svg-container text-fotored">{!! config('heroicons.solid.document-text') !!}</span>
                                    Adatlap</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full max-width-container-bordered bg-white py-4 px-8"  style="border-bottom: 0px; border-top: 0px"><hr class="border-fotomediumgray"></div>
            <div class="w-full max-width-container-bordered bg-white p-4 flex flex-col lg:flex-row" style="border-bottom: 0px; border-top: 0px">
                <div class="w-full lg:w-3/4 mb-8 lg:mb-0 product-description-container">
                    <h2 class="text-2xl font-bold my-4"><a name="leiras">Leírás</a></h2>
                    {!! $printer->description !!}
                </div>
                <div class="w-full lg:w-1/4 flex flex-col">
                    <h2 class="block lg:hidden text-2xl mb-4">Hasonló ajánlatok</h2>
                    @include('public.partials.printers.similars', ['title' => 'Hasonló termékek', 'similarPrinters' => $printer->similarprinters])
                    @include('public.partials.printers.similars', ['title' => 'Más látogatók az alábbi termékeket tekintették meg', 'similarPrinters' => $printer->printersviewedbyothers])
                </div>
            </div>
            <div class="w-full max-width-container-bordered bg-white py-4 px-8"  style="border-bottom: 0px; border-top: 0px"><hr class="border-fotomediumgray"></div>
            <div class="w-full max-width-container-bordered bg-white p-4 flex flex-col technical-specifications-container"  style="border-bottom: 0px; border-top: 0px">
                <h2 class="text-2xl font-bold my-4"><a name="technikaiadatok">Technikai adatok</a></h2>
                @foreach(\App\Attribute::getTechnicalSpecificationAttributes() as $attribute)
                    <h3 class="text-xl font-bold my-2">{{ $attribute->name }}</h3>
                    {!! $printer->{$attribute->variable_name} !!}
                @endforeach
                @if(false)
                @foreach ($attributes as $attribute)
                    <div class="w-full md:w-1/2 flex flex-row border-b border-dotted border-fotogray py-1">
                        <div class="w-full md:w-1/2">
                            {{ $attribute['n'] }}
                        </div>
                        <div class="w-full md:w-1/2 text-right">
                            {!! $printer->{$attribute['v']} !!}
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
            <div class="w-full max-width-container-bordered bg-white py-4 px-8"  style="border-bottom: 0px; border-top: 0px"><hr class="border-fotomediumgray"></div>
            <div class="w-full max-width-container-bordered bg-white p-4 flex flex-col"  style="border-top: 0px">
                <h2 class="text-2xl font-bold my-4"><a name="letoltesek">Letöltések</a></h2>
            </div>
        </div>
        <div class="w-full max-width-container-bordered bg-white p-4 flex flex-col hidden transition-visible"  id="contact-form-container">
            <div class="flex flex-row items-start justify-start py-4 w-full bg-white">
                @include('public.partials.contactform', [
                    'ajax' => true,
                    'action' => route('contactmessage_submit'),
                    'defaultSubject' => 'Kérdés a(z) '.$printer->shortdisplayname.' termékkel kapcsolatban'."\n\n"
                ])
            </div>
        </div>
        <div class="w-full max-width-container-bordered bg-white p-4 flex flex-col hidden transition-visible"  id="send-form-container">
            <div class="flex flex-row items-start justify-start py-4 w-full bg-white">
                <form method="POST" class="w-full flex flex-col items-center justify-start"
                      action="{{ route('send_printer_details_in_email') }}"
                      id="send-form"
                >
                {{ csrf_field() }}
                @include('public.partials.formelements.honeypot', [])
                @include('public.partials.formelements.text-input', [
                    'fieldName' => 'email',
                    'label' => 'E-mailcím',
                    'mandatory' => true,
                ])
                @include('public.partials.formelements.text-input', [
                    'fieldName' => 'subject',
                    'label' => 'Tárgy',
                    'mandatory' => false,
                    'value' => $printer->shortdisplayname.' - Fotorex.hu'
                ])
                @include('public.partials.formelements.textarea-input', [
                    'fieldName' => 'message',
                    'label' => 'Üzenet',
                    'mandatory' => true,
                    'value' => $printer->shortdisplayname.' - Fotorex.hu: '.$printer->getDetailsUrl()
                ])
                <input type="text" id="email_sidenote" value="" name="email_sidenote" style="height: 0px; opacity: 0">
                <button class="btn bg-fotored hover-gray-link mt-6 p-2 text-white uppercase"
                        id="send-form-submit-button"
                        type="submit">Küldés</button>
                    <div class="text-right font-bold mt-4" id="send-form-response-message"></div>

                </form>
            </div>
        </div>
    </div>
    <form method="post" action="{{ route('print_to_pdf', ['slug' => $printer->slug]) }}" id="print-to-pdf">
        @csrf
    </form>
    <script>
        function showSendForm() {
            document.getElementById('contact-form-container').classList.add('hidden');
            document.getElementById('send-form-container').classList.remove('hidden');
            document.getElementById('send-form-container').scrollIntoView()
        }
        function showContactForm() {
            document.getElementById('send-form-container').classList.add('hidden');
            document.getElementById('contact-form-container').classList.remove('hidden');
            document.getElementById('contact-form-container').scrollIntoView()
        }
        document.getElementById('send-form').addEventListener('submit', (event) => {
            event.preventDefault();
            document.getElementById('send-form-submit-button').setAttribute('disabled', true);
            let formNode = document.getElementById('send-form');
            let formData = {
                'h_email_h': formNode.querySelector('#h_email_h').value,
                'email': formNode.querySelector('#email').value,
                'email_sidenote': formNode.querySelector('#email_sidenote').value,
                'subject': formNode.querySelector('#subject').value,
                'message': formNode.querySelector('#message').value,
            }
            Array.from(formNode.querySelectorAll('.validation-error')).forEach((errorNode) => {
                errorNode.querySelector('span').innerHTML = '';
                errorNode.classList.add('hidden');
            })
            window.axios.post(formNode.getAttribute('action'), formData)
                .then((response) => {
                    Array.from(formNode.querySelectorAll('input[type="text"]')).forEach((i) => {
                        i.value = '';
                    })
                    Array.from(formNode.querySelectorAll('textarea')).forEach((i) => {
                        i.value = '';
                    })
                    document.getElementById('send-form-response-message').innerText = response.data;
                    document.getElementById('send-form-submit-button').removeAttribute('disabled');

                }).catch((error) => {
                if (error.response.status == 422) {
                    Object.keys(error.response.data.errors).forEach((err) => {
                        let mainNode = formNode.querySelector('div[data-fieldname="'+err+'"]');
                        if (mainNode != null) {
                            let errorNode = mainNode.querySelector('.validation-error');
                            if (errorNode != null) {
                                errorNode.querySelector('span').innerHTML = error.response.data.errors[err][0];
                                errorNode.classList.remove('hidden');
                            }

                        }
                    });
                    document.getElementById('send-form-submit-button').removeAttribute('disabled');
                }
            })

        });
    </script>
@endsection
