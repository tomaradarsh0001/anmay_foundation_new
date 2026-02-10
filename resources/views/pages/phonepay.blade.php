@extends('layouts.app')

@section('title', 'Make Donation - Anmay Foundation')

@section('content')

<style>
    body { background-color: #001D23 !important; color: #fff; }
    .donation-section { padding: 100px 20px; min-height: 100vh; display: flex; align-items: center; background: linear-gradient(rgba(0,29,35,0.9), rgba(0,29,35,0.9)), url('{{ asset("assets/img/carousel-2.jpg") }}'); background-size: cover; background-position: center; background-attachment: fixed; }
    .donation-container { max-width: 600px; margin: 0 auto; background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border-radius: 20px; padding: 40px; box-shadow: 0 15px 35px rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.1); }
    .donation-header { text-align: center; margin-bottom: 40px; }
    .donation-header h1 { font-size: 2.5rem; margin-bottom: 10px; background: linear-gradient(45deg, #00b09b, #96c93d); -webkit-background-clip: text; background-clip: text; color: transparent; font-weight: 700; }
    .donation-header p { color: #aaa; font-size: 1.1rem; }
    .donation-form .form-group { margin-bottom: 25px; }
    .donation-form label { display: block; margin-bottom: 8px; color: #fff; font-weight: 500; font-size: 1rem; }
    .donation-form .form-control { width: 100%; padding: 15px 20px; background: rgba(255,255,255,0.08); border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; color: #fff; font-size: 1rem; transition: all 0.3s ease; }
    .donation-form .form-control:focus { outline: none; border-color: #00b09b; background: rgba(255,255,255,0.12); box-shadow: 0 0 0 3px rgba(0,176,155,0.2); }
    .amount-options { display: grid; grid-template-columns: repeat(auto-fill,minmax(100px,1fr)); gap: 12px; margin-top: 10px; }
    .amount-btn { padding: 12px; background: rgba(255,255,255,0.08); border: 2px solid rgba(255,255,255,0.1); border-radius: 8px; color: #fff; font-weight: 600; cursor: pointer; text-align: center; transition: all 0.3s ease; }
    .amount-btn.active { background: linear-gradient(45deg,#00b09b,#96c93d); border-color: transparent; transform: scale(1.05); box-shadow: 0 5px 15px rgba(0,176,155,0.3); }
    .btn-phonepe { background: linear-gradient(135deg,#5f259f 0%,#7a3bb8 100%); border: none; color: white; padding: 12px 20px; border-radius: 8px; font-weight: 600; transition: all 0.3s ease; width: 100%; margin-top: 15px; display: flex; align-items: center; justify-content: center; gap: 10px; cursor: pointer; }
    .btn-phonepe:hover { background: linear-gradient(135deg,#4a1d7a 0%,#632a99 100%); transform: translateY(-2px); box-shadow: 0 5px 15px rgba(95,37,159,0.3); color: white; }
    .btn-phonepe:disabled { opacity: 0.6; cursor: not-allowed; }
    .phonepe-icon { width: 30px; height: 30px; background: white; border-radius: 6px; display: flex; align-items: center; justify-content: center; padding: 5px; }
    .phonepe-icon img { width: 100%; height: auto; }
    .donation-success { display: none; text-align: center; padding: 30px; }
    .donation-success i { font-size: 4rem; color: #00b09b; margin-bottom: 20px; }
    .btn-home { display: inline-block; padding: 12px 30px; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); border-radius: 8px; color: #fff; text-decoration: none; transition: all 0.3s ease; }
    .btn-home:hover { background: rgba(255,255,255,0.2); transform: translateY(-3px); }
    .alert { padding: 15px; border-radius: 8px; margin-bottom: 20px; }
    .alert-danger { background: rgba(220,53,69,0.2); border: 1px solid rgba(220,53,69,0.3); color: #f8d7da; }
    .alert-success { background: rgba(25,135,84,0.2); border: 1px solid rgba(25,135,84,0.3); color: #d1e7dd; }
</style>

<section class="donation-section mt-5">
    <div class="donation-container">
        <div class="donation-header">
            <h1>Make a Donation</h1>
            <p>Your contribution makes a difference. Every rupee counts.</p>
        </div>

        <div id="errorAlert" class="alert alert-danger" style="display: none;"></div>
        <div id="successAlert" class="alert alert-success" style="display: none;"></div>

        <form id="donationForm" class="donation-form">
            @csrf
            <div class="form-group">
                <label for="fullName">Full Name *</label>
                <input type="text" id="fullName" name="fullName" class="form-control" placeholder="Enter your full name" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address *</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number *</label>
                <input type="tel" id="phone" name="phone" class="form-control" placeholder="Enter your 10-digit phone number" required pattern="[0-9]{10}">
            </div>

            <div class="form-group">
                <label for="amount">Donation Amount (₹) *</label>
                <input type="number" id="amount" name="amount" class="form-control" placeholder="Enter amount in INR" min="1" required>
                <div class="amount-options">
                    <div class="amount-btn" data-amount="100">₹100</div>
                    <div class="amount-btn" data-amount="500">₹500</div>
                    <div class="amount-btn" data-amount="1000">₹1,000</div>
                    <div class="amount-btn" data-amount="2000">₹2,000</div>
                    <div class="amount-btn" data-amount="5000">₹5,000</div>
                    <div class="amount-btn" data-amount="10000">₹10,000</div>
                </div>
            </div>

            <button type="submit" class="btn-phonepe" id="payNowBtn">
                <div class="phonepe-icon">
                    <img src="{{ asset('assets/img/phonepay.png') }}" alt="PhonePe">
                </div>
                <span>Pay Now with PhonePe</span>
                <i class="fas fa-arrow-right"></i>
            </button>
        </form>

        <!-- Donation Success -->
        <div id="donationSuccess" class="donation-success">
            <i class="fas fa-check-circle"></i>
            <h3>Thank You for Your Donation!</h3>
            <p>Your contribution of ₹<span id="donatedAmount">0</span> has been received successfully.</p>
            <p>A confirmation email has been sent to your registered email address.</p>
            <a href="{{ route('home') }}" class="btn-home">Return to Homepage</a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('donationForm');
    const payNowBtn = document.getElementById('payNowBtn');
    const amountInput = document.getElementById('amount');
    const amountButtons = document.querySelectorAll('.amount-btn');
    const errorAlert = document.getElementById('errorAlert');
    const successAlert = document.getElementById('successAlert');

    // Amount button selection
    amountButtons.forEach(button => {
        button.addEventListener('click', function() {
            amountButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            amountInput.value = this.getAttribute('data-amount');
        });
    });

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        e.stopPropagation();

        // Hide alerts
        errorAlert.style.display = 'none';
        successAlert.style.display = 'none';

        // Basic validation
        if (!form.checkValidity()) {
            showError('Please fill all required fields correctly.');
            return;
        }

        const phone = document.getElementById('phone').value;
        if (phone.length !== 10 || !/^\d+$/.test(phone)) {
            showError('Please enter a valid 10-digit phone number.');
            return;
        }

        const amount = document.getElementById('amount').value;
        if (amount < 1) {
            showError('Please enter a valid amount (minimum ₹1).');
            return;
        }

        // Prepare form data
        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('fullName', document.getElementById('fullName').value);
        formData.append('email', document.getElementById('email').value);
        formData.append('phone', phone);
        formData.append('amount', amount);

        // Disable button and show loading
        payNowBtn.disabled = true;
        const originalText = payNowBtn.innerHTML;
        payNowBtn.innerHTML = `
            <div class="phonepe-icon">
                <img src="{{ asset('assets/img/phonepay.png') }}" alt="PhonePe">
            </div>
            <span>Processing...</span>
            <i class="fas fa-spinner fa-spin"></i>
        `;

        try {
            const response = await fetch('{{ route("initiate-payment") }}', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            
            if (result.success && result.paymentUrl) {
                // Success - redirect to PhonePe
                showSuccess('Redirecting to PhonePe...');
                setTimeout(() => {
                    window.location.href = result.paymentUrl;
                }, 1000);
            } else {
                // Show error
                showError(result.message || 'Payment initiation failed.');
                payNowBtn.disabled = false;
                payNowBtn.innerHTML = originalText;
            }
        } catch (error) {
            console.error('Error:', error);
            showError('Network error. Please try again.');
            payNowBtn.disabled = false;
            payNowBtn.innerHTML = originalText;
        }
    });

    function showError(message) {
        errorAlert.textContent = message;
        errorAlert.style.display = 'block';
    }

    function showSuccess(message) {
        successAlert.textContent = message;
        successAlert.style.display = 'block';
    }
});
</script>

@endsection