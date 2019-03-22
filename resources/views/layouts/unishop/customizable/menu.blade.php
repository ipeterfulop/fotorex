@foreach(\App\Factories\ArticleMenuFactory::generateMenuitems() as $category)
    <li class="has-submenu">
        <a href="{{ route('articles_redirect_to_latest', ['categorySlug' => $category->custom_slug_base]) }}">{{ $category->name }}</a>
        <ul class="sub-menu">
            @foreach($category->publishedarticles as $article)
                <li><a href="{{ $article->url }}">{{ $article->title }}</a></li>
            @endforeach
        </ul>
    </li>
@endforeach