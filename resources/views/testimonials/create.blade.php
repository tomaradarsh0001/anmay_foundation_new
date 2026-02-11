@extends('admin.layouts.app')

@section('title', 'Admin - Testimonials')

@section('content')
<style>
    .form-container {
        max-width: 800px;
        margin: 0 auto;
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 16px;
        padding: 2.5rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05), 
                    0 5px 10px rgba(0, 0, 0, 0.02);
        border: 1px solid rgba(229, 231, 235, 0.5);
    }
    
    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid #e2e8f0;
    }
    
    .form-title {
        color: #1e293b;
        font-size: 1.75rem;
        font-weight: 600;
        letter-spacing: -0.025em;
        position: relative;
    }
    
    .form-title:after {
        content: '';
        position: absolute;
        bottom: -1rem;
        left: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #3b82f6, #6366f1);
        border-radius: 2px;
    }
    
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.625rem 1.25rem;
        background: #f1f5f9;
        color: #475569;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #e2e8f0;
    }
    
    .back-btn:hover {
        background: #e2e8f0;
        color: #334155;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    
    .back-btn svg {
        transition: transform 0.3s ease;
    }
    
    .back-btn:hover svg {
        transform: translateX(-2px);
    }
    
    .form-group {
        margin-bottom: 2rem;
        position: relative;
    }
    
    .form-label {
        display: block;
        margin-bottom: 0.75rem;
        color: #334155;
        font-weight: 500;
        font-size: 0.95rem;
        letter-spacing: 0.01em;
    }
    
    .form-input, .form-file {
        width: 100%;
        padding: 1rem 1.25rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        background: white;
        font-size: 0.95rem;
        color: #1e293b;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
    }
    
    .form-file {
        padding: 0.8rem 1.25rem;
        cursor: pointer;
    }
    
    .form-file::-webkit-file-upload-button {
        visibility: hidden;
    }
    
    .form-file::before {
        content: 'Choose Image';
        display: inline-block;
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        margin-right: 1rem;
        font-weight: 500;
        font-size: 0.875rem;
    }
    
    .form-input:focus, .form-file:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        transform: translateY(-1px);
    }
    
    .form-input::placeholder {
        color: #94a3b8;
    }
    
    textarea.form-input {
        min-height: 140px;
        resize: vertical;
        line-height: 1.6;
    }
    
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
    }
    
    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2.5rem;
        padding-top: 2rem;
        border-top: 1px solid #f1f5f9;
    }
    
    .btn-submit {
        padding: 1rem 2rem;
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 500;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        letter-spacing: 0.01em;
        box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2);
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(59, 130, 246, 0.25);
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    }
    
    .btn-submit:active {
        transform: translateY(0);
    }
    
    .btn-cancel {
        padding: 1rem 2rem;
        background: white;
        color: #64748b;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-weight: 500;
        font-size: 0.95rem;
        text-decoration: none;
        text-align: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .btn-cancel:hover {
        background: #f8fafc;
        color: #475569;
        border-color: #cbd5e1;
        transform: translateY(-1px);
    }
    
    .input-icon {
        position: absolute;
        right: 1.25rem;
        top: 2.8rem;
        color: #94a3b8;
        pointer-events: none;
    }
    
    .image-preview {
        margin-top: 1rem;
        display: none;
    }
    
    .image-preview.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .preview-image {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 12px;
        border: 3px solid #e2e8f0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .form-help {
        color: #64748b;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: block;
    }
    
    @media (max-width: 640px) {
        .form-container {
            padding: 1.5rem;
            margin: 1rem;
        }
        
        .form-header {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .btn-submit, .btn-cancel {
            width: 100%;
        }
        
        .preview-image {
            width: 150px;
            height: 150px;
        }
    }
</style>

<div class="py-8 px-4">
    <div class="form-container">
        <div class="form-header">
            <h1 class="form-title">Add New Testimonial</h1>
            <a href="{{ route('testimonials.index') }}" class="back-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Back to List
            </a>
        </div>

        <form method="POST" action="{{ route('testimonials.store') }}" enctype="multipart/form-data" id="testimonialForm">
            @csrf

            <div class="form-group">
                <label class="form-label">Testimonial Text</label>
                <textarea name="text" 
                          class="form-input" 
                          rows="5" 
                          placeholder="Share your testimonial experience..."
                          required></textarea>
                <div class="input-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                    </svg>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input name="name" 
                           type="text"
                           class="form-input"
                           placeholder="Enter full name"
                           required>
                    <div class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Profession</label>
                    <input name="profession" 
                           type="text"
                           class="form-input"
                           placeholder="Enter profession"
                           required>
                    <div class="input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Profile Image</label>
                <input type="file" 
                       name="image" 
                       id="imageInput"
                       class="form-file"
                       accept="image/*"
                       onchange="previewImage(event)">
                <span class="form-help">Recommended: 200x200 pixels. Max size: 2MB. Allowed formats: JPG, PNG, GIF</span>
                
                <div class="image-preview" id="imagePreview">
                    <img class="preview-image" id="previewImg" src="" alt="Image Preview">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    Save Testimonial
                </button>
                <a href="{{ route('testimonials.index') }}" class="btn-cancel">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.add('active');
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.classList.remove('active');
            previewImg.src = '';
        }
    }

    document.getElementById('testimonialForm').addEventListener('submit', function(e) {
        const imageInput = document.getElementById('imageInput');
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
</script>
@endsection