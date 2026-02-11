@extends('layouts.app')

@section('title', 'Testimonials - Anmay Foundation')

@section('content')
<style>
    body{
        background-color: #001D23  !important;
    }
    .testimonial-carousel::before {
            background: none  !important;
    }
     .testimonial-carousel::after {
            background: none  !important;
    }
</style>
    <div class="container-fluid donate mt-5 py-5" data-parallax="scroll" data-image-src="{{ asset('assets/img/carousel-2.jpg') }}">
        <div class="container mt-5">
  <!-- Testimonial Start -->
     <div class=""  >
    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;" >
    <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mt-5 mb-3">Testimonials</div>
    <h1 class="display-6 mb-5 text-white">People's Love to Anmay Foundation</h1>
    </div>
  <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
  @foreach($globalTestimonials as $testimonial)
    <div class="testimonial-item text-center">
        @if($testimonial->image && Storage::disk('public')->exists($testimonial->image))
            <img class="img-fluid bg-light rounded-circle p-2 mx-auto mb-4"
                 src="{{ asset('storage/' . $testimonial->image) }}"
                 alt="{{ $testimonial->name }}"
                 style="width: 100px; height: 100px; object-fit: cover;">
        @else
            <!-- Show placeholder with initials if no image -->
            <div class="mx-auto mb-4 rounded-circle bg-light d-flex align-items-center justify-content-center"
                 style="width: 100px; height: 100px; border: 2px solid #ddd;">
                <span class="fs-3 fw-bold text-primary">
                    {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                </span>
            </div>
        @endif

        <div class="testimonial-text rounded text-center p-4 mb-5">
            <p class="mb-3">{{ $testimonial->text }}</p>
            <h5 class="mb-1">{{ $testimonial->name }}</h5>
            <span class="fst-italic text-muted">{{ $testimonial->profession }}</span>
        </div>
    </div>
@endforeach
</div>
</div>
</div>
</div>

    <!-- Testimonial End -->

@endsection