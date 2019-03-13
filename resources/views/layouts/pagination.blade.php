@if ($dataproviderResult->getPageCount() > 1)
    @if($dataproviderResult->isAtFirstPage())
        <span class="{{ $buttonClass ?? '' }}">&lt;&lt;</span>
        <span class="{{ $buttonClass ?? '' }}">&lt;</span>
    @else
        <a href="{{ $dataproviderResult->firstPageUrl() }}" class="{{ $buttonClass ?? '' }}">&lt;&lt;</a>
        <a href="{{ $dataproviderResult->previousPageUrl() }}" class="{{ $buttonClass ?? '' }}">&lt;</a>
    @endif
    @if(($compact) && ($dataproviderResult->currentPage > $dataproviderResult::COMPACT_VIEW_SURROUNDING_BUTTON_COUNT + 1)) ... @endif
    @foreach ($dataproviderResult->getPaginationButtonsToShow($compact) as $page => $button)
        @if ($button->current)
            <span class="{{ $buttonClass ?? '' }}">{{ $page }}</span>
        @else
            <a href="{{ $dataproviderResult->pageUrl($page) }}" class="{{ $buttonClass ?? '' }}">{{ $button->label }}</a>
        @endif
    @endforeach
    @if(($compact) && ($dataproviderResult->currentPage + $dataproviderResult::COMPACT_VIEW_SURROUNDING_BUTTON_COUNT + 1 < $dataproviderResult->getPageCount())) ... @endif
    @if($dataproviderResult->isAtLastPage())
        <span class="{{ $buttonClass ?? '' }}">&gt;&gt;</span>
        <span class="{{ $buttonClass ?? '' }}">&gt;</span>
    @else
        <a href="{{ $dataproviderResult->lastPageUrl() }}" class="{{ $buttonClass ?? '' }}">&gt;&gt;</a>
        <a href="{{ $dataproviderResult->nextPageUrl() }}" class="{{ $buttonClass ?? '' }}">&gt;</a>
    @endif
@endif