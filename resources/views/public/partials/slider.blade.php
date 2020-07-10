<div class="slider {{ $heightClass ?? 'h-128 sm:h-96 md:h-64' }} {{ $bgClass ?? 'bg-white' }} {{ $miscClass ?? '' }}" id="{{ $id }}"
     style="{{ $style ?? '' }}"
     data-slider-delay="{{ $delay ?? '3000' }}"
     data-slide-movement="element-size">
    <div class="slider-inner {{ $sliderInnerClass ?? 'mx-16' }}" style="overflow:hidden;">
        @foreach ($contents as $content)
            <div class="slider-slide {{ $itemWidthClass ?? '' }}" @if(!isset($itemWidthClass)) style="width: {{ $width ?? '20vw' }}" @endif >
            @if(isset($sliderInnerView))
                @include($sliderInnerView, $content)
            @else
                {!! $content !!}
            @endif
            </div>
        @endforeach
    </div>
</div>
