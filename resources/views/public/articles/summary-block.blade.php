<div class="grid-item">
    <div class="blog-post">
        @if($subject->index_image != null)
            <a class="post-thumb" href="{{ $subject->url }}">
                <img src="{{ $subject->index_image }}" alt="{{ $subject->title }}">
            </a>
        @endif
        <div class="post-body">
            <h3 class="post-title"><a href="{{ $subject->url }}">{!! $subject->title !!}</a></h3>
            <h6>
                <i class="icon-clock"></i>
                <span class="small text-muted">{{ $subject->published_at->format('Y-m-d') }}</span>
            </h6>
            <p>{!! $subject->summary !!}
                <a href="{{ $subject->url }}">Tovább</a>
            </p>
        </div>
    </div>
</div>

