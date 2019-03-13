@push('menu-content')
    <nav class="offcanvas-menu">
        <ul class="menu">
            <li class="has-children"><span><a href="#">Category 1</a><span class="sub-menu-toggle"></span></span>
                <ul class="offcanvas-submenu">
                    <li><a href="#">Item 1</a></li>
                </ul>
            </li>
        </ul>
    </nav>
@endpush

<div class="offcanvas-container" id="shop-categories">
    <div class="offcanvas-header">
        <h3 class="offcanvas-title">Categories</h3>
    </div>
    @stack('menu-content')
</div>
<!-- Off-Canvas Mobile Menu-->
<div class="offcanvas-container" id="mobile-menu">
    <a class="account-link" href="#">
        <div class="user-ava">
            <img src="img/account/user-ava-md.jpg" alt="{{ optional(\Auth::user())->name }}">
        </div>
        <div class="user-info">
            <h6 class="user-name">{{ optional(\Auth::user())->name }}</h6>
        </div>
    </a>
    @stack('menu-content')
</div>
