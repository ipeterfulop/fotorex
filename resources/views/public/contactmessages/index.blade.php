@extends('layouts.tailwind.app')
@section('content')
    <div class="w-full bg-transparent flex flex-row justify-center">
        <div class="w-full max-width-container border border-gray-200 bg-white flex flex-col">

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
                    <li> <i class="icon-mail text-muted"></i>FOTOREX Irodatechnika Kft.</li>
                    <li> <i class="icon-mail text-muted"></i>1148 Budapest, Lengyel u. 16.</li>
                    <li> <i class="icon-mail text-muted"></i><a class="navi-link" href="mailto:{!! 'info@fotorex.hu'  !!}">{!! 'info@fotorex.hu'  !!}</a></li>
                    <li> <i class="icon-phone text-muted"></i>	+36 (1) 470-4020 / 222-1198</li>
                    <li> <i class="icon-clock text-muted"></i>nyitvatartás: hétfő-péntek 8:00-16:00</li>
                </ul>
                <p class="text-fotored">
                    Cégünk nem járul hozzá az alábbi elérhetőségek telemarketing, direct marketing, valamint ügynöki, közvéleménykutatási célú felhasználásához!
                </p>
                <h3 class="text-center font-bolder text-xl text-fotored  py-8">Írjon nekünk</h3>
                <form method="POST" class="w-full flex flex-col items-center justify-start">
                    {{ csrf_field() }}
                    @include('public.partials.formelements.text-input', [
                        'fieldName' => 'name',
                        'label' => 'Név',
                        'mandatory' => true,
                    ])
                    @include('public.partials.formelements.text-input', [
                        'fieldName' => 'email',
                        'label' => 'E-mailcím',
                        'mandatory' => true,
                    ])
                    @include('public.partials.formelements.text-input', [
                        'fieldName' => 'phone',
                        'label' => 'Telefonszám',
                        'mandatory' => false,
                    ])
                    @include('public.partials.formelements.textarea-input', [
                        'fieldName' => 'message',
                        'label' => 'Üzenet',
                        'mandatory' => true,
                    ])
                    <div class="form-group">
                        <button class="btn bg-fotored hover-gray-link mt-6 p-2 text-white uppercase" type="submit">Küldés</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
