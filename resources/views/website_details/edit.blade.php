@extends('admin.layouts.app')

@section('title', 'Edit Website Details - Anmay Foundation')

@section('content')
<style>
    .edit-container {
        padding: 30px;
        max-width: 1200px;
        margin: 0 auto;
        animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .page-header {
        text-align: center;
        margin-bottom: 40px;
        animation: fadeInDown 0.8s ease-out;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .page-header h1 {
        font-size: 2.8rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 15px;
    }

    .page-header p {
        color: #666;
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .edit-form-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        animation: fadeInUp 0.8s ease-out 0.2s both;
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

    .form-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 30px 40px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .form-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
        background-size: 50px 50px;
        opacity: 0.2;
        animation: float 20s infinite linear;
    }

    @keyframes float {
        0% { transform: translate(0, 0) rotate(0deg); }
        100% { transform: translate(50px, 50px) rotate(360deg); }
    }

    .form-header-content {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
    }

    .form-header-content h2 {
        font-size: 1.8rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .form-header-content h2 i {
        background: white;
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #667eea;
        font-size: 1.5rem;
    }

    .back-btn {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
        padding: 12px 30px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .back-btn:hover {
        background: white;
        color: #667eea;
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .form-body {
        padding: 40px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }

    .form-group {
        position: relative;
        animation: slideInLeft 0.6s ease-out;
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .form-label {
        display: block;
        color: #333;
        font-weight: 600;
        margin-bottom: 10px;
        font-size: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: color 0.3s ease;
    }

    .form-label i {
        color: #667eea;
        font-size: 1.2rem;
        width: 25px;
    }

    .input-wrapper {
        position: relative;
        transition: all 0.3s ease;
    }

    .form-control {
        width: 100%;
        padding: 15px 20px 15px 55px;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        font-size: 16px;
        transition: all 0.3s ease;
        background: #f8f9fa;
        color: #333;
        font-family: inherit;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15);
        background: white;
        outline: none;
        transform: translateY(-2px);
    }

    .form-control::placeholder {
        color: #aaa;
    }

    .input-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #888;
        font-size: 18px;
        transition: color 0.3s ease;
    }

    .form-control:focus + .input-icon {
        color: #667eea;
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
        padding: 15px 20px;
        line-height: 1.5;
    }

    textarea.form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15);
    }

    .social-section {
        margin-top: 40px;
        padding-top: 40px;
        border-top: 2px dashed #e0e0e0;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .section-title i {
        color: #667eea;
        font-size: 1.8rem;
    }

    .social-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .social-form-group {
        position: relative;
        animation: slideInRight 0.6s ease-out;
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .social-input-wrapper {
        position: relative;
    }

    .social-form-control {
        width: 100%;
        padding: 15px 20px 15px 60px;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        font-size: 16px;
        transition: all 0.3s ease;
        background: #f8f9fa;
        color: #333;
    }

    .social-form-control:focus {
        border-color: var(--social-color);
        box-shadow: 0 0 0 4px rgba(var(--social-color-rgb), 0.15);
        background: white;
        outline: none;
        transform: translateY(-2px);
    }

    .social-input-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
        color: white;
        width: 35px;
        height: 35px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Social Media Colors */
    .instagram .social-input-icon { background: linear-gradient(45deg, #405DE6, #5851DB, #833AB4, #C13584, #E1306C, #FD1D1D); }
    .twitter .social-input-icon { background: #1DA1F2; }
    .facebook .social-input-icon { background: #4267B2; }
    .linkedin .social-input-icon { background: #0077B5; }
    .youtube .social-input-icon { background: #FF0000; }

    .instagram .social-form-control:focus { border-color: #E1306C; --social-color: #E1306C; --social-color-rgb: 225, 48, 108; }
    .twitter .social-form-control:focus { border-color: #1DA1F2; --social-color: #1DA1F2; --social-color-rgb: 29, 161, 242; }
    .facebook .social-form-control:focus { border-color: #4267B2; --social-color: #4267B2; --social-color-rgb: 66, 103, 178; }
    .linkedin .social-form-control:focus { border-color: #0077B5; --social-color: #0077B5; --social-color-rgb: 0, 119, 181; }
    .youtube .social-form-control:focus { border-color: #FF0000; --social-color: #FF0000; --social-color-rgb: 255, 0, 0; }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 40px;
        padding-top: 30px;
        border-top: 2px solid #f0f0f0;
    }

    .btn-submit {
        background: linear-gradient(135deg, #00b09b 0%, #96c93d 100%);
        color: white;
        border: none;
        padding: 16px 40px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        min-width: 180px;
        justify-content: center;
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 176, 155, 0.3);
    }

    .btn-submit:active {
        transform: translateY(-1px);
    }

    .btn-cancel {
        background: #f8f9fa;
        color: #333;
        border: 2px solid #e0e0e0;
        padding: 16px 40px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        justify-content: center;
    }

    .btn-cancel:hover {
        background: #e9ecef;
        border-color: #667eea;
        color: #667eea;
        transform: translateY(-3px);
    }

    .btn-cancel:active {
        transform: translateY(-1px);
    }

    .error-message {
        color: #dc3545;
        font-size: 13px;
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
        animation: shake 0.5s ease;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        20%, 40%, 60%, 80% { transform: translateX(5px); }
    }

    .success-message {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        border: none;
        border-left: 5px solid #28a745;
        border-radius: 12px;
        padding: 20px 25px;
        margin-bottom: 30px;
        color: #155724;
        animation: slideInRight 0.5s ease-out;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .success-message i {
        font-size: 1.5rem;
    }

    .url-preview {
        font-size: 13px;
        color: #666;
        margin-top: 8px;
        padding: 8px 12px;
        background: #f8f9fa;
        border-radius: 6px;
        border-left: 3px solid #667eea;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .url-preview:hover {
        background: #e9ecef;
    }

    @media (max-width: 768px) {
        .edit-container {
            padding: 20px;
        }

        .page-header h1 {
            font-size: 2.2rem;
        }

        .form-body {
            padding: 25px;
        }

        .form-grid,
        .social-grid {
            grid-template-columns: 1fr;
        }

        .form-header-content {
            flex-direction: column;
            text-align: center;
        }

        .back-btn {
            width: 100%;
            justify-content: center;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-submit,
        .btn-cancel {
            width: 100%;
        }
    }

    .form-control.is-invalid {
        border-color: #dc3545;
        background: #f8d7da;
    }

    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.25);
    }

    .form-control.is-valid {
        border-color: #28a745;
        background: #d4edda;
    }

    .form-control.is-valid:focus {
        box-shadow: 0 0 0 4px rgba(40, 167, 69, 0.25);
    }
</style>

<div class="edit-container">
    <div class="page-header">
        <h1>Edit Website Details</h1>
        <p>Update your website contact information and social media links. All fields are optional.</p>
    </div>

    @if(session('success'))
        <div class="success-message">
            <i class="fas fa-check-circle"></i>
            <div>
                <strong>Success!</strong> {{ session('success') }}
            </div>
        </div>
    @endif

    <form action="{{ route('website-details.update') }}" method="POST" id="websiteDetailsForm">
        @csrf
        @method('PUT')

        <div class="edit-form-card">
            <div class="form-header">
                <div class="form-header-content">
                    <h2>
                        <i class="fas fa-edit"></i>
                        Edit Information
                    </h2>
                    <a href="{{ route('website-details.index') }}" class="back-btn">
                        <i class="fas fa-arrow-left"></i>
                        Back to Details
                    </a>
                </div>
            </div>

            <div class="form-body">
                <div class="form-grid">
                    <!-- Phone -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-phone"></i>
                            Phone Number
                        </label>
                        <div class="input-wrapper">
                            <input type="text" 
                                   name="phone" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   value="{{ old('phone', $detail->phone ?? '') }}"
                                   placeholder="Enter phone number">
                            <i class="fas fa-phone input-icon"></i>
                        </div>
                        @error('phone')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-envelope"></i>
                            Email Address
                        </label>
                        <div class="input-wrapper">
                            <input type="email" 
                                   name="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email', $detail->email ?? '') }}"
                                   placeholder="Enter email address">
                            <i class="fas fa-envelope input-icon"></i>
                        </div>
                        @error('email')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label class="form-label">
                            <i class="fas fa-map-marker-alt"></i>
                            Address
                        </label>
                        <div class="input-wrapper">
                            <textarea name="address" 
                                      class="form-control @error('address') is-invalid @enderror" 
                                      placeholder="Enter complete address"
                                      rows="4">{{ old('address', $detail->address ?? '') }}</textarea>
                            <i class="fas fa-map-marker-alt input-icon"></i>
                        </div>
                        @error('address')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Social Media Section -->
                <div class="social-section">
                    <h3 class="section-title">
                        <i class="fas fa-share-alt"></i>
                        Social Media Links
                    </h3>

                    <div class="social-grid">
                        <!-- Instagram -->
                        <div class="form-group social-form-group instagram">
                            <label class="form-label">
                                <i class="fab fa-instagram"></i>
                                Instagram URL
                            </label>
                            <div class="social-input-wrapper">
                                <input type="url" 
                                       name="instagram" 
                                       class="social-form-control @error('instagram') is-invalid @enderror" 
                                       value="{{ old('instagram', $detail->instagram ?? '') }}"
                                       placeholder="https://instagram.com/username">
                                <div class="social-input-icon">
                                    <i class="fab fa-instagram"></i>
                                </div>
                            </div>
                            @if(old('instagram', $detail->instagram ?? ''))
                                <div class="url-preview">
                                    <i class="fas fa-link"></i>
                                    <span>{{ parse_url(old('instagram', $detail->instagram ?? ''), PHP_URL_HOST) ?? 'Invalid URL' }}</span>
                                </div>
                            @endif
                            @error('instagram')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Twitter -->
                        <div class="form-group social-form-group twitter">
                            <label class="form-label">
                                <i class="fab fa-twitter"></i>
                                Twitter URL
                            </label>
                            <div class="social-input-wrapper">
                                <input type="url" 
                                       name="twitter" 
                                       class="social-form-control @error('twitter') is-invalid @enderror" 
                                       value="{{ old('twitter', $detail->twitter ?? '') }}"
                                       placeholder="https://twitter.com/username">
                                <div class="social-input-icon">
                                    <i class="fab fa-twitter"></i>
                                </div>
                            </div>
                            @if(old('twitter', $detail->twitter ?? ''))
                                <div class="url-preview">
                                    <i class="fas fa-link"></i>
                                    <span>{{ parse_url(old('twitter', $detail->twitter ?? ''), PHP_URL_HOST) ?? 'Invalid URL' }}</span>
                                </div>
                            @endif
                            @error('twitter')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Facebook -->
                        <div class="form-group social-form-group facebook">
                            <label class="form-label">
                                <i class="fab fa-facebook-f"></i>
                                Facebook URL
                            </label>
                            <div class="social-input-wrapper">
                                <input type="url" 
                                       name="facebook" 
                                       class="social-form-control @error('facebook') is-invalid @enderror" 
                                       value="{{ old('facebook', $detail->facebook ?? '') }}"
                                       placeholder="https://facebook.com/username">
                                <div class="social-input-icon">
                                    <i class="fab fa-facebook-f"></i>
                                </div>
                            </div>
                            @if(old('facebook', $detail->facebook ?? ''))
                                <div class="url-preview">
                                    <i class="fas fa-link"></i>
                                    <span>{{ parse_url(old('facebook', $detail->facebook ?? ''), PHP_URL_HOST) ?? 'Invalid URL' }}</span>
                                </div>
                            @endif
                            @error('facebook')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- LinkedIn -->
                        <div class="form-group social-form-group linkedin">
                            <label class="form-label">
                                <i class="fab fa-linkedin-in"></i>
                                LinkedIn URL
                            </label>
                            <div class="social-input-wrapper">
                                <input type="url" 
                                       name="linkedin" 
                                       class="social-form-control @error('linkedin') is-invalid @enderror" 
                                       value="{{ old('linkedin', $detail->linkedin ?? '') }}"
                                       placeholder="https://linkedin.com/in/username">
                                <div class="social-input-icon">
                                    <i class="fab fa-linkedin-in"></i>
                                </div>
                            </div>
                            @if(old('linkedin', $detail->linkedin ?? ''))
                                <div class="url-preview">
                                    <i class="fas fa-link"></i>
                                    <span>{{ parse_url(old('linkedin', $detail->linkedin ?? ''), PHP_URL_HOST) ?? 'Invalid URL' }}</span>
                                </div>
                            @endif
                            @error('linkedin')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- YouTube -->
                        <div class="form-group social-form-group youtube">
                            <label class="form-label">
                                <i class="fab fa-youtube"></i>
                                YouTube URL
                            </label>
                            <div class="social-input-wrapper">
                                <input type="url" 
                                       name="youtube" 
                                       class="social-form-control @error('youtube') is-invalid @enderror" 
                                       value="{{ old('youtube', $detail->youtube ?? '') }}"
                                       placeholder="https://youtube.com/channel/username">
                                <div class="social-input-icon">
                                    <i class="fab fa-youtube"></i>
                                </div>
                            </div>
                            @if(old('youtube', $detail->youtube ?? ''))
                                <div class="url-preview">
                                    <i class="fas fa-link"></i>
                                    <span>{{ parse_url(old('youtube', $detail->youtube ?? ''), PHP_URL_HOST) ?? 'Invalid URL' }}</span>
                                </div>
                            @endif
                            @error('youtube')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('website-details.index') }}" class="btn-cancel">
                        <i class="fas fa-times"></i>
                        Cancel
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save"></i>
                        Update Details
                    </button>
                </div>
            </div>
        </div>
    </form>

    <!-- Form Help Text -->
    <div class="mt-4 text-center text-muted">
        <small>
            <i class="fas fa-info-circle"></i>
            All social media links should be full URLs starting with https://
        </small>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add staggered animation for form groups
        const formGroups = document.querySelectorAll('.form-group');
        formGroups.forEach((group, index) => {
            group.style.animationDelay = `${index * 0.1}s`;
        });

        // URL preview on input
        const urlInputs = document.querySelectorAll('input[type="url"]');
        urlInputs.forEach(input => {
            input.addEventListener('input', function() {
                const wrapper = this.closest('.social-form-group');
                let preview = wrapper.querySelector('.url-preview');
                
                if (this.value) {
                    if (!preview) {
                        preview = document.createElement('div');
                        preview.className = 'url-preview';
                        preview.innerHTML = `<i class="fas fa-link"></i><span></span>`;
                        wrapper.appendChild(preview);
                    }
                    
                    try {
                        const url = new URL(this.value);
                        preview.querySelector('span').textContent = url.hostname;
                    } catch (e) {
                        preview.querySelector('span').textContent = 'Invalid URL';
                    }
                } else if (preview) {
                    preview.remove();
                }
            });
        });

        // Form validation
        const form = document.getElementById('websiteDetailsForm');
        form.addEventListener('submit', function(e) {
            let isValid = true;
            const urlInputs = form.querySelectorAll('input[type="url"]');
            
            urlInputs.forEach(input => {
                if (input.value && !isValidUrl(input.value)) {
                    isValid = false;
                    input.classList.add('is-invalid');
                    
                    let error = input.nextElementSibling?.nextElementSibling;
                    if (!error || !error.classList.contains('error-message')) {
                        error = document.createElement('div');
                        error.className = 'error-message';
                        error.innerHTML = `<i class="fas fa-exclamation-circle"></i> Please enter a valid URL`;
                        input.parentNode.parentNode.appendChild(error);
                    }
                } else {
                    input.classList.remove('is-invalid');
                    const error = input.nextElementSibling?.nextElementSibling;
                    if (error && error.classList.contains('error-message')) {
                        error.remove();
                    }
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                return false;
            }
        });

        function isValidUrl(string) {
            try {
                new URL(string);
                return true;
            } catch (_) {
                return false;
            }
        }

        // Auto-format phone number
        const phoneInput = document.querySelector('input[name="phone"]');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 10) {
                    value = value.substring(0, 10);
                }
                
                if (value.length > 6) {
                    value = value.substring(0, 6) + ' ' + value.substring(6);
                }
                if (value.length > 3) {
                    value = value.substring(0, 3) + ' ' + value.substring(3);
                }
                
                e.target.value = value.trim();
            });
        }
    });
</script>
@endsection