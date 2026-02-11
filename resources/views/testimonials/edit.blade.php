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

    .form-control, .form-control-file {
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

    .form-control-file {
        padding: 12px 20px;
        cursor: pointer;
    }

    .form-control-file::-webkit-file-upload-button {
        visibility: hidden;
    }

    .form-control-file::before {
        content: 'Change Image';
        display: inline-block;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        margin-right: 1rem;
        font-weight: 500;
        font-size: 0.875rem;
    }

    .form-control:focus, .form-control-file:focus {
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

    .current-image {
        margin-top: 15px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 10px;
        border: 1px solid #e0e0e0;
    }

    .current-image img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .image-preview {
        margin-top: 15px;
        display: none;
    }

    .image-preview.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .preview-new-image {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #667eea;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
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
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 20px;
        border: 3px solid white;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
        overflow: hidden;
    }

    .preview-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
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

    .form-help {
        color: #666;
        font-size: 13px;
        margin-top: 5px;
        display: block;
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
    }

    .form-control.is-invalid, .form-control-file.is-invalid {
        border-color: #dc3545;
        background: #f8d7da;
    }

    .form-control.is-invalid:focus, .form-control-file.is-invalid:focus {
        box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.25);
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -15px;
    }

    .col-md-6 {
        flex: 0 0 50%;
        max-width: 50%;
        padding: 0 15px;
    }

    @media (max-width: 768px) {
        .col-md-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>

<div class="edit-testimonial-container">
    <div class="page-header">
        <h1>
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

    <form method="POST" action="{{ route('testimonials.update', $testimonial->id) }}" id="testimonialForm" enctype="multipart/form-data">
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
                            <div class="character-count" id="charCount">{{ strlen(old('text', $testimonial->text)) }}/500</div>
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

                    <div class="row">
                        <div class="col-md-6">
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

                        <div class="col-md-6">
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

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-image"></i>
                                    Profile Image
                                </label>
                                <div class="input-wrapper">
                                    <input type="file" 
                                           name="image" 
                                           id="authorImage"
                                           class="form-control-file @error('image') is-invalid @enderror"
                                           accept="image/*"
                                           onchange="previewNewImage(event)">
                                    
                                    @if($testimonial->image)
                                        <div class="current-image">
                                            <p class="form-help">Current Image:</p>
                                            <img src="{{ $testimonial->image_url }}" 
                                                 alt="{{ $testimonial->name }}"
                                                 id="currentImage">
                                        </div>
                                    @endif
                                    
                                    <div class="image-preview" id="newImagePreview">
                                        <p class="form-help">New Image Preview:</p>
                                        <img class="preview-new-image" 
                                             id="previewNewImg" 
                                             src="" 
                                             alt="New Image Preview">
                                    </div>
                                </div>
                                @error('image')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <span class="form-help">Recommended: 200x200 pixels. Max size: 2MB. Allowed formats: JPG, PNG, GIF</span>
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
                                @if($testimonial->image)
                                    <img src="{{ $testimonial->image_url }}" 
                                         alt="{{ $testimonial->name }}"
                                         id="avatarImage">
                                @else
                                    {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                @endif
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
            
            // Validate image file
            const imageInput = document.getElementById('authorImage');
            if (imageInput.files.length > 0) {
                const file = imageInput.files[0];
                const maxSize = 2 * 1024 * 1024; // 2MB
                
                if (file.size > maxSize) {
                    e.preventDefault();
                    alert('Image size must be less than 2MB');
                    return;
                }
                
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    e.preventDefault();
                    alert('Only JPG, PNG and GIF images are allowed');
                    return;
                }
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
        
        updatePreview();
    }

    function previewNewImage(event) {
        const input = event.target;
        const preview = document.getElementById('newImagePreview');
        const previewImg = document.getElementById('previewNewImg');
        const avatarImage = document.getElementById('avatarImage');
        const previewAvatar = document.getElementById('previewAvatar');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.add('active');
                
                // Update preview avatar
                if (avatarImage) {
                    avatarImage.src = e.target.result;
                } else {
                    // Create new image element for preview
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = document.getElementById('authorName').value || 'Avatar';
                    img.style.width = '100%';
                    img.style.height = '100%';
                    img.style.objectFit = 'cover';
                    previewAvatar.innerHTML = '';
                    previewAvatar.appendChild(img);
                }
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.classList.remove('active');
            previewImg.src = '';
            
            // Revert to current image if available
            const currentImage = document.getElementById('currentImage');
            if (currentImage) {
                const avatarImage = document.getElementById('avatarImage');
                if (avatarImage) {
                    avatarImage.src = currentImage.src;
                } else {
                    previewAvatar.innerHTML = '{{ strtoupper(substr($testimonial->name, 0, 1)) }}';
                }
            }
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
        
        // Update avatar initials if no image
        const previewAvatar = document.getElementById('previewAvatar');
        const hasImage = previewAvatar.querySelector('img');
        const nameInputValue = nameInput.value;
        
        if (!hasImage && !document.getElementById('authorImage').files.length) {
            previewAvatar.textContent = nameInputValue ? nameInputValue.charAt(0).toUpperCase() : "N";
        }
    }
</script>
@endsection