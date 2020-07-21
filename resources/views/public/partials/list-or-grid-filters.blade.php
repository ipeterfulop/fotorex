<div x-ref="filters" class="px-2">
    @foreach($filters as $filter)
        {!! $filter->view()->render() !!}
    @endforeach
</div>
