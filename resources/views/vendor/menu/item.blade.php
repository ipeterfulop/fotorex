@if($menuitem->menuitemtype_id == Datalytix\Menu\Menuitem::TITLE_TYPE_ID)
    <li class="menu-title">
        @include($itemInnerViewName ?? 'menu::item-inner', ['menuitem' => $menuitem])
    </li>
    @if($menuitem->menuitems->isNotEmpty())
        @foreach($menuitem->menuitems as $subMenuItem)
            @include($itemViewName ?? 'menu::item', ['menuitem' => $subMenuItem])
        @endforeach
    @endif
@else
    <li class="
        @if($menuitem->menuitems->isNotEmpty()) has-sub @endif
    @if($menuitem->isActive()) active @endif
            ">
        @include($itemInnerViewName ?? 'menu::item-inner', ['menuitem' => $menuitem])
        @if($menuitem->menuitems->isNotEmpty())
            <ul class="list-unstyled">
                @foreach($menuitem->menuitems as $subMenuItem)
                    @include($itemViewName ?? 'menu::item', ['menuitem' => $subMenuItem])
                @endforeach
            </ul>
        @endif
    </li>
@endif
