@if($menuitem->menuitemtype_id == Datalytix\Menu\Menuitem::TITLE_TYPE_ID)
    <li class="menu-title">
        @include('menu::item-inner', ['menuitem' => $menuitem])
    </li>
    @if($menuitem->menuitems->isNotEmpty())
        @foreach($menuitem->menuitems as $subMenuItem)
            @include('menu::item', ['menuitem' => $subMenuItem])
        @endforeach
    @endif
@else
    <li class="
        @if($menuitem->menuitems->isNotEmpty()) has-sub @endif
    @if($menuitem->isActive()) active @endif
            ">
        @include('menu::item-inner', ['menuitem' => $menuitem])
        @if($menuitem->menuitems->isNotEmpty())
            <ul class="list-unstyled">
                @foreach($menuitem->menuitems as $subMenuItem)
                    @include('menu::item', ['menuitem' => $subMenuItem])
                @endforeach
            </ul>
        @endif
    </li>
@endif
