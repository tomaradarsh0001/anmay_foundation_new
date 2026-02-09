@extends('layouts.app')

@section('title', 'Make Donation - Anmay Foundation')

@section('content')

<style>
    body {
        background-color: #001D23 !important;
        color: #fff;
    }

    .donation-section {
        padding: 100px 20px;
        min-height: 100vh;
        display: flex;
        align-items: center;
        background: linear-gradient(rgba(0, 29, 35, 0.9), rgba(0, 29, 35, 0.9)), 
                    url('{{ asset("assets/img/carousel-2.jpg") }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    .donation-container {
        max-width: 600px;
        margin: 0 auto;
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.1);
        animation: fadeInUp 0.8s ease-out;
    }

    .donation-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .donation-header h1 {
        font-size: 2.5rem;
        margin-bottom: 10px;
        background: linear-gradient(45deg, #00b09b, #96c93d);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        font-weight: 700;
    }

    .donation-header p {
        color: #aaa;
        font-size: 1.1rem;
    }

    .donation-form .form-group {
        margin-bottom: 25px;
    }

    .donation-form label {
        display: block;
        margin-bottom: 8px;
        color: #fff;
        font-weight: 500;
        font-size: 1rem;
    }

    .donation-form .form-control {
        width: 100%;
        padding: 15px 20px;
        background: rgba(255, 255, 255, 0.08);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        color: #fff;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .donation-form .form-control:focus {
        outline: none;
        border-color: #00b09b;
        background: rgba(255, 255, 255, 0.12);
        box-shadow: 0 0 0 3px rgba(0, 176, 155, 0.2);
    }

    .donation-form .form-control::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .amount-options {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 12px;
        margin-top: 10px;
    }

    .amount-btn {
        padding: 12px;
        background: rgba(255, 255, 255, 0.08);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        color: #fff;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
    }

    .amount-btn:hover {
        background: rgba(0, 176, 155, 0.2);
        border-color: #00b09b;
        transform: translateY(-2px);
    }

    .amount-btn.active {
        background: linear-gradient(45deg, #00b09b, #96c93d);
        border-color: transparent;
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0, 176, 155, 0.3);
    }

    .pay-now-btn {
        width: 100%;
        padding: 18px;
        background: linear-gradient(45deg, #00b09b, #96c93d);
        border: none;
        border-radius: 12px;
        color: white;
        font-size: 1.2rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        box-shadow: 0 10px 20px rgba(0, 176, 155, 0.3);
        position: relative;
        overflow: hidden;
    }

    .pay-now-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 25px rgba(0, 176, 155, 0.4);
    }

    .pay-now-btn:active {
        transform: translateY(-2px);
    }

    .pay-now-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .pay-now-btn i {
        font-size: 1.4rem;
    }

    .phonepe-icon {
        width: 30px;
        height: 30px;
        background: white;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px;
    }

    .phonepe-icon img {
        width: 100%;
        height: auto;
    }

    .payment-methods {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .payment-methods p {
        color: #aaa;
        margin: 0;
    }

    .payment-icons {
        display: flex;
        gap: 15px;
    }

    .payment-icon {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 8px;
        transition: all 0.3s ease;
    }

    .payment-icon:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-3px);
    }

    .payment-icon img {
        width: 100%;
        height: auto;
        filter: brightness(0) invert(1);
    }

    .security-note {
        text-align: center;
        margin-top: 25px;
        color: #aaa;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .security-note i {
        color: #00b09b;
    }

    .donation-success {
        display: none;
        text-align: center;
        padding: 30px;
    }

    .donation-success i {
        font-size: 4rem;
        color: #00b09b;
        margin-bottom: 20px;
        animation: successIcon 1s ease-out;
    }

    .donation-success h3 {
        color: #fff;
        margin-bottom: 15px;
        font-size: 1.8rem;
    }

    .donation-success p {
        color: #aaa;
        margin-bottom: 25px;
    }

    .btn-home {
        display: inline-block;
        padding: 12px 30px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        color: #fff;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-home:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-3px);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes successIcon {
        0% {
            transform: scale(0);
            opacity: 0;
        }
        50% {
            transform: scale(1.2);
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes buttonRipple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: buttonRipple 0.6s linear;
        pointer-events: none;
    }

    @media (max-width: 768px) {
        .donation-section {
            padding: 60px 15px;
        }
        
        .donation-container {
            padding: 30px 20px;
        }
        
        .donation-header h1 {
            font-size: 2rem;
        }
        
        .amount-options {
            grid-template-columns: repeat(3, 1fr);
        }
        
        .payment-methods {
            flex-direction: column;
            gap: 15px;
        }
    }
</style>

<!-- Donation Form Start -->
<section class="donation-section">
    <div class="donation-container">
        <div class="donation-header">
            <h1>Make a Donation</h1>
            <p>Your contribution makes a difference. Every rupee counts.</p>
        </div>

        <form id="donationForm" class="donation-form">
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

            <button type="submit" class="pay-now-btn" id="payNowBtn">
                <div class="phonepe-icon">
                    <img src="{{ asset('assets/img/phonepay.png') }}" alt="PhonePe">
                </div>
                <span>Pay Now with PhonePe</span>
                <i class="fas fa-arrow-right"></i>
            </button>

            <div class="security-note">
                <i class="fas fa-lock"></i>
                <span>Your payment is secured with 256-bit SSL encryption</span>
            </div>

            <div class="payment-methods">
                <p>We also accept:</p>
                <div class="payment-icons">
                    <div class="payment-icon">
                        <img src="https://img.icons8.com/color/48/000000/google-pay.png" alt="Google Pay">
                    </div>
                    <div class="payment-icon">
                        <img src="https://img.icons8.com/color/48/000000/paytm.png" alt="Paytm">
                    </div>
                    <div class="payment-icon">
                        <img src="https://img.icons8.com/color/48/000000/visa.png" alt="Visa">
                    </div>
                </div>
            </div>
        </form>

        <div id="donationSuccess" class="donation-success">
            <i class="fas fa-check-circle"></i>
            <h3>Thank You for Your Donation!</h3>
            <p>Your contribution of ₹<span id="donatedAmount">0</span> has been received successfully.</p>
            <p>A confirmation email has been sent to your registered email address.</p>
            <a href="{{ route('home') }}" class="btn-home">Return to Homepage</a>
        </div>
    </div>
</section>
<!-- Donation Form End -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('donationForm');
        const payNowBtn = document.getElementById('payNowBtn');
        const amountInput = document.getElementById('amount');
        const amountButtons = document.querySelectorAll('.amount-btn');
        const donationSuccess = document.getElementById('donationSuccess');
        const donatedAmountSpan = document.getElementById('donatedAmount');

        // Amount button selection
        amountButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                amountButtons.forEach(btn => btn.classList.remove('active'));
                
                // Add active class to clicked button
                this.classList.add('active');
                
                // Set the amount input value
                amountInput.value = this.getAttribute('data-amount');
            });
        });

        // Ripple effect for pay button
        payNowBtn.addEventListener('click', function(e) {
            if (this.disabled) return;
            
            // Create ripple effect
            const rect = this.getBoundingClientRect();
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            ripple.style.width = ripple.style.height = Math.max(rect.width, rect.height) + 'px';
            ripple.style.left = (e.clientX - rect.left - Math.max(rect.width, rect.height) / 2) + 'px';
            ripple.style.top = (e.clientY - rect.top - Math.max(rect.width, rect.height) / 2) + 'px';
            
            this.appendChild(ripple);
            
            // Remove ripple after animation
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });

        // Form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate form
            if (!form.checkValidity()) {
                // Add validation styling
                const invalidFields = form.querySelectorAll(':invalid');
                invalidFields.forEach(field => {
                    field.style.borderColor = '#ff4757';
                    setTimeout(() => {
                        field.style.borderColor = '';
                    }, 3000);
                });
                return;
            }
            
            // Get form data
            const formData = {
                fullName: document.getElementById('fullName').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                amount: document.getElementById('amount').value
            };
            
            // Disable button and show loading
            payNowBtn.disabled = true;
            payNowBtn.innerHTML = `
                <div class="phonepe-icon">
                    <img src="{{ asset('assets/img/phonepay.png') }}" alt="PhonePe">
                </div>
                <span>Processing...</span>
                <i class="fas fa-spinner fa-spin"></i>
            `;
            
            // Simulate payment processing (in real implementation, integrate with PhonePe API)
            setTimeout(() => {
                // Show success message
                form.style.display = 'none';
                donatedAmountSpan.textContent = formData.amount;
                donationSuccess.style.display = 'block';
                
                // In real implementation, redirect to PhonePe payment gateway
                // window.location.href = '{{ route("phonepe.payment") }}?amount=' + formData.amount;
                
                // Send data to server (you would typically do this via AJAX)
                fetch('{{ route("process-donation") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Donation processed:', data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
                
            }, 2000);
        });

        // Input validation styling
        const inputs = form.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.checkValidity()) {
                    this.style.borderColor = '#00b09b';
                } else {
                    this.style.borderColor = '#ff4757';
                }
            });
            
            input.addEventListener('blur', function() {
                this.style.borderColor = '';
            });
        });

        // Auto-format phone number
        const phoneInput = document.getElementById('phone');
        phoneInput.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, '');
            if (value.length > 10) value = value.substring(0, 10);
            this.value = value;
        });
    });
</script>

@endsection