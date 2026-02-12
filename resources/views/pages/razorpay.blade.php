{{-- resources/views/pages/razorpay-donation.blade.php --}}
@extends('layouts.app')

@section('title', 'Make Donation with Razorpay - Anmay Foundation')

@section('content')
<style>
    body { background-color: #001D23 !important; color: #fff; }
    .razorpay-section { padding: 100px 20px; min-height: 100vh; display: flex; align-items: center; background: linear-gradient(rgba(0,29,35,0.9), rgba(0,29,35,0.9)), url('{{ asset("assets/img/carousel-2.jpg") }}'); background-size: cover; background-position: center; background-attachment: fixed; }
    .razorpay-container { max-width: 600px; margin: 0 auto; background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border-radius: 20px; padding: 40px; box-shadow: 0 15px 35px rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.1); }
    .razorpay-header { text-align: center; margin-bottom: 40px; }
    .razorpay-header h1 { font-size: 2.5rem; margin-bottom: 10px; background: linear-gradient(45deg, #00b09b, #96c93d); -webkit-background-clip: text; background-clip: text; color: transparent; font-weight: 700; }
    .razorpay-header p { color: #aaa; font-size: 1.1rem; }
    .razorpay-form .form-group { margin-bottom: 25px; }
    .razorpay-form label { display: block; margin-bottom: 8px; color: #fff; font-weight: 500; font-size: 1rem; }
    .razorpay-form .form-control { width: 100%; padding: 15px 20px; background: rgba(255,255,255,0.08); border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; color: #fff; font-size: 1rem; transition: all 0.3s ease; }
    .razorpay-form .form-control:focus { outline: none; border-color: #00b09b; background: rgba(255,255,255,0.12); box-shadow: 0 0 0 3px rgba(0,176,155,0.2); }
    .razorpay-form .form-control::placeholder { color: rgba(255,255,255,0.5); }
    .razorpay-amount-options { display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 12px; margin-top: 10px; }
    .razorpay-amount-btn { padding: 12px; background: rgba(255,255,255,0.08); border: 2px solid rgba(255,255,255,0.1); border-radius: 8px; color: #fff; font-weight: 600; cursor: pointer; text-align: center; transition: all 0.3s ease; }
    .razorpay-amount-btn:hover { background: rgba(0,176,155,0.2); border-color: #00b09b; }
    .razorpay-amount-btn.active { background: linear-gradient(45deg, #00b09b, #96c93d); border-color: transparent; transform: scale(1.05); box-shadow: 0 5px 15px rgba(0,176,155,0.3); }
    .btn-razorpay { background: linear-gradient(135deg, #0C5ADB 0%, #2A6EF5 100%); border: none; color: white; padding: 10px 20px; border-radius: 12px; font-weight: 600; transition: all 0.3s ease; width: 100%; margin-top: 20px; display: flex; align-items: center; justify-content: center; gap: 10px; cursor: pointer; border: none; font-size: 1.1rem; }
    .btn-razorpay:hover { background: linear-gradient(135deg, #083E9E 0%, #0C5ADB 100%); transform: translateY(-2px); box-shadow: 0 5px 15px rgba(12,90,219,0.3); color: white; }
    .btn-razorpay:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }
    .razorpay-icon { width: 30px; height: 30px; background: white; border-radius: 6px; display: flex; align-items: center; justify-content: center; }
    .razorpay-icon img { width: 100%; height: auto; }
    .alert { padding: 15px 20px; border-radius: 12px; margin-bottom: 20px; display: none; }
    .alert-danger { background: rgba(220,53,69,0.2); border: 1px solid rgba(220,53,69,0.3); color: #f8d7da; }
    .alert-success { background: rgba(25,135,84,0.2); border: 1px solid rgba(25,135,84,0.3); color: #d1e7dd; }
</style>

<section class="razorpay-section">
    <div class="razorpay-container">
        <div class="razorpay-header">
            <h1>Make a Donation</h1>
            <p>Your contribution makes a difference. Every rupee counts.</p>
            <div style="margin-top: 15px;">
                <span style="background: rgba(255,255,255,0.1); padding: 8px 20px; border-radius: 50px; font-size: 0.9rem;">
                    <i class="fas fa-shield-alt" style="color: #00b09b; margin-right: 5px;"></i>
                    Secure payments by Razorpay
                </span>
            </div>
        </div>

        <div id="errorAlert" class="alert alert-danger"></div>
        <div id="successAlert" class="alert alert-success"></div>

        <form id="donationForm" class="razorpay-form">
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
                <input type="tel" id="phone" name="phone" class="form-control" placeholder="Enter 10-digit phone number" required pattern="[0-9]{10}" maxlength="10">
            </div>

            <div class="form-group">
                <label for="amount">Donation Amount (₹) *</label>
                <input type="number" id="amount" name="amount" class="form-control" placeholder="Enter amount" min="1" step="1" required>
                <div class="razorpay-amount-options" style="margin-top: 15px;">
                    <div class="razorpay-amount-btn" data-amount="100">₹100</div>
                    <div class="razorpay-amount-btn" data-amount="500">₹500</div>
                    <div class="razorpay-amount-btn" data-amount="1000">₹1,000</div>
                    <div class="razorpay-amount-btn" data-amount="2000">₹2,000</div>
                    <div class="razorpay-amount-btn" data-amount="5000">₹5,000</div>
                    <div class="razorpay-amount-btn" data-amount="2000">₹10,000</div>
                    <div class="razorpay-amount-btn" data-amount="5000">₹20,000</div>
                    <div class="razorpay-amount-btn" data-amount="5000">₹50,000</div>
                </div>
            </div>

            <button type="submit" id="payButton" class="btn-razorpay">
                <div class="razorpay-icon">
                    <img src="https://razorpay.com/assets/razorpay-glyph.svg" alt="Razorpay">
                </div>
                <span>Pay with Razorpay</span>
                <i class="fas fa-arrow-right"></i>
            </button>
        </form>
    </div>
</section>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('donationForm');
    const payButton = document.getElementById('payButton');
    const errorAlert = document.getElementById('errorAlert');
    const amountInput = document.getElementById('amount');
    const amountBtns = document.querySelectorAll('.razorpay-amount-btn');

    // Amount button click handler
    amountBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            amountBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            amountInput.value = this.dataset.amount;
        });
    });

    function showError(message) {
        errorAlert.textContent = message;
        errorAlert.style.display = 'block';
        errorAlert.classList.add('alert-danger');
        setTimeout(() => {
            errorAlert.style.display = 'none';
        }, 5000);
    }

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Validation
        const name = document.getElementById('fullName').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const amount = amountInput.value.trim();

        if (!name || !email || !phone || !amount) {
            showError('Please fill in all fields');
            return;
        }

        if (phone.length !== 10 || !/^\d+$/.test(phone)) {
            showError('Please enter a valid 10-digit phone number');
            return;
        }

        if (amount < 1) {
            showError('Please enter a valid amount (minimum ₹1)');
            return;
        }

        // Disable button
        payButton.disabled = true;
        payButton.innerHTML = `
            <div class="razorpay-icon">
                <img src="https://razorpay.com/assets/razorpay-glyph.svg" alt="Razorpay">
            </div>
            <span>Processing...</span>
            <i class="fas fa-spinner fa-spin"></i>
        `;

        try {
            // Initiate payment
            const response = await fetch('{{ route("razorpay.initiate") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    fullName: name,
                    email: email,
                    phone: phone,
                    amount: amount
                })
            });

            const data = await response.json();

            if (data.success) {
                // Razorpay options
                const options = {
                    key: data.razorpay_key,
                    amount: data.amount,
                    currency: data.currency,
                    name: 'Anmay Foundation',
                    description: 'Donation - ' + data.merchant_order_id,
                    order_id: data.razorpay_order_id,
                    prefill: {
                        name: data.customer_details.name,
                        email: data.customer_details.email,
                        contact: data.customer_details.contact
                    },
                    theme: {
                        color: data.theme.color
                    },
                    handler: function(response) {
                        // Verify payment
                        verifyPayment(response);
                    },
                    // In your razorpay-donation.blade.php, update the modal.ondismiss handler:

modal: {
    ondismiss: function() {
        // Redirect to failed page with order_id
        const orderId = data.razorpay_order_id;
        if (orderId) {
            window.location.href = '{{ route("razorpay.failed") }}?razorpay_order_id=' + orderId;
        } else {
            // Fallback if no order_id
            window.location.href = '{{ route("razorpay.failed") }}';
        }
    }
}
                };

                const razorpay = new Razorpay(options);
                razorpay.open();
            } else {
                showError(data.message || 'Payment initiation failed');
                payButton.disabled = false;
                payButton.innerHTML = `
                    <div class="razorpay-icon">
                        <img src="https://razorpay.com/assets/razorpay-glyph.svg" alt="Razorpay">
                    </div>
                    <span>Pay with Razorpay</span>
                    <i class="fas fa-arrow-right"></i>
                `;
            }
        } catch (error) {
            console.error('Error:', error);
            showError('Network error. Please try again.');
            payButton.disabled = false;
            payButton.innerHTML = `
                <div class="razorpay-icon">
                    <img src="https://razorpay.com/assets/razorpay-glyph.svg" alt="Razorpay">
                </div>
                <span>Pay with Razorpay</span>
                <i class="fas fa-arrow-right"></i>
            `;
        }
    });

    function verifyPayment(response) {
        fetch('{{ route("razorpay.verify") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                razorpay_order_id: response.razorpay_order_id,
                razorpay_payment_id: response.razorpay_payment_id,
                razorpay_signature: response.razorpay_signature
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                // Redirect to success page
                window.location.href = '{{ route("razorpay.success") }}?razorpay_payment_id=' + data.razorpay_payment_id + '&merchant_order_id=' + data.merchant_order_id;
            } else {
                showError('Payment verification failed. Please contact support.');
                payButton.disabled = false;
                payButton.innerHTML = `
                    <div class="razorpay-icon">
                        <img src="https://razorpay.com/assets/razorpay-glyph.svg" alt="Razorpay">
                    </div>
                    <span>Pay with Razorpay</span>
                    <i class="fas fa-arrow-right"></i>
                `;
            }
        })
        .catch(error => {
            console.error('Verification error:', error);
            showError('Payment verification failed. Please contact support.');
            payButton.disabled = false;
            payButton.innerHTML = `
                <div class="razorpay-icon">
                    <img src="https://razorpay.com/assets/razorpay-glyph.svg" alt="Razorpay">
                </div>
                <span>Pay with Razorpay</span>
                <i class="fas fa-arrow-right"></i>
            `;
        });
    }
});
</script>
@endsection