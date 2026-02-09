<div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
    <div class="top-bar text-white-50 row gx-0 align-items-center d-none d-lg-flex">
        <div class="col-lg-6 px-5 text-start">
            <small><i class="fa fa-map-marker-alt me-2"></i>{{ $websiteDetails->address ?? 'Not set' }}</small>
            <small class="ms-2"><i class="fa fa-envelope me-2"></i>{{ $websiteDetails->email ?? 'Not set' }}</small>
            <small class="ms-2"><i class="fa fa-mobile me-2"></i>{{ $websiteDetails->phone ?? 'Not set' }}</small>
        </div>
        <div class="col-lg-6 px-5 text-end">
            <small>Follow us:</small>
            <a class="text-white-50 ms-3" href="{{ $websiteDetails->facebook ?? 'Not set' }}"><i class="fab fa-facebook-f"></i></a>
            <a class="text-white-50 ms-3" href="{{ $websiteDetails->twitter ?? 'Not set' }}"><i class="fab fa-twitter"></i></a>
            <a class="text-white-50 ms-3" href="{{ $websiteDetails->linkedin ?? 'Not set' }}"><i class="fab fa-linkedin-in"></i></a>
            <a class="text-white-50 ms-3" href="{{ $websiteDetails->instagram ?? 'Not set' }}"><i class="fab fa-instagram"></i></a>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="{{ route('home') }}" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="fw-bold text-primary m-0">Anmay<span class="text-white">Foundation</span></h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="nav-item nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                <a href="{{ route('causes') }}" class="nav-item nav-link {{ request()->routeIs('causes') ? 'active' : '' }}">Causes</a>
                <a href="{{ route('testimonial') }}" class="nav-item nav-link {{ request()->routeIs('testimonial') ? 'active' : '' }}">Testimonials</a>
                <a href="{{ route('volunteer') }}" class="nav-item nav-link {{ request()->routeIs('volunteer') ? 'active' : '' }}">Volunteer</a>
                <a href="{{ route('contact') }}" class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
            </div>
            <div class="d-none d-lg-flex ms-2">
                <a class="btn btn-outline-primary py-2 px-3" href="{{ route('donate') }}">
                    Donate Now
                    <div class="d-inline-flex btn-sm-square bg-white text-primary rounded-circle ms-2">
                        <i class="fa fa-arrow-right"></i>
                    </div>
                </a>
            </div>
        </div>
    </nav>
</div>