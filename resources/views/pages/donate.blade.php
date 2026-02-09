@extends('layouts.app')

@section('title', 'Causes - Anmay Foundation')

@section('content')

<style>
    body{
        background-color: #001D23 !important;
    }

    .mts{
        padding: 200px !important;
    }

    /* Inline image wrapper */
    .kalam-image-wrapper{
        display: flex;
        gap: 20px;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
    }

    .kalam-image-wrapper img{
        width: 45%;
        max-width: 220px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.4);
        transition: transform 0.3s ease;
    }

    .kalam-image-wrapper img:hover{
        transform: scale(1.05);
    }

    .kalam-content h2,
    .kalam-content h6,
    .kalam-content p,
    .quote-author{
        color: #fff;
    }

    .kalam-paragraph{
        line-height: 1.8;
        margin-top: 15px;
    }

    .kalam-quote{
        margin-top: 20px;
        font-style: italic;
        opacity: 0.9;
    }

    @media(max-width: 768px){
        .mts{
            padding: 100px 20px !important;
        }

        .kalam-image-wrapper img{
            width: 80%;
        }
    }
</style>

<!-- Kalam Inspiration Start -->
<div class="container-fluid donate mts" data-parallax="scroll" data-image-src="{{ asset('assets/img/carousel-2.jpg') }}">
    <div class="row align-items-center g-5">

        <!-- Images -->
        <div class="col-lg-5 text-center wow fadeInLeft">
            <div class="kalam-image-wrapper">
                <img src="{{ asset('assets/img/payment1.jpg') }}" alt="Payment QR">
                <img src="{{ asset('assets/img/payment2.jpg') }}" alt="Payment QR">
            </div>
            <div class="phonepe-btn">
                <a href="#" target="_blank">
                    <img src="{{ asset('assets/img/phonepay.png') }}" alt="PhonePe">
                    Pay using PhonePe
                </a>
            </div>

        </div>

        
        <!-- Text -->
        <div class="col-lg-7 wow fadeInRight">
            <div class="kalam-content position-relative">

               <h2 class="fw-bold">Donate for a Better Tomorrow</h2>
            <h6 class="mb-4">Anmay Foundation</h6>

            <p class="kalam-paragraph">
                Every contribution you make becomes hope for someone in need.
                Your support enables Anmay Foundation to bring education, dignity,
                and opportunity to countless lives.
            </p>

            <div class="kalam-quote">
                <div class="quote-author">
                    “True wealth is measured by how many lives we uplift.”
                    <br>— Anmay Foundation
                </div>
            </div>

            </div>
        </div>

    </div>
</div>
<!-- Kalam Inspiration End -->

@endsection
