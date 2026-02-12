{{-- resources/views/pages/razorpay-success.blade.php --}}
@extends('layouts.app')

@section('title', 'Donation Successful - Anmay Foundation')

@section('content')
<style>
    .success-section { background-color: #001D23; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 50px 20px; }
    .success-card { max-width: 600px; margin: 0 auto; background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border-radius: 20px; padding: 40px; box-shadow: 0 15px 35px rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.1); text-align: center; }
    .success-icon { font-size: 80px; margin-bottom: 20px; }
    .success-title { font-size: 2rem; margin-bottom: 20px; color: #fff; }
    .success-message { color: #aaa; margin-bottom: 30px; line-height: 1.6; }
    .payment-details { background: rgba(0,176,155,0.1); border-radius: 12px; padding: 20px; margin-bottom: 30px; border: 1px solid rgba(0,176,155,0.3); }
    .detail-row { display: flex; justify-content: space-between; margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid rgba(255,255,255,0.1); }
    .detail-row:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
    .detail-label { color: #aaa; font-weight: 500; }
    .detail-value { color: #fff; font-weight: 600; }
    .btn-home { background: linear-gradient(45deg, #00b09b, #96c93d); border: none; color: white; padding: 12px 30px; border-radius: 8px; font-weight: 600; transition: all 0.3s ease; text-decoration: none; display: inline-block; }
    .btn-home:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,176,155,0.3); color: white; }
    .status-paid { color: #00b09b; }
    .status-pending { color: #ffc107; }
</style>

<section class="success-section">
    <div class="success-card">
        @if($payment && $payment->isPaid())
            <div class="success-icon" style="color: #00b09b;">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1 class="success-title">Thank You!</h1>
            <p class="success-message">Your donation has been received successfully.</p>
            
            <div class="payment-details">
                <div class="detail-row">
                    <span class="detail-label">Payment ID</span>
                    <span class="detail-value">{{ $payment->razorpay_payment_id }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Order ID</span>
                    <span class="detail-value">{{ $payment->merchant_order_id }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Amount</span>
                    <span class="detail-value">₹{{ number_format($payment->amount, 2) }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Date</span>
                    <span class="detail-value">{{ $payment->updated_at->format('d M Y, h:i A') }}</span>
                </div>
            </div>
            
            <p style="color: #aaa; margin-bottom: 30px;">
                A confirmation email has been sent to <strong>{{ $payment->email }}</strong>
            </p>
            
            <a href="{{ route('home') }}" class="btn-home">
                <i class="fas fa-home"></i> Back to Home
            </a>
        @else
            <div class="success-icon" style="color: #ffc107;">
                <i class="fas fa-clock"></i>
            </div>
            <h1 class="success-title">Payment Processing</h1>
            <p class="success-message">Your payment is being processed. This may take a few moments.</p>
            
            @if($payment)
                <div class="payment-details">
                    <div class="detail-row">
                        <span class="detail-label">Order ID</span>
                        <span class="detail-value">{{ $payment->merchant_order_id }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Amount</span>
                        <span class="detail-value">₹{{ number_format($payment->amount, 2) }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Status</span>
                        <span class="detail-value status-pending">Processing</span>
                    </div>
                </div>
                
                <div id="statusMessage" style="margin-top: 20px; color: #ffc107;">
                    <i class="fas fa-spinner fa-spin"></i> Checking payment status...
                </div>
            @endif
        @endif
    </div>
</section>

@if($payment && !$payment->isPaid())
<script>
document.addEventListener('DOMContentLoaded', function() {
    let attempts = 0;
    const maxAttempts = 30; // Check for 2.5 minutes (30 * 5 seconds)
    
    function checkStatus() {
        fetch('{{ route("razorpay.status", $payment->merchant_order_id) }}')
            .then(response => response.json())
            .then(data => {
                if (data.success && data.is_paid) {
                    document.getElementById('statusMessage').innerHTML = 
                        '<i class="fas fa-check-circle"></i> Payment confirmed! Refreshing page...';
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                } else {
                    attempts++;
                    if (attempts < maxAttempts) {
                        setTimeout(checkStatus, 5000);
                    } else {
                        document.getElementById('statusMessage').innerHTML = 
                            'Payment is taking longer than expected. You will receive an email confirmation shortly.';
                    }
                }
            })
            .catch(() => {
                attempts++;
                if (attempts < maxAttempts) {
                    setTimeout(checkStatus, 5000);
                }
            });
    }
    
    // Start checking after 3 seconds
    setTimeout(checkStatus, 3000);
});
</script>
@endif
@endsection