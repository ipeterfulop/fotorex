@extends('layouts.unishop.app')
@section('content')
    @if($dataproviderResult->results->isNotEmpty())
        <div class="row">
            <div class="col-4 d-flex justify-content-start align-items-baseline">
                <label>Rendezés</label>
                <select class="form-control col-6"
                        id="sorting-options-select"
                        onchange="window.location.href = this.value"
                >
                    @foreach($sortingOptions as $sortingOption => $data)
                        <option value="{{ $sortingOption }}"
                            @if($data['sortingOption'] == $currentSortingOption) selected @endif
                        >{{ $data['label'] }}
                    @endforeach
                </select>
            </div>
            <div class="col-4 d-flex justify-content-start align-items-baseline">
                <label>Megjelenítés:</label>
                <span class="isotope-layout-selector-button" onclick="changeIsotopeLayoutToRows('{{ $isotopeContainerId }}')">
                    <i class="icon-align-justify"></i>&nbsp;&nbsp;
                    Sorok
                </span>
                <span class="isotope-layout-selector-button" onclick="changeIsotopeLayoutToGrid('{{ $isotopeContainerId }}')">
                    <i class="icon-grid"></i>&nbsp;&nbsp;
                    Rács
                </span>
            </div>
        </div>
        <div class="isotope-grid cols-3 mb-4" id="{{ $isotopeContainerId }}">
            <div class="gutter-sizer"></div>
            <div class="grid-sizer"></div>
            @foreach($dataproviderResult->results as $subject)
                @include($itemViewPath, ['subject' => $subject])
            @endforeach
        </div>
        @include('layouts.pagination', [
            'dataproviderResult' => $dataproviderResult,
            'compact' => false,
            'buttonClass' => 'btn btn-outline-default',
            'disabledButtonClass' => 'btn btn-outline-default btn-disabled',
            'activeButtonClass' => 'btn btn-outline-primary'
        ])

    @else
        Nincs találat
    @endif
    @include('layouts.scripts.isotope-helpers')
@endsection