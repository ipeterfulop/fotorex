<div x-ref="filters" class="px-2 w-full">
    <h2 class="h-12 mb-2 bg-fotomediumgray flex items-center justify-start pl-2 font-semibold">További opciók</h2>
    @foreach($filters as $filter)
        <div class="w-full my-8 shadow-sm rounded-sm">
            {!! $filter->view()->render() !!}
        </div>
    @endforeach
</div>
