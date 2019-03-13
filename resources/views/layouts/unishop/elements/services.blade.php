<section class="container padding-top-3x padding-bottom-2x">
    <div class="row">
        @foreach ($elements as $element)
            <div class="col-md-3 col-sm-6 text-center mb-30"><img class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3" src="{{ $element->image }}" alt="{{ $element->title }}">
                <h6>{{ $element->title }}</h6>
                <p class="text-muted margin-bottom-none">{{ $element->description }}</p>
            </div>
        @endforeach
    </div>
</section>
