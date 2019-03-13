<section class="hero-slider" style="background-image: url(img/hero-slider/main-bg.jpg);">
    <div class="owl-carousel large-controls dots-inside" data-owl-carousel="{ &quot;nav&quot;: true, &quot;dots&quot;: true, &quot;loop&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 7000 }">
        @foreach($elements as $element)
            <div class="item">
                <div class="container padding-top-3x">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-5 col-md-6 padding-bottom-2x text-md-left text-center">
                            <div class="from-bottom"><img class="d-inline-block w-150 mb-4" src="{!! $element->imagePath  !!}" alt="{{ $element->name }}">
                                <div class="h2 text-body text-normal mb-2 pt-1">{{ $element->name }}</div>
                                <div class="h2 text-body text-normal mb-4 pb-1">{!! $element->description !!}</div>
                            </div><a class="btn btn-primary scale-up delay-1" href="{{ $element->url }}">@lang('Details')</a>
                        </div>
                        <div class="col-md-6 padding-bottom-2x mb-3"><img class="d-block mx-auto" src="{!! $element->imagePath  !!}" alt="{{ $element->name }}"></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
