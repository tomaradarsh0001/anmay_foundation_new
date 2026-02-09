<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="{{ route('dashboard') }}">
            <h4 class="fw-bold text-primary m-0">
                Anmay <span class="text-dark">Foundation</span>
            </h4>
        </a>
    </div>

    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">

                <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>

                <li class="{{ request()->routeIs('website-details.index') ? 'active' : '' }}">
                    <a href="{{ route('website-details.index') }}">
                        <i class="fas fa-globe"></i> Website Details
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.contacts') ? 'active' : '' }}">
                    <a href="{{ route('admin.contacts') }}">
                        <i class="fas fa-envelope-open-text"></i> Contact Forms
                    </a>
                </li>

                <li class="{{ request()->routeIs('testimonials.index') ? 'active' : '' }}">
                    <a href="{{ route('testimonials.index') }}">
                        <i class="fas fa-comments"></i> Testimonials
                    </a>
                </li>

                <li class="{{ request()->routeIs('submissions.index') ? 'active' : '' }}">
                    <a href="{{ route('submissions.index') }}">
                        <i class="fas fa-file-alt"></i> Submissions
                    </a>
                </li>

                <li class="{{ request()->routeIs('causes.index') ? 'active' : '' }}">
                    <a href="{{ route('causes.index') }}">
                        <i class="fas fa-hand-holding-heart"></i> Causes
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.donations.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.donations.index') }}">
                        <i class="fas fa-donate"></i> Donations
                    </a>
                </li>                               
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->
