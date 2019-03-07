<ul>
    @foreach(Datalytix\Menu\Factories\MenuFactory::buildForCurrentUser() as $menuitem)
        @include('menu::item', ['menuitem' => $menuitem])
    @endforeach
</ul>
