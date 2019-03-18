<a href="{{ $menuitem->link }}">
    @if($menuitem->iconclass != null)
        <i class="{{ $menuitem->iconclass }}"></i>
    @endif
    <span>{{ $menuitem->label }}</span>
</a>
