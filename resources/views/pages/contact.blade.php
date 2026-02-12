@extends('layouts.app')

@section('title', 'Causes - Anmay Foundation')

@section('content')
<style>
    body{
        background-color: #001D23  !important;
    }
</style>


  <!-- Contact Section Start -->
<section class="contact-section py-5" >
    <div class="container-fluid donate mt-5" data-parallax="scroll" data-image-src="{{ asset('assets/img/carousel-2.jpg') }}">
        
        <div class="row g-5 align-items-center">

            <!-- Left Side: Contact Info -->
            <div class="col-lg-5 wow fadeInLeft m-5" data-wow-delay="0.2s">
                <div class="mb-4">
                    <h2 class="fw-bold text-white">Get in Touch</h2>
                    <p class="text-muted text-white">Reach out to our main contact for any inquiries or support. We’re here to help!</p>
                </div>
                <div class="contact-info mb-3">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa fa-user fa-lg text-primary me-3"></i>
                        <div>
                            <h6 class="mb-0 fw-semibold text-white">Ankita Gupta</h6>
                            <small class="text-muted text-white">Main Contact</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa fa-envelope fa-lg text-primary me-3"></i>
                        <div>
                            <h6 class="mb-0 text-white"><a href="mailto:{{ $websiteDetails->email ?? 'Not set' }}" class="text-white">{{ $websiteDetails->email ?? 'Not set' }}</a></h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa fa-phone fa-lg text-primary me-3"></i>
                        <div>
                            <h6 class="mb-0"><a href="tel:{{ $websiteDetails->phone ?? 'Not set' }}" class="text-white">{{ $websiteDetails->phone ?? 'Not set' }}</a></h6>
                        </div>
                    </div>
                </div>
                <a href="https://www.google.com/maps" target="_blank" class="btn btn-primary mt-3">
                    Get Directions <i class="fa fa-arrow-right ms-2"></i>
                </a>
            </div>

            <!-- Right Side: Contact Form -->
            <div class="col-lg-5 wow fadeInRight margin" data-wow-delay="0.4s">

                <div class="bg-white shadow rounded p-5">
                     <h2 class="fw-bold mb-4">Contact Form</h2>
                     <div id="formMessage3" class="form-message-wrapper text-white"></div>
                    <form id="contactForm3" action="{{ route('form.store.contact') }}" method="POST">
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
<style>
    .margin{
        margin-top: 150px !important;
        margin-bottom: 50px !important
    }
    
    /* Add fadeOut animation if not already in your CSS */
    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }
    
    .form-message {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        animation: fadeIn 0.5s ease;
    }
    
    .form-message.success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('contactForm3').addEventListener('submit', function (e) {
        e.preventDefault();

        const form = this;
        const formData = new FormData(form);
        const messageBox = document.getElementById('formMessage3');
        const submitBtn = form.querySelector('button[type="submit"]');

        // Disable button and show submitting text
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Sending...';

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || form.querySelector('input[name="_token"]')?.value
            }
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    messageBox.innerHTML = `
                    <div class="form-message success">
                        <i class="fa fa-check-circle"></i>
                        <span>${data.message}</span>
                    </div>
                `;

                    // Fade out message after 4 seconds
                    setTimeout(() => {
                        const msg = document.querySelector('.form-message');
                        if (msg) {
                            msg.style.animation = 'fadeOut 0.5s ease forwards';
                            setTimeout(() => msg.remove(), 500);
                        }
                    }, 4000);

                    form.reset();
                } else {
                    messageBox.innerHTML = `
                    <div class="alert alert-danger">
                        ${data.message}
                    </div>
                `;
                }
            })
            .catch((error) => {
                console.error('Error:', error);
                messageBox.innerHTML = `
                <div class="alert alert-danger">
                    Server error. Please try again.
                </div>
            `;
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Send Message <i class="fa fa-paper-plane ms-2"></i>';
            });
    });
});
</script>
@endsection