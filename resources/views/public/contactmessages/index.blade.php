@extends('layouts.tailwind.app')
@section('content')
    <div class="w-full bg-transparent flex flex-row justify-center">
        <div class="w-full max-width-container-bordered bg-white flex flex-col">

            @if(session()->has('message'))
                <div class="row">
                    <div class="alert alert-info text-center margin-bottom-2x margin-top-2x col-12">
                        {!! session()->pull('message') !!}
                    </div>
                </div>
            @endif
            <h1 class="text-center font-bolder text-2xl text-fotored  py-8">Kapcsolat</h1>
            <div class="p-4">
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
                <h3 class="text-center font-bolder text-xl text-fotored  py-8">Írjon nekünk</h3>
                @include('public.partials.contactform', ['ajax' => false])
            </div>
        </div>
    </div>
@endsection
