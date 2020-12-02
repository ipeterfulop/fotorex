@extends('layouts.tailwind.app')
@section('content')
    <div class="w-full bg-transparent flex flex-row justify-center">
        <div class="w-full max-width-container-bordered bg-white flex flex-col">

            @if(session()->has('message'))
                <div class="w-full text-center col-12 py-8 text-xl text-fotored bg-fotomediumgray">
                    {!! session()->pull('message') !!}
                </div>
            @endif
            <h2 class="w-full uppercase text-xl my-4 py-8 text-white bg-fotored text-center">Kapcsolat</h2>
            <div class="p-4 text-xl">
                <ul class="flex flex-col">
                    <li> <i class="icon-mail text-muted"></i>{{ config('company.name') }}</li>
                    <li> <i class="icon-mail text-muted"></i>{{ config('company.address') }}</li>
                    <li> <i class="icon-mail text-muted"></i><a class="navi-link" href="mailto:{!! config('company.email')  !!}">{!! config('company.email')  !!}</a></li>
                    <li> <i class="icon-phone text-muted"></i>{{ config('company.phone') }}</li>
                    <li> <i class="icon-clock text-muted"></i>nyitvatartás: hétfő-péntek 8:00-16:00</li>
                </ul>
                <p class="text-fotored">
                    Cégünk nem járul hozzá az alábbi elérhetőségek telemarketing, direct marketing, valamint ügynöki, közvéleménykutatási célú felhasználásához!
                </p>
            </div>
            <h2 class="w-full uppercase text-xl my-4 py-8 text-white bg-fotored text-center">Írjon nekünk</h2>
            <div class="p-4">
                @include('public.partials.contactform', ['ajax' => false])
            </div>
        </div>
    </div>
@endsection
