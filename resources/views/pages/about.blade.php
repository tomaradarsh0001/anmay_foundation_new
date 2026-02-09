@extends('layouts.app')

@section('title', 'About - Anmay Foundation')

@section('content')
<style>
    body{
        background-color: #001D23  !important;
    }
</style>
        <div class="container-fluid donate mt-5 py-5" data-parallax="scroll" data-image-src="{{ asset('assets/img/carousel-2.jpg') }}" >
        <div class="container" style="margin-top: 120px !important;">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative overflow-hidden h-100" style="min-height: 400px;">
                        <img class="position-absolute w-100 h-100 pt-5 pe-5" src="{{ asset('assets/img/about-1.jpg') }}" alt="" style="object-fit: cover;">
                        <img class="position-absolute top-0 end-0 bg-white ps-2 pb-2" src="{{ asset('assets/img/about-2.jpg') }}" alt="" style="width: 200px; height: 200px;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <div class="d-inline-block rounded-pill bg-secondary text-primary  py-1 px-3 mb-3">About Us</div>
                        <h1 class="display-6 mb-5 text-white">Know Anmay Foundation</h1>
                        <div class="bg-light border-bottom border-5 border-primary rounded p-4 mb-4">
                            <p class="text-dark mb-2 ">Anmay Foundation, India is a Non-Government organisation NGO which has been working for the Visually Challenged and Senior Citizens of India since 2017. Anmay Foundation has set up a network of volunteers spread across India and interacts visually challenged and older persons on daily basis through its volunteers’ network.</p>
                        </div>
                        <p class="mb-5 text-white">Our successful program outcomes are thanks to our donors who make our work possible. Thanks to you, we are able to make a sustainable impact and see results in the fight against avoidable blindness.</p>
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
@endsection