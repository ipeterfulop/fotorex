@extends('layouts.unishop.app')
@section('content')
    <div class="container padding-bottom-2x padding-top-2x">
        @if(session()->has('message'))
            <div class="row">
                <div class="alert alert-info text-center margin-bottom-2x margin-top-2x col-12">
                    {!! session()->pull('message') !!}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <h6 class="text-muted text-lg text-uppercase margin-top-2x margin-bottom-2x">Kapcsolat</h6>
                <div class="row">
                    <div class="col-md-5">
                        <ul class="list-icon">
                            <li> <i class="icon-mail text-muted"></i>FOTOREX Irodatechnika Kft.</li>
                            <li> <i class="icon-mail text-muted"></i>1148 Budapest, Lengyel u. 16.</li>
                            <li> <i class="icon-mail text-muted"></i><a class="navi-link" href="mailto:{!! 'info@fotorex.hu'  !!}">{!! 'info@fotorex.hu'  !!}</a></li>
                            <li> <i class="icon-phone text-muted"></i>	+36 (1) 470-4020 / 222-1198</li>
                            <li> <i class="icon-clock text-muted"></i>nyitvatartás: hétfő-péntek 8:00-16:00</li>
                        </ul>
                        <p class="text-danger">
                            Cégünk nem járul hozzá az alábbi elérhetőségek telemarketing, direct marketing, valamint ügynöki, közvéleménykutatási célú felhasználásához!
                        </p>
                    </div>
                    <div class="col-md-7">

                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h6 class="text-muted text-lg text-uppercase margin-top-2x margin-bottom-2x">Írjon nekünk</h6>
                <form method="POST">
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
                        <button class="btn btn-primary" type="submit">Küldés</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection