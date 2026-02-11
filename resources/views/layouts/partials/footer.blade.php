<div class="container-fluid bg-dark text-white-50 footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-6 col-md-6">
                <h1 class="fw-bold text-primary mb-4">Anmay<span class="text-white">Foundation</span></h1>
                <p>Anmay Foundation stands for dignity, inclusion, and hope for every disabled child.Together, we nurture abilities and build a kinder, stronger society.</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-square me-1" href="{{ $websiteDetails->twitter ?? 'Not set' }}"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-square me-1" href="{{ $websiteDetails->facebook ?? 'Not set' }}"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square me-1" href="{{ $websiteDetails->youtube ?? 'Not set' }}"><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-square me-0" href="{{ $websiteDetails->linkedin ?? 'Not set' }}"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="text-light mb-4">Address</h5>
                <p><i class="fa fa-map-marker-alt me-3"></i>{{ $websiteDetails->address ?? 'Not set' }}</p>
                <p><i class="fa fa-phone-alt me-3"></i>{{ $websiteDetails->phone ?? 'Not set' }}</p>
                <p><i class="fa fa-envelope me-3"></i>{{ $websiteDetails->email ?? 'Not set' }}</p>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="text-light mb-4">Quick Links</h5>
                <a class="btn btn-link" href="/">Home</a>
                <a class="btn btn-link" href="{{ route('about') }}">About Us</a>
                <a class="btn btn-link" href="{{ route('causes') }}">Causes</a>
                <a class="btn btn-link" href="{{ route('contact') }}">Contact Us</a>
                <a class="btn btn-link" href="{{ route('donate') }}">Donate now</a>
               
            </div>
        </div>
    </div>
    <div class="container-fluid copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a href="#">anmayfoundation.org</a>, All Right Reserved.
                </div>
            </div>
        </div>
    </div>
</div>