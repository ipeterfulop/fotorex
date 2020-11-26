@extends('layouts.tailwind.app', ['pageTitle' => $printer->html_page_title, 'pageDescription' => $printer->html_page_meta_description])
@section('content')
    <div class="w-full bg-transparent flex flex-col justify-center items-center my-8">
        <div class="w-full flex flex-col justify-center items-center my-8">
            <div class="w-full max-width-container-bordered bg-white p-4">
                <div class="flex flex-col lg:flex-row">
                    <div class="w-full lg:w-2/6 flex flex-col items-stretch justify-start h-128 lg:h-64">
                        @include('public.partials.imageviewer', ['printerphotos' => $printer->getAllPhotoUrls()])
                    </div>
                    <div class="w-full lg:w-3/6 flex flex-col items-stretch justify-start h-64">
                        <h2 class="font-bold text-2xl mb-4">{{ $printer->displayname }}</h2>
                        @include('public.partials.printers.detail-boxes', ['printer' => $printer])
                        <div class="w-full py-4 flex flex-col items-start justify-center text-xl">
                            {!! $printer->price_label !!}
                        </div>
                        <div class="w-full py-4 flex flex-col items-start justify-center">
                            @if($printer->product_url_on_manufacturer_website != null)
                                <a target="_blank" class="text-blue-500 hover:underline hover:text-blue-700" href="{{ $printer->product_url_on_manufacturer_website }}">Leírás</a>
                            @endif
                            @if($printer->specification_sheet != null)
                                <a target="_blank" class="text-blue-500 hover:underline hover:text-blue-700" href="{{ $printer->specification_sheet }}">Technikai adatok</a>
                            @endif
                        </div>
                    </div>
                    <div class="w-full lg:w-1/6 flex flex-col items-stretch justify-start h-64 text-center">
                        <a class="bg-fotogray hover:bg-fotored hover:text-white w-full flex items-center justify-center font-bold py-3 flex-grow m-1" href="{{ route('compare_products', ['first' => $printer->slug]) }}">Összehasonlítás más termékkel</a>
                        <button class="bg-fotogray hover:bg-fotored hover:text-white w-full flex items-center justify-center font-bold py-3 flex-grow m-1" form="print-to-pdf">PDF nyomtatás</button>
                        <button class="bg-fotogray hover:bg-fotored hover:text-white w-full flex items-center justify-center font-bold py-3 flex-grow m-1"
                                onclick="showSendForm()"
                        >Küldés e-mailben</button>
                        <button class="bg-fotogray hover:bg-fotored hover:text-white w-full flex items-center justify-center font-bold py-3 flex-grow m-1"
                                onclick="showContactForm()"
                        >Érdekel az ajánlat</button>
                    </div>
                </div>
            </div>
            <div class="w-full max-width-container-bordered bg-white p-4 flex flex-col lg:flex-row">
                <div class="w-3/4">
                    <h2 class="text-2xl">Leírás</h2>
                    {!! $printer->description !!}
                </div>
                <div class="w-1/4 flex flex-col">
                    @include('public.partials.printers.similars', ['title' => 'Hasonló termékek', 'similarPrinters' => $printer->similarprinters])
                    @include('public.partials.printers.similars', ['title' => 'Más látogatók az alábbi termékeket tekintették meg', 'similarPrinters' => $printer->printersviewedbyothers])
                </div>
            </div>
            <div class="w-full max-width-container-bordered bg-white p-4 flex flex-col">
                <h2 class="text-2xl">Technikai adatok</h2>
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
            </div>
            <div class="w-full max-width-container-bordered bg-white p-4 flex flex-col">
                <h2 class="text-2xl">Letöltések</h2>
            </div>
        </div>
        <div class="w-full max-width-container-bordered bg-white p-4 flex flex-col hidden transition-visible"  id="contact-form-container">
            <div class="flex flex-row items-start justify-start py-4 w-full bg-white">
                @include('public.partials.contactform', [
                    'ajax' => true,
                    'action' => route('contactmessage_submit'),
                    'defaultMessage' => 'Tárgy: kérdés a(z) '.$printer->displayname.' termékkel kapcsolatban'."\n\n"
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
                @include('public.partials.formelements.text-input', [
                    'fieldName' => 'email',
                    'label' => 'E-mailcím',
                    'mandatory' => true,
                ])
                @include('public.partials.formelements.text-input', [
                    'fieldName' => 'subject',
                    'label' => 'Tárgy',
                    'mandatory' => false,
                    'value' => $printer->displayname.' - Fotorex.hu'
                ])
                @include('public.partials.formelements.textarea-input', [
                    'fieldName' => 'message',
                    'label' => 'Üzenet',
                    'mandatory' => true,
                    'value' => $printer->displayname.' - Fotorex.hu: '.$printer->getDetailsUrl()
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
