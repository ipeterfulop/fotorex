<div x-ref="filters" class="px-2">
    @foreach($filters as $filter)
        <div class="w-full mb-3 shadow-sm rounded-sm">
            {!! $filter->view()->render() !!}
        </div>
    @endforeach
</div>