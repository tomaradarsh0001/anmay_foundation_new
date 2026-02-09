@extends('layouts.app')

@section('title', 'Donate - Anmay Foundation')

@section('content')

<style>
    body{
        background-color: #001D23 !important;
    }

    .mts{
        padding: 200px !important;
    }

    /* Inline three column layout */
    .three-column-layout {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 40px;
        width: 100%;
    }

    .column {
        flex: 1;
        min-width: 0; /* Important for flexbox text truncation */
    }

    .images-column {
        display: flex;
        flex-direction: column;
        gap: 20px;
        align-items: center;
    }

    .images-column img{
        width: 100%;
        max-width: 280px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.4);
        transition: transform 0.3s ease;
    }

    .images-column img:hover{
        transform: scale(1.05);
    }

    .form-column {
        display: flex;
        flex-direction: column;
    }

    .text-column {
        display: flex;
        flex-direction: column;
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

    .donation-form {
        background: rgba(255, 255, 255, 0.05);
        padding: 25px;
        border-radius: 12px;
        backdrop-filter: blur(10px);
        height: 100%;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: grey !important;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.6) !important;
    }

    .form-label {
        color: white !important;
        font-weight: 500;
    }

    /* Submit Button Style */
    .btn-submit-donation {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 10px;
    }

    .btn-submit-donation:hover {
        background: linear-gradient(135deg, #218838 0%, #199d76 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
    }

    .btn-submit-donation:active {
        transform: translateY(0);
    }

    /* PhonePe Button Style */
    .btn-phonepe {
        background: linear-gradient(135deg, #5f259f 0%, #7a3bb8 100%);
        border: none;
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 15px;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-phonepe:hover {
        background: linear-gradient(135deg, #4a1d7a 0%, #632a99 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(95, 37, 159, 0.3);
        color: white;
    }

    .btn-phonepe:active {
        transform: translateY(0);
    }

    .btn-phonepe img {
        width: 24px;
        height: 24px;
    }

    .success-message {
        display: none;
        background: #28a745;
        color: white;
        padding: 15px;
        border-radius: 8px;
        margin-top: 20px;
        text-align: center;
    }

    .file-upload-container {
        position: relative;
        overflow: hidden;
        margin-top: 10px;
    }

    .file-upload-label {
        display: block;
        padding: 12px;
        background: rgba(255, 255, 255, 0.1);
        border: 2px dashed rgba(255, 255, 255, 0.3);
        border-radius: 8px;
        text-align: center;
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .file-upload-label:hover {
        background: rgba(255, 255, 255, 0.15);
        border-color: #5f259f;
    }

    .file-upload-input {
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .preview-image {
        max-width: 200px;
        margin-top: 10px;
        border-radius: 8px;
        display: none;
    }

    .button-group {
        margin-top: 20px;
    }

    /* Responsive styles */
    @media(max-width: 1200px){
        .three-column-layout {
            gap: 30px;
        }
    }

    @media(max-width: 992px){
        .mts{
            padding: 150px 20px !important;
        }

        .three-column-layout {
            flex-direction: column;
            gap: 40px;
        }

        .column {
            width: 100%;
        }

        .images-column {
            flex-direction: row;
            justify-content: center;
            gap: 30px;
        }

        .images-column img {
            max-width: 300px;
        }
    }

    @media(max-width: 768px){
        .mts{
            padding: 100px 20px !important;
        }

        .images-column {
            flex-direction: column;
            gap: 20px;
        }

        .images-column img {
            max-width: 100%;
        }
        
        .btn-submit-donation,
        .btn-phonepe {
            padding: 14px 20px;
            font-size: 16px;
        }
    }

    @media(max-width: 576px){
        .donation-form {
            padding: 20px;
        }
        
        .kalam-content h2 {
            font-size: 1.8rem;
        }
        
        .kalam-content h6 {
            font-size: 1rem;
        }
    }
</style>

<!-- Donation Section Start -->
<div class="container-fluid donate mts" data-parallax="scroll" data-image-src="{{ asset('assets/img/carousel-2.jpg') }}">
    <div class="row">
        <div class="col-12">
            <div class="three-column-layout wow fadeInUp">
                
                <!-- Left Column: Images -->
                <div class="column images-column wow fadeInLeft" data-wow-delay="0.1s">
                    <img src="{{ asset('assets/img/payment1.jpg') }}" alt="Payment QR Code 1">
                    <img src="{{ asset('assets/img/payment2.jpg') }}" alt="Payment QR Code 2">
                </div>
                
                <!-- Middle Column: Form -->
                <div class="column form-column wow fadeInUp" data-wow-delay="0.2s">
                    <div class="donation-form">
                        <form id="donationForm" enctype="multipart/form-data">
                            @csrf
                            
                            <h4 class="text-white mb-4">Submit Donation Details</h4>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Name (Optional)</label>
                                    <input type="text" name="name" class="form-control" placeholder="Your name">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email (Optional)</label>
                                    <input type="email" name="email" class="form-control" placeholder="Your email">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Phone (Optional)</label>
                                <input type="text" name="phone" class="form-control" placeholder="Your phone number">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Amount Donated (₹)</label>
                                <input type="number" name="amount" class="form-control" placeholder="Enter amount" required min="1">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">UTR Number *</label>
                                <input type="text" name="utr_number" class="form-control" placeholder="Enter UTR/Transaction ID" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Payment Screenshot *</label>
                                <div class="file-upload-container">
                                    <label class="file-upload-label">
                                        <i class="fas fa-cloud-upload-alt me-2"></i>
                                        Click to upload screenshot
                                        <input type="file" name="screenshot" class="file-upload-input" accept="image/*" required>
                                    </label>
                                </div>
                                <img id="previewImage" class="preview-image" alt="Preview">
                            </div>
                            
                            <div class="button-group">
                                <!-- Submit Button -->
                                <button type="submit" class="btn-submit-donation" id="submitBtn">
                                    <i class="fas fa-paper-plane me-2"></i>Submit Donation Details
                                </button>
                                
                                <!-- PhonePe Button -->
                                <a href="{{route('make-donation')}}" target="_blank" class="btn-phonepe">
                                    <img src="{{ asset('assets/img/phonepay.png') }}" alt="PhonePe">
                                    Pay using PhonePe
                                </a>
                            </div>
                        </form>
                        
                        <div class="success-message" id="successMessage">
                            <i class="fas fa-check-circle me-2"></i>
                            Thank you! Your donation details have been submitted successfully.
                        </div>
                    </div>
                </div>
                
                <!-- Right Column: Text Content -->
                <div class="column text-column wow fadeInRight" data-wow-delay="0.3s">
                    <div class="kalam-content position-relative">
                        <h2 class="fw-bold">Donate for a Better Tomorrow</h2>
                        <h6 class="mb-4">Anmay Foundation</h6>

                        <p class="kalam-paragraph">
                            Every contribution you make becomes hope for someone in need.
                            Your support enables Anmay Foundation to bring education, dignity,
                            and opportunity to countless lives.
                        </p>

                        <p class="kalam-paragraph">
                            Your donation helps us:
                        </p>
                        
                        <ul class="text-white mb-4" style="line-height: 1.8;">
                            <li>Provide quality education to underprivileged children</li>
                            <li>Support healthcare initiatives in rural areas</li>
                            <li>Empower women through skill development programs</li>
                            <li>Create sustainable livelihood opportunities</li>
                            <li>Support environmental conservation projects</li>
                        </ul>

                        <div class="kalam-quote">
                            <div class="quote-author">
                                "True wealth is measured by how many lives we uplift."
                                <br>— Anmay Foundation
                            </div>
                        </div>
                        
                     
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<!-- Donation Section End -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image preview
    const fileInput = document.querySelector('input[name="screenshot"]');
    const previewImage = document.getElementById('previewImage');
    
    fileInput.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            const file = e.target.files[0];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
            }
            
            reader.readAsDataURL(file);
        }
    });
    
    // Form submission
    const donationForm = document.getElementById('donationForm');
    const successMessage = document.getElementById('successMessage');
    const submitBtn = document.getElementById('submitBtn');
    
    donationForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validate required fields
        const amount = document.querySelector('input[name="amount"]').value;
        const utr = document.querySelector('input[name="utr_number"]').value;
        const screenshot = document.querySelector('input[name="screenshot"]').files[0];
        
        if (!amount || amount <= 0) {
            alert('Please enter a valid donation amount.');
            return;
        }
        
        if (!utr.trim()) {
            alert('Please enter your UTR/Transaction ID.');
            return;
        }
        
        if (!screenshot) {
            alert('Please upload a payment screenshot.');
            return;
        }
        
        const formData = new FormData(this);
        
        // Disable submit button
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Submitting...';
        
        // AJAX submission
        fetch('{{ route("donations.submit") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                successMessage.style.display = 'block';
                donationForm.reset();
                previewImage.style.display = 'none';
                
                // Scroll to success message
                successMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
                
                // Reset form after 5 seconds
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 5000);
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        })
        .finally(() => {
            // Re-enable submit button
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Submit Donation Details';
        });
    });
});
</script>

@endsection