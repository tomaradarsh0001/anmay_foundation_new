{{-- resources/views/pages/razorpay-failed.blade.php --}}
@extends('layouts.app')

@section('title', 'Payment Failed - Anmay Foundation')

@section('content')
<style>
    .failed-section { background-color: #001D23; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 50px 20px; }
    .failed-card { max-width: 600px; margin: 0 auto; background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border-radius: 20px; padding: 40px; box-shadow: 0 15px 35px rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.1); text-align: center; }
    .failed-icon { font-size: 80px; color: #dc3545; margin-bottom: 20px; }
    .failed-title { font-size: 2rem; margin-bottom: 20px; color: #fff; }
    .failed-message { color: #aaa; margin-bottom: 30px; line-height: 1.6; }
    .btn-retry { background: linear-gradient(45deg, #00b09b, #96c93d); border: none; color: white; padding: 12px 30px; border-radius: 8px; font-weight: 600; transition: all 0.3s ease; text-decoration: none; display: inline-block; margin-right: 10px; }
    .btn-home { background: #6c757d; border: none; color: white; padding: 12px 30px; border-radius: 8px; font-weight: 600; transition: all 0.3s ease; text-decoration: none; display: inline-block; }
    .btn-retry:hover, .btn-home:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.3); color: white; }
    .error-details { background: rgba(220,53,69,0.1); border-radius: 12px; padding: 20px; margin-bottom: 30px; border: 1px solid rgba(220,53,69,0.3); text-align: left; }
</style>

<section class="failed-section">
    <div class="failed-card">
        <div class="failed-icon">
            <i class="fas fa-times-circle"></i>
        </div>
        
        <h1 class="failed-title">Payment Failed</h1>
        <p class="failed-message">
            @if(isset($payment) && $payment)
                Your payment of <strong>₹{{ number_format($payment->amount, 2) }}</strong> could not be completed.
            @else
                Your payment could not be completed.
            @endif
        </p>
        
        @if(isset($payment) && $payment && $payment->failure_reason)
        <div class="error-details">
            <h4 style="color: #dc3545; margin-bottom: 10px;">Reason:</h4>
            <p style="color: #fff; margin-bottom: 0;">
                {{ $payment->failure_reason }}
            </p>
        </div>
        @else
        <div class="error-details">
            <h4 style="color: #dc3545; margin-bottom: 10px;">Reason:</h4>
            <p style="color: #fff; margin-bottom: 0;">
                You closed the payment window or the transaction was cancelled.
            </p>
        </div>
        @endif
        
        <div style="margin-top: 30px;">
            <a href="{{ route('razorpay.donation.form') }}" class="btn-retry">
                <i class="fas fa-redo-alt"></i> Try Again
            </a>
            <a href="{{ route('home') }}" class="btn-home">
                <i class="fas fa-home"></i> Back to Home
            </a>
        </div>
    </div>
</section>
@endsection