@push('menu-content')
    @includeIf('layouts.unishop.customizable.menu')
@endpush
<header class="site-header navbar-sticky">
    <!-- Topbar-->
    <div class="topbar d-flex justify-content-between">
        <!-- Logo-->
        <div class="site-branding d-flex">
            <a class="site-logo align-self-center" href="/">
                <img src="/img/logo/logo.png" alt="{{ config('app.name') }}">
            </a>
        </div>
        <!-- Mobile Menu-->
        <div class="toolbar d-flex">
            <div class="toolbar-item visible-on-mobile mobile-menu-toggle"><a href="#">
                    <div><i class="icon-menu"></i><span class="text-label">Menu</span></div></a>
            </div>
            <div class="mobile-menu">
                <!-- Search Box-->
                <div class="mobile-search">
                    <form class="input-group" method="get"><span class="input-group-btn">
                    <button type="submit"><i class="icon-search"></i></button></span>
                        <input class="form-control" type="search" placeholder="Search site">
                    </form>
                </div>
                <!-- Slideable (Mobile) Menu-->
                <nav class="slideable-menu">
                    <ul class="menu" data-initial-height="385">
                        @stack('menu-content')
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar-->
    <div class="navbar">
        <!-- Main Navigation-->
        <nav class="site-menu">
            <ul>
                @stack('menu-content')
            </ul>
        </nav>
    </div>
</header>
