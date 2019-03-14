@if ($dataproviderResult->getPageCount() > 1)
    @if($dataproviderResult->isAtFirstPage())
        <span class="{{ $disabledButtonClass ?? '' }}">&lt;&lt;</span>
        <span class="{{ $disabledButtonClass ?? '' }}">&lt;</span>
    @else
        <a href="{{ $dataproviderResult->firstPageUrl() }}" class="{{ $buttonClass ?? '' }}">&lt;&lt;</a>
        <a href="{{ $dataproviderResult->previousPageUrl() }}" class="{{ $buttonClass ?? '' }}">&lt;</a>
    @endif
    @if(($compact) && ($dataproviderResult->currentPage > $dataproviderResult::COMPACT_VIEW_SURROUNDING_BUTTON_COUNT + 1)) ... @endif
    @foreach ($dataproviderResult->getPaginationButtonsToShow($compact) as $page => $button)
        @if ($button->current)
            <span class="{{ $activeButtonClass ?? '' }}">{{ $page }}</span>
        @else
            <a href="{{ $dataproviderResult->pageUrl($page) }}" class="{{ $buttonClass ?? '' }}">{{ $button->label }}</a>
        @endif
    @endforeach
    @if(($compact) && ($dataproviderResult->currentPage + $dataproviderResult::COMPACT_VIEW_SURROUNDING_BUTTON_COUNT + 1 < $dataproviderResult->getPageCount())) ... @endif
    @if($dataproviderResult->isAtLastPage())
        <span class="{{ $disabledButtonClass ?? '' }}">&gt;&gt;</span>
        <span class="{{ $disabledButtonClass ?? '' }}">&gt;</span>
    @else
        <a href="{{ $dataproviderResult->lastPageUrl() }}" class="{{ $buttonClass ?? '' }}">&gt;&gt;</a>
        <a href="{{ $dataproviderResult->nextPageUrl() }}" class="{{ $buttonClass ?? '' }}">&gt;</a>
    @endif
@endif