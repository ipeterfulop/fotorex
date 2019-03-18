<ul>

    @foreach(Datalytix\Menu\Factories\MenuFactory::buildForCurrentUser($tag ?? null) as $menuitem)
        @include($itemViewName ?? 'menu::item', ['menuitem' => $menuitem])
    @endforeach
</ul>
