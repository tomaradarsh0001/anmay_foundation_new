<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="{{ route('dashboard') }}">
            <h4 class="fw-bold text-primary m-0">Anmay<span class="text-dark"> Foundation</span></h4>
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
    <li class="has-sub {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="js-arrow" href="{{ route('dashboard') }}">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
    </li>
     <li class="has-sub {{ request()->routeIs('website-details.index') ? 'active' : '' }}">
        <a class="js-arrow" href="{{ route('website-details.index') }}">
            <i class="fas fa-tachometer-alt"></i> Website Details
        </a>
    </li>
      <li class="has-sub {{ request()->routeIs('admin.contacts') ? 'active' : '' }}">
        <a class="js-arrow" href="{{ route('admin.contacts') }}">
            <i class="fas fa-tachometer-alt"></i> Contact Forms
        </a>
    </li>
     <li class="has-sub {{ request()->routeIs('testimonials.index') ? 'active' : '' }}">
        <a class="js-arrow" href="{{ route('testimonials.index') }}">
            <i class="fas fa-tachometer-alt"></i> Testimonials
        </a>
    </li>
     <li class="has-sub {{ request()->routeIs('submissions.index') ? 'active' : '' }}">
        <a class="js-arrow" href="{{ route('submissions.index') }}">
            <i class="fas fa-tachometer-alt"></i> Submissions
        </a>
    </li>
     <li class="has-sub {{ request()->routeIs('causes.index') ? 'active' : '' }}">
        <a class="js-arrow" href="{{ route('causes.index') }}">
            <i class="fas fa-tachometer-alt"></i> Causes
        </a>
    </li>
</ul>

        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->
 