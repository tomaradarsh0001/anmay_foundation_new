@extends('layouts.app')

@section('title', 'Volunteer - Anmay Foundation')

@section('content')
<style>
    body{
        background-color: #001D23  !important;
    }
   
</style>
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
                    <h2 class="fw-bold">Become a Volunteer</h2>

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
@endsection