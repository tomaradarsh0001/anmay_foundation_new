@extends('layouts.app')

@section('title', 'Home - Anmay Foundation')

@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('assets/img/carousel-1.jpg') }}" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7 pt-5">
                                    <h1 class="display-4 text-white mb-3 animated slideInDown">Let's Change The World With Humanity</h1>
                                    <p class="fs-5 text-white-50 mb-5 animated slideInDown">Helping one person may not change the world, but it changes the world for that one person.</p>
                                    <a class="btn btn-primary py-2 px-3 animated slideInDown" href="{{ route('about') }}">
                                        Donate Now
                                        <div class="d-inline-flex btn-sm-square bg-white text-primary rounded-circle ms-2">
                                            <i class="fa fa-arrow-right"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ asset('assets/img/carousel-2.jpg') }}" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7 pt-5">
                                    <h1 class="display-4 text-white mb-3 animated slideInDown">Let's Save More Lifes With Our Helping Hand</h1>
                                    <p class="fs-5 text-white-50 mb-5 animated slideInDown">When we give without expecting anything in return, we discover the true meaning of abundance.</p>
                                    <a class="btn btn-primary py-2 px-3 animated slideInDown" href="{{ route('about') }}">
                                        Donate Now
                                        <div class="d-inline-flex btn-sm-square bg-white text-primary rounded-circle ms-2">
                                            <i class="fa fa-arrow-right"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative overflow-hidden h-100" style="min-height: 400px;">
                        <img class="position-absolute w-100 h-100 pt-5 pe-5" src="{{ asset('assets/img/about-1.jpg') }}" alt="" style="object-fit: cover;">
                        <img class="position-absolute top-0 end-0 bg-white ps-2 pb-2" src="{{ asset('assets/img/about-2.jpg') }}" alt="" style="width: 200px; height: 200px;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">About Us</div>
                        <h1 class="display-6 mb-5">Know Anmay Foundation</h1>
                        <div class="bg-light border-bottom border-5 border-primary rounded p-4 mb-4">
                            <p class="text-dark mb-2">Anmay Foundation, India is a Non-Government organisation NGO which has been working for the Visually Challenged and Senior Citizens of India since 2017. Anmay Foundation has set up a network of volunteers spread across India and interacts visually challenged and older persons on daily basis through its volunteers’ network.</p>
                        </div>
                        <p class="mb-5">Our successful program outcomes are thanks to our donors who make our work possible. Thanks to you, we are able to make a sustainable impact and see results in the fight against avoidable blindness.</p>
                        <a class="btn btn-primary py-2 px-3 me-3" href="{{ route('donate') }}">
                            Donate Now
                            <div class="d-inline-flex btn-sm-square bg-white text-primary rounded-circle ms-2">
                                <i class="fa fa-arrow-right"></i>
                            </div>
                        </a>
                        <a class="btn btn-outline-primary py-2 px-3" href="{{ route('contact') }}">
                            Contact Us
                            <div class="d-inline-flex btn-sm-square bg-primary text-white rounded-circle ms-2">
                                <i class="fa fa-arrow-right"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Mission Start -->
<div class="container-fluid mission-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center wow fadeInUp">

                <h1 class="display-5 fw-bold mb-4">Our Mission</h1>

                <p class="mission-text mb-4">
                    <strong>Anmay Foundation</strong> has been set up to initiate better interaction
                    between generations. We strive to:
                </p>

                <ul class="mission-list mb-5">
                    <li>Bring about a positive change in perceptions about the visually challenged</li>
                    <li>Create a senior-citizen-friendly environment</li>
                </ul>

                <!-- Stats -->
                <div class="stats-container">
                    <div class="stat-box">
                        <div class="stat-value" id="year-value">0</div>
                        <div class="stat-label">Founded</div>
                    </div>

                    <div class="stat-box highlight">
                        <div class="stat-value">
                            <span id="count-value">0</span><span class="unit">k+</span>
                        </div>
                        <div class="stat-label">Donations Impacted</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Mission End -->

