<section class="container padding-top-3x">
    <h3 class="text-center mb-30">{{ $title }}</h3>
    <div class="row">
        @foreach ($elements as $element)
            <div class="{{ $columnClass }}">
                <div class="card mb-30">
                    <a class="card-img-tiles" href="{{ $element->url }}">
                        <div class="inner">
                            <!--
                            <div class="main-img"><img src="img/shop/categories/01.jpg" alt="Category"></div>
                            <div class="thumblist"><img src="img/shop/categories/02.jpg" alt="Category">
                                <img src="img/shop/categories/03.jpg" alt="Category">
                            </div>
                            -->
                        </div>
                    </a>
                    <div class="card-body text-center">
                        <h4 class="card-title">{{ $element->name }}</h4>
                        <p class="text-muted">{{ $element->description }}</p>
                        <a class="btn btn-outline-primary btn-sm" href="{{ $element->url }}">@lang('Details')</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="text-center"><a class="btn btn-outline-secondary margin-top-none" href="{{ $categoriesIndexUrl }}">@lang('All categories')</a></div>
</section>
