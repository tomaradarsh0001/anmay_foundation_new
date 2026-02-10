@extends('admin.layouts.app')

@section('title', 'Edit Testimonial - Anmay Foundation')

@section('content')
<style>
    .edit-testimonial-container {
        padding: 30px;
        max-width: 800px;
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
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
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

    .form-section {
        margin-bottom: 40px;
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

    .section-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        color: #667eea;
        font-size: 1.4rem;
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
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
        padding: 15px 20px;
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

    textarea.form-control {
        min-height: 150px;
        resize: vertical;
        line-height: 1.6;
    }

    .character-count {
        position: absolute;
        right: 15px;
        bottom: 10px;
        font-size: 12px;
        color: #888;
        background: white;
        padding: 2px 8px;
        border-radius: 10px;
        transition: color 0.3s ease;
    }

    .character-count.warning {
        color: #ff9800;
        font-weight: 600;
    }

    .character-count.danger {
        color: #dc3545;
        font-weight: 700;
    }

    .rating-section {
        margin-bottom: 30px;
    }

    .rating-label {
        display: block;
        color: #333;
        font-weight: 600;
        margin-bottom: 15px;
        font-size: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .rating-label i {
        color: #ffc107;
    }

    .rating-stars {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
    }

    .star-input {
        display: none;
    }

    .star-label {
        cursor: pointer;
        font-size: 2rem;
        color: #e0e0e0;
        transition: all 0.3s ease;
    }

    .star-label:hover,
    .star-label:hover ~ .star-label {
        color: #ffc107;
    }

    .star-input:checked ~ .star-label {
        color: #e0e0e0;
    }

    .star-input:checked + .star-label,
    .star-input:checked + .star-label ~ .star-label {
        color: #ffc107;
    }

    .rating-value {
        font-size: 14px;
        color: #666;
        margin-left: 10px;
    }

    .toggle-group {
        display: flex;
        gap: 30px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }

    .toggle-item {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
    }

    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 30px;
    }

    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .toggle-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 34px;
    }

    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 22px;
        width: 22px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .toggle-slider {
        background-color: #667eea;
    }

    input:checked + .toggle-slider:before {
        transform: translateX(30px);
    }

    .toggle-label {
        color: #333;
        font-weight: 500;
        font-size: 14px;
    }

    .preview-section {
        margin-top: 40px;
        padding-top: 30px;
        border-top: 2px dashed #e0e0e0;
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

    .preview-card {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 30px;
        border: 2px solid #e9ecef;
        margin-top: 20px;
        position: relative;
    }

    .preview-card::before {
        content: '"';
        position: absolute;
        top: 10px;
        left: 20px;
        font-size: 60px;
        color: rgba(102, 126, 234, 0.2);
        font-family: Georgia, serif;
        line-height: 1;
    }

    .preview-content {
        font-style: italic;
        line-height: 1.8;
        color: #444;
        margin-bottom: 20px;
        padding-left: 20px;
        border-left: 3px solid #667eea;
    }

    .preview-author {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .preview-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 18px;
        border: 3px solid white;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
    }

    .preview-author-info {
        flex: 1;
    }

    .preview-author-name {
        font-weight: 700;
        color: #333;
        font-size: 1.1rem;
    }

    .preview-author-profession {
        color: #667eea;
        font-size: 0.9rem;
        margin-top: 3px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 40px;
        padding-top: 30px;
        border-top: 2px solid #f0f0f0;
    }

    .btn-update {
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

    .btn-update:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 176, 155, 0.3);
    }

    .btn-update:active {
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
        text-decoration: none;
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

    .alert-success {
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

    .alert-success i {
        font-size: 1.5rem;
    }

    @media (max-width: 768px) {
        .edit-testimonial-container {
            padding: 20px;
        }

        .page-header h1 {
            font-size: 2.2rem;
            flex-direction: column;
            gap: 10px;
        }

        .form-body {
            padding: 25px;
        }

        .form-header-content {
            flex-direction: column;
            text-align: center;
            gap: 15px;
        }

        .back-btn {
            width: 100%;
            justify-content: center;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-update,
        .btn-cancel {
            width: 100%;
        }

        .toggle-group {
            flex-direction: column;
            gap: 20px;
        }
    }

    .form-control.is-invalid {
        border-color: #dc3545;
        background: #f8d7da;
    }

    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.25);
    }
</style>

<div class="edit-testimonial-container">
    <div class="page-header">
        <h1 >
            <i class="fas fa-edit"></i>
            Edit Testimonial
        </h1>
        <p>Update testimonial details and preview how it will appear on your website</p>
    </div>

    @if(session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle"></i>
            <div>
                <strong>Success!</strong> {{ session('success') }}
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('testimonials.update', $testimonial->id) }}" id="testimonialForm">
        @csrf
        @method('PUT')

        <div class="edit-form-card">
            <div class="form-header">
                <div class="form-header-content">
                    <h2 class="text-white">
                        <i class="fas fa-quote-left"></i>
                        Edit Testimonial
                    </h2>
                    <a href="{{ route('testimonials.index') }}" class="back-btn">
                        <i class="fas fa-arrow-left"></i>
                        Back to Testimonials
                    </a>
                </div>
            </div>

            <div class="form-body">
                <!-- Testimonial Content Section -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-comment-alt"></i>
                        Testimonial Content
                    </h3>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-quote-right"></i>
                            Testimonial Text
                        </label>
                        <div class="input-wrapper">
                            <textarea name="text" 
                                      id="testimonialText" 
                                      class="form-control @error('text') is-invalid @enderror" 
                                      rows="6" 
                                      required
                                      placeholder="Share what this person said about your foundation..."
                                      oninput="updatePreview()">{{ old('text', $testimonial->text) }}</textarea>
                            <div class="character-count" id="charCount">0/500</div>
                        </div>
                        @error('text')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Author Information Section -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-user"></i>
                        Author Information
                    </h3>

                    <div class="row" style="display: flex; flex-wrap: wrap; margin: 0 -15px;">
                        <div class="col-md-6" style="flex: 0 0 50%; max-width: 50%; padding: 0 15px;">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-user-circle"></i>
                                    Full Name
                                </label>
                                <div class="input-wrapper">
                                    <input type="text" 
                                           name="name" 
                                           id="authorName"
                                           class="form-control @error('name') is-invalid @enderror" 
                                           value="{{ old('name', $testimonial->name) }}" 
                                           required
                                           placeholder="Enter full name"
                                           oninput="updatePreview()">
                                </div>
                                @error('name')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6" style="flex: 0 0 50%; max-width: 50%; padding: 0 15px;">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-briefcase"></i>
                                    Profession
                                </label>
                                <div class="input-wrapper">
                                    <input type="text" 
                                           name="profession" 
                                           id="authorProfession"
                                           class="form-control @error('profession') is-invalid @enderror" 
                                           value="{{ old('profession', $testimonial->profession) }}" 
                                           required
                                           placeholder="Enter profession/designation"
                                           oninput="updatePreview()">
                                </div>
                                @error('profession')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    
                </div>

               

                <!-- Preview Section -->
                <div class="preview-section">
                    <h3 class="section-title">
                        <i class="fas fa-eye"></i>
                        Preview
                    </h3>
                    <p style="color: #666; margin-bottom: 15px; font-size: 14px;">
                        This is how the testimonial will appear on your website
                    </p>

                    <div class="preview-card">
                        <div class="preview-content" id="previewText">
                            {{ $testimonial->text }}
                        </div>
                        <div class="preview-author">
                            <div class="preview-avatar" id="previewAvatar">
                                {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                            </div>
                            <div class="preview-author-info">
                                <div class="preview-author-name" id="previewName">
                                    {{ $testimonial->name }}
                                </div>
                                <div class="preview-author-profession" id="previewProfession">
                                    {{ $testimonial->profession }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('testimonials.index') }}" class="btn-cancel">
                        <i class="fas fa-times"></i>
                        Cancel
                    </a>
                    <button type="submit" class="btn-update">
                        <i class="fas fa-save"></i>
                        Update Testimonial
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize character count
        updateCharacterCount();
        updatePreview();
        
        // Character count for textarea
        const textarea = document.getElementById('testimonialText');
        textarea.addEventListener('input', updateCharacterCount);
        
        // Form validation
        const form = document.getElementById('testimonialForm');
        form.addEventListener('submit', function(e) {
            const text = document.getElementById('testimonialText').value.trim();
            const name = document.getElementById('authorName').value.trim();
            const profession = document.getElementById('authorProfession').value.trim();
            
            if (!text || !name || !profession) {
                e.preventDefault();
                alert('Please fill in all required fields.');
                return;
            }
            
            if (text.length > 500) {
                e.preventDefault();
                alert('Testimonial text cannot exceed 500 characters.');
                return;
            }
        });
    });

    function updateCharacterCount() {
        const textarea = document.getElementById('testimonialText');
        const charCount = document.getElementById('charCount');
        const count = textarea.value.length;
        const maxLength = 500;
        
        charCount.textContent = `${count}/${maxLength}`;
        
        // Update color based on count
        if (count > maxLength * 0.9) {
            charCount.className = 'character-count danger';
        } else if (count > maxLength * 0.75) {
            charCount.className = 'character-count warning';
        } else {
            charCount.className = 'character-count';
        }
    }

    function updatePreview() {
        // Update preview text
        const textInput = document.getElementById('testimonialText');
        const previewText = document.getElementById('previewText');
        previewText.textContent = textInput.value || "Testimonial text will appear here...";
        
        // Update preview name
        const nameInput = document.getElementById('authorName');
        const previewName = document.getElementById('previewName');
        previewName.textContent = nameInput.value || "Full Name";
        
        // Update preview profession
        const professionInput = document.getElementById('authorProfession');
        const previewProfession = document.getElementById('previewProfession');
        previewProfession.textContent = professionInput.value || "Profession";
        
        // Update avatar
        const previewAvatar = document.getElementById('previewAvatar');
        previewAvatar.textContent = nameInput.value ? nameInput.value.charAt(0).toUpperCase() : "N";
    }

    function updateRating(rating) {
        const ratingValue = document.getElementById('ratingValue');
        ratingValue.textContent = `${rating}/5`;
        
        // Add stars to preview
        const previewCard = document.querySelector('.preview-card');
        let starsHtml = '<div class="rating" style="margin-top: 15px;">';
        for (let i = 1; i <= 5; i++) {
            starsHtml += `<i class="fas fa-star star ${i <= rating ? '' : 'empty'}" style="font-size: 1rem;"></i>`;
        }
        starsHtml += `</div>`;
        
        // Check if stars already exist
        const existingStars = previewCard.querySelector('.rating');
        if (existingStars) {
            existingStars.remove();
        }
        
        // Add stars after author info
        const authorInfo = previewCard.querySelector('.preview-author-info');
        if (authorInfo && rating > 0) {
            authorInfo.insertAdjacentHTML('afterend', starsHtml);
        }
    }

    // Set rating from existing value
    const initialRating = {{ old('rating', $testimonial->rating ?? 0) }};
    if (initialRating > 0) {
        updateRating(initialRating);
    }
</script>
@endsection