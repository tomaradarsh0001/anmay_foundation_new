@extends('layouts.app')

@section('title', 'Causes - Anmay Foundation')

@section('content')
<style>
    body{
        background-color: #001D23  !important;
    }
</style>

  <!-- Causes Start -->
    <div class="container-fluid donate mt-5 py-5" data-parallax="scroll" data-image-src="{{ asset('assets/img/carousel-2.jpg') }}">
        <div class="container pt-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">Our Causes</div>
                <h1 class="display-6 mb-5 text-white">Anmay Foundation Causes to helping the society</h1>
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
@endsection