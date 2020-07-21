@forelse($elements as $element)
    <div class="fotorex-list-item">
        @include($view, ['element' => $element])
    </div>
@empty
    <div class="w-full text-center mt-16">Nincs találat</div>
@endforelse
@if($showPagination)
    <div class="w-full flex items-center justify-center">
        @for($p = 1; $p < $result->pages; $p++)
            <div class="h-12 w-12 border border-gray-200 m-1 @if($result->currentPage == $p) bg-gray-100 @else  hover-red-link @endif">
                <span class="w-full h-full p-4 fotorex-list-container-pagination-link  flex items-center justify-center" data-page="{{ $p }}">{{ $p }}</span>
            </div>
        @endfor
    </div>
@endif
