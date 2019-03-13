<div class="blog-post article-summary-block">
    <div class="post-body">
        <ul class="post-meta">
            <li><i class="icon-clock"></i><a href="#">{{ $article->published_at->format('Y-m-d') }}</a></li>
        </ul>
        <h3 class="post-title"><a href="{{ $article->url }}">{{ $article->title }}</a></h3>
        <p>
            @if($article->index_image != null)
                <img class="article-index-image" src="{{ $article->index_image }}">
            @endif
            {!! $article->summary !!}
            <a href="{{ $article->url }}">Tovább</a>
        </p>
    </div>
</div>
