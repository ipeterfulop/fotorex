<div class="topbar">
    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            @if(file_exists(public_path('img/logo.png')))
                <a href="/" class="logo">
                    <img src="/img/logo.png" style="height:45px">
                </a>
            @endif
        </div>
    </div>

    <!-- Button mobile view to collapse sidebar menu -->
    <nav class="navbar-custom">

        <ul class="list-inline float-right mb-0">
            @if(\Auth::check())
                <li class="list-inline-item dropdown notification-list">
                    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user"
                       data-toggle="dropdown"
                       href="#"
                       role="button"
                       id="profile-dropdown"
                       aria-haspopup="false" aria-expanded="false">{{ \Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown "
                         aria-labelledby="profile-dropdown">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="text-overflow"><small>{{ \Auth::user()->name }}</small> </h5>
                        </div>

                        <!-- item-->
                        <a href="/logout" class="dropdown-item notify-item" title="Kijelentkezés">
                            <i class="mdi mdi-logout"></i> <span>Kijelentkezés</span>
                        </a>

                    </div>
                </li>
            @endif
        </ul>

        <ul class="list-inline menu-left mb-0 d-flex align-items-baseline">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-light waves-effect">
                    <i class="mdi mdi-menu"></i>
                </button>
            </li>
        </ul>

    </nav>

</div>