<!-- Kalam Inspiration Start -->
<div class="container-fluid kalam-section py-5">
    <div class="container">
        <div class="row align-items-center g-5">

            <!-- Image -->
            <div class="col-lg-5 text-center wow fadeInLeft">
                <div class="kalam-image-wrapper">
                    <img src="{{ asset('assets/img/apj.jpg') }}" alt="Dr APJ Abdul Kalam">
                </div>
            </div>

            <!-- Text -->
            <div class="col-lg-7 wow fadeInRight">
                <div class="kalam-content position-relative">

                    <h2 class="fw-bold ">Dr. APJ Abdul Kalam</h2>
                    <h6 class="mb-4">(Former President of India)</h6>

                    <p class="kalam-paragraph">
                        Equality between people should be regardless their race, colours, creed and cultures. Dr. Kalam views that a society can make progress only when it gives equal opportunity to women in all walks of life. He was a supporter for women empowerment.
                    </p>

                    <!-- Typing Quote -->
                    <div class="kalam-quote">
                        <div class="quote-author">— Dr. A. P. J. Abdul Kalam</div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- Kalam Inspiration End -->


    <!-- Causes Start -->
    <div class="container-xxl bg-white my-5 py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">Our Causes</div>
                <h1 class="display-6 mb-5">Anmay Foundation Causes to helping the society</h1>
            </div>
             <div class="row g-4 justify-content-center">
                @foreach($globalCauses as $cause)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="causes-item d-flex flex-column bg-white border-top border-5 border-primary rounded-top overflow-hidden h-100">
                            <div class="text-center p-4 pt-0">
                                <div class="d-inline-block bg-primary text-white rounded-bottom fs-5 pb-1 px-3 mb-4">
                                    <small>{{ $cause->name }}</small>
                                </div>

                                <h5 class="mb-3">{{ $cause->heading }}</h5>
                                <p>{{ $cause->content }}</p>

                                <div class="causes-progress bg-light p-3 pt-2">
                                    <div class="d-flex justify-content-between">
                                        <p class="text-dark">
                                            ₹{{ number_format($cause->target_goal) }}
                                            <small class="text-body">Goal</small>
                                        </p>
                                        <p class="text-dark">
                                            ₹{{ number_format($cause->raised) }}
                                            <small class="text-body">Raised</small>
                                        </p>
                                    </div>

                                    @php
                                        $percent = ($cause->raised / $cause->target_goal) * 100;
                                    @endphp

                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: {{ $percent }}%">
                                            <span>{{ round($percent) }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="position-relative mt-auto">
                                <img class="img-fluid" src="{{ asset('storage/'.$cause->image) }}" alt="{{ $cause->heading }}">
                                <div class="causes-overlay">
                                    <a class="btn btn-outline-primary" href="{{ route('donate') }}">
                                        Donate now
                                        <div class="d-inline-flex btn-sm-square bg-primary text-white rounded-circle ms-2">
                                            <i class="fa fa-arrow-right"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Causes End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">What We Do</div>
                <h1 class="display-6 mb-5">Learn More What We Do And Get Involved</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item bg-white text-center h-100 p-4 p-xl-5">
                        <img class="img-fluid mb-4" src="{{ asset('assets/img/icon-1.png') }}" alt="">
                        <h4 class="mb-3">Child Education</h4>
                        <p class="mb-4">Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed vero dolor duo.</p>
                      
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item bg-white text-center h-100 p-4 p-xl-5">
                        <img class="img-fluid mb-4" src="{{ asset('assets/img/icon-2.png') }}" alt="">
                        <h4 class="mb-3">Medical Treatment</h4>
                        <p class="mb-4">Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed vero dolor duo.</p>
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item bg-white text-center h-100 p-4 p-xl-5">
                        <img class="img-fluid mb-4" src="{{ asset('assets/img/icon-3.png') }}" alt="">
                        <h4 class="mb-3">Pure Drinking Water</h4>
                        <p class="mb-4">Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed vero dolor duo.</p>
                   
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Donate Start -->
    <div class="container-fluid donate mt-5 py-5" data-parallax="scroll" data-image-src="{{ asset('assets/img/carousel-2.jpg') }}">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">Volunteer</div>
                    <h1 class="display-6 text-white mb-5">Become a volunteer in Anmay Foundation for a good cause.</h1>
                    <p class="text-white-50 mb-0">Volunteer to help people with blindness, health needs. We're a leading blindness charity providing support at home or in the community.</p>
                </div>
           <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
    <div class="h-100 bg-white p-5">

        <!-- MESSAGE AREA -->
<div id="formMessage" class="form-message-wrapper"></div>

        <form id="contactForm" action="{{ route('form.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">

                <!-- Name -->
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" name="name" class="form-control bg-light border-0" placeholder="Your Name" required>
                        <label>Your Name</label>
                    </div>
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="email" name="email" class="form-control bg-light border-0" placeholder="Your Email" required>
                        <label>Your Email</label>
                    </div>
                </div>

                <!-- Subject -->
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" name="subject" class="form-control bg-light border-0" placeholder="Subject">
                        <label>Subject</label>
                    </div>
                </div>

                <!-- CV -->
                <div class="col-md-6">
                    <label class="fw-semibold mb-2">Upload Your CV</label>
                    <input type="file" name="cv" class="form-control bg-light border-0" accept=".pdf,.doc,.docx">
                </div>

                <!-- Comment -->
                <div class="col-12">
                    <div class="form-floating">
                        <textarea name="comment" class="form-control bg-light border-0" style="height:140px"></textarea>
                        <label>Comment (Optional)</label>
                    </div>
                </div>

                <!-- Button -->
                <div class="col-12 text-center">
                    <button id="submitBtn" class="btn btn-primary px-5 py-3">
                        Submit
                        <span class="d-inline-flex btn-sm-square bg-white text-primary rounded-circle ms-2">
                            <i class="fa fa-arrow-right"></i>
                        </span>
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

            </div>
        </div>
    </div>
    <!-- Donate End -->

    <!-- Testimonial Start -->
     <div class="" style="background-color: #f9f9f9;">
    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;" >
                   <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mt-5 mb-3">Testimonials</div>
                   <h1 class="display-6 mb-5">People's Love to Anmay Foundation</h1>
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
></div>

    <!-- Testimonial End -->

  <!-- Contact Section Start -->
<section class="contact-section py-5" >
    <div class="container py-5">
        
        <div class="row g-5 align-items-center">

            <!-- Left Side: Contact Info -->
            <div class="col-lg-5 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="mb-4">
                    <h2 class="fw-bold">Get in Touch</h2>
                    <p class="text-muted">Reach out to our main contact for any inquiries or support. We’re here to help!</p>
                </div>
                <div class="contact-info mb-3">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa fa-user fa-lg text-primary me-3"></i>
                        <div>
                            <h6 class="mb-0 fw-semibold">Ankita Gupta</h6>
                            <small class="text-muted">Main Contact</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa fa-envelope fa-lg text-primary me-3"></i>
                        <div>
                            <h6 class="mb-0"><a href="mailto:{{ $websiteDetails->email ?? 'Not set' }}" class="text-dark">{{ $websiteDetails->email ?? 'Not set' }}</a></h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa fa-phone fa-lg text-primary me-3"></i>
                        <div>
                            <h6 class="mb-0"><a href="tel:{{ $websiteDetails->phone ?? 'Not set' }}" class="text-dark">{{ $websiteDetails->phone ?? 'Not set' }}</a></h6>
                        </div>
                    </div>
                </div>
                <a href="https://www.google.com/maps" target="_blank" class="btn btn-primary mt-3">
                    Get Directions <i class="fa fa-arrow-right ms-2"></i>
                </a>
            </div>

            <!-- Right Side: Contact Form -->
            <div class="col-lg-7 wow fadeInRight" data-wow-delay="0.4s">

                <div class="bg-white shadow rounded p-5">
                     <h2 class="fw-bold mb-4">Contact Form</h2>
                     <div id="formMessage2" class="form-message-wrapper"></div>
                    <form id="contactForm2" action="{{ route('form.store.contact') }}" method="POST">
                        @csrf
                        <div class="row g-3">

                            <!-- First Name -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="first_name" class="form-control border-0 bg-light" placeholder="First Name" required>
                                    <label>First Name</label>
                                </div>
                            </div>

                            <!-- Last Name -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="last_name" class="form-control border-0 bg-light" placeholder="Last Name" required>
                                    <label>Last Name</label>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control border-0 bg-light" placeholder="Email" required>
                                    <label>Email</label>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" name="phone" class="form-control border-0 bg-light" placeholder="Phone">
                                    <label>Phone</label>
                                </div>
                            </div>

                            <!-- Message -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea name="message" class="form-control border-0 bg-light" placeholder="Message" style="height:150px" required></textarea>
                                    <label>Message</label>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12 text-center mt-3">
                                <button type="submit" class="btn btn-primary px-5 py-3 animate__animated animate__pulse animate__infinite">
                                    Send Message <i class="fa fa-paper-plane ms-2"></i>
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Contact Section End -->

<!-- Include Animate.css for animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

@endsection