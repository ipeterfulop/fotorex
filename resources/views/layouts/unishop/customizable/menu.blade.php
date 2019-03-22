@foreach(\App\Factories\ArticleMenuFactory::generateMenuitems() as $category)
    <li class="has-submenu">
        <a href="#">{{ $category->name }}</a>
        <ul class="sub-menu">
            @foreach($category->articles as $article)
                <li><a href="{{ $article->url }}">{{ $article->title }}</a></li>
            @endforeach
        </ul>
    </li>
@endforeach