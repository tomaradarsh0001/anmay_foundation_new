<!-- HEADER MOBILE-->
<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="{{ route('dashboard') }}">
                               <h4 class="fw-bold text-primary m-0">Anmay<span class="text-dark"> Foundation</span></h4>

                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
   <nav class="navbar-mobile">
    <div class="container-fluid">
        <ul class="navbar-mobile__list list-unstyled">
            <li class="has-sub {{ request()->routeIs('dashboard*') ? 'active' : '' }}">
                <a class="js-arrow" href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
        </ul>
    </div>
</nav>

</header>
<!-- END HEADER MOBILE-->