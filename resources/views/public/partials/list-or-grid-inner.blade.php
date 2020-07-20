@foreach($elements as $element)
    <div class="fotorex-list-item">
        @include($view, ['element' => $element])
    </div>
@endforeach
@if($showPagination)
    <div class="w-full flex items-center justify-center">
        @for($p = 1; $p < $result->pages; $p++)
            <div class="h-12 w-12 border border-gray-200 m-1 @if($result->currentPage == $p) bg-gray-100 @endif">
                <a class="w-full h-full p-4" href="{{ route($result->indexRouteName, $result->routingOptions + [$result->pageFieldName => $p]) }}">{{ $p }}</a>
            </div>
        @endfor
    </div>
@endif
