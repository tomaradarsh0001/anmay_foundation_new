@extends('admin.layouts.app')

@section('title', 'Admin - Edit Cause')

@section('content')
<div class="admin-causes-edit">
    <div class="container-fluid py-5">
        <!-- Header Section -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="page-title mb-2">Edit Campaign</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('causes.index') }}" class="text-decoration-none">Causes</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit {{ $cause->name }}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="action-buttons">
                        <a href="{{ route('causes.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Form Card -->
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="card shadow-lg border-0">
                    <!-- Card Header -->
                    <div class="card-header bg-gradient-warning text-dark py-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="mb-1 h4">
                                    <i class="fas fa-edit me-2"></i>Update Campaign Details
                                </h2>
                                <small class="opacity-75">Modify fundraising campaign information</small>
                            </div>
                            <span class="badge bg-white text-warning px-3 py-2 rounded-pill">
                                <i class="fas fa-hashtag me-1"></i> ID: #{{ $cause->id }}
                            </span>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="{{ route('causes.update', $cause->id) }}" method="POST" enctype="multipart/form-data" id="editCauseForm">
                            @csrf
                            @method('PUT')

                            <!-- Campaign Information Section -->
                            <div class="form-section mb-5">
                                <h3 class="section-title mb-4">
                                    <i class="fas fa-info-circle me-2 text-primary"></i>Campaign Information
                                </h3>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label for="name" class="form-label">
                                                <i class="fas fa-tag me-2 text-muted"></i>Campaign Name
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">
                                                    <i class="fas fa-heading text-primary"></i>
                                                </span>
                                                <input type="text" 
                                                       name="name" 
                                                       id="name"
                                                       class="form-control form-control-lg" 
                                                       value="{{ old('name', $cause->name) }}"
                                                       placeholder="Enter campaign name"
                                                       required>
                                            </div>
                                            @error('name')
                                            <div class="error-message mt-2">
                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                            </div>
                                            @enderror
                                            <small class="form-text text-muted mt-1">This will appear as the badge/name</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label for="heading" class="form-label">
                                                <i class="fas fa-text-height me-2 text-muted"></i>Campaign Heading
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">
                                                    <i class="fas fa-bold text-primary"></i>
                                                </span>
                                                <input type="text" 
                                                       name="heading" 
                                                       id="heading"
                                                       class="form-control form-control-lg" 
                                                       value="{{ old('heading', $cause->heading) }}"
                                                       placeholder="Enter main heading"
                                                       required>
                                            </div>
                                            @error('heading')
                                            <div class="error-message mt-2">
                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="content" class="form-label">
                                        <i class="fas fa-align-left me-2 text-muted"></i>Campaign Description
                                    </label>
                                    <textarea name="content" 
                                              id="content" 
                                              class="form-control form-control-lg" 
                                              rows="5"
                                              placeholder="Tell the story of your campaign..."
                                              required>{{ old('content', $cause->content) }}</textarea>
                                    @error('content')
                                    <div class="error-message mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                    <div class="form-text d-flex justify-content-between mt-2">
                                        <span class="text-muted">Describe your cause in detail</span>
                                        <span id="charCount" class="text-muted">0 characters</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Financial Goals Section -->
                            <div class="form-section mb-5">
                                <h3 class="section-title mb-4">
                                    <i class="fas fa-chart-line me-2 text-success"></i>Financial Goals
                                </h3>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label for="target_goal" class="form-label">
                                                <i class="fas fa-bullseye me-2 text-muted"></i>Target Goal ($)
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">
                                                    <i class="fas fa-dollar-sign text-success"></i>
                                                </span>
                                                <input type="number" 
                                                       name="target_goal" 
                                                       id="target_goal"
                                                       class="form-control form-control-lg" 
                                                       value="{{ old('target_goal', $cause->target_goal) }}"
                                                       placeholder="Enter target amount"
                                                       min="1"
                                                       required>
                                                <span class="input-group-text bg-light">USD</span>
                                            </div>
                                            @error('target_goal')
                                            <div class="error-message mt-2">
                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label for="raised" class="form-label">
                                                <i class="fas fa-hand-holding-usd me-2 text-muted"></i>Raised Amount ($)
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">
                                                    <i class="fas fa-money-bill-wave text-success"></i>
                                                </span>
                                                <input type="number" 
                                                       name="raised" 
                                                       id="raised"
                                                       class="form-control form-control-lg" 
                                                       value="{{ old('raised', $cause->raised) }}"
                                                       placeholder="Enter raised amount"
                                                       min="0">
                                                <span class="input-group-text bg-light">USD</span>
                                            </div>
                                            @error('raised')
                                            <div class="error-message mt-2">
                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                            </div>
                                            @enderror
                                            <small class="form-text text-muted mt-1">Leave as 0 if no donations yet</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Progress Visualization -->
                                <div class="progress-card bg-light rounded p-4 mb-4">
                                    <h5 class="mb-3">
                                        <i class="fas fa-chart-pie me-2 text-primary"></i>Current Progress
                                    </h5>
                                    @php
                                        $percent = ($cause->raised / $cause->target_goal) * 100;
                                        $percent = min($percent, 100);
                                    @endphp
                                    <div class="progress-wrapper">
                                        <div class="d-flex justify-content-between mb-2">
                                            <div>
                                                <span class="progress-label h5 mb-0">{{ round($percent) }}%</span>
                                                <small class="text-muted ms-2">of target reached</small>
                                            </div>
                                            <div>
                                                <small class="text-muted">
                                                    ${{ number_format($cause->raised) }} / ${{ number_format($cause->target_goal) }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="progress" style="height: 12px;">
                                            <div class="progress-bar 
                                                @if($percent >= 100) bg-success
                                                @elseif($percent >= 75) bg-warning
                                                @else bg-primary @endif" 
                                                role="progressbar" 
                                                style="width: {{ $percent }}%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Image Upload Section -->
                            <div class="form-section mb-5">
                                <h3 class="section-title mb-4">
                                    <i class="fas fa-image me-2 text-info"></i>Campaign Image
                                </h3>
                                
                                <div class="row">
                                    <div class="col-lg-6 mb-4">
                                        <div class="form-group">
                                            <label for="image" class="form-label">
                                                <i class="fas fa-upload me-2 text-muted"></i>Upload New Image
                                            </label>
                                            <div class="file-upload-wrapper">
                                                <div class="file-upload-area border-dashed rounded p-5 text-center">
                                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                                    <h5 class="mb-2">Drop image here or click to upload</h5>
                                                    <p class="text-muted mb-3">Supports JPG, PNG, GIF (Max: 5MB)</p>
                                                    <input type="file" 
                                                           name="image" 
                                                           id="image"
                                                           class="form-control form-control-lg d-none"
                                                           accept="image/*">
                                                    <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('image').click()">
                                                        <i class="fas fa-folder-open me-2"></i>Browse Files
                                                    </button>
                                                    <div id="fileName" class="mt-3 text-muted"></div>
                                                </div>
                                                @error('image')
                                                <div class="error-message mt-2">
                                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                                </div>
                                                @enderror
                                                <small class="form-text text-muted mt-2">Leave empty to keep current image</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mb-4">
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-eye me-2 text-muted"></i>Current Image
                                            </label>
                                            <div class="current-image-wrapper">
                                                <div class="image-preview-card">
                                                    <img src="{{ asset('storage/'.$cause->image) }}" 
                                                         alt="{{ $cause->heading }}"
                                                         id="currentImage"
                                                         class="img-fluid rounded shadow-sm">
                                                    <div class="image-overlay">
                                                        <button type="button" 
                                                                class="btn btn-light btn-sm"
                                                                onclick="document.getElementById('currentImage').classList.toggle('zoomed')">
                                                            <i class="fas fa-search-plus"></i> Zoom
                                                        </button>
                                                    </div>
                                                </div>
                                                <small class="form-text text-muted mt-2 text-center">Current campaign image</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="form-section border-top pt-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    
                                    <div>
                                        <form action="{{ route('causes.destroy', $cause->id) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirmDelete(event, '{{ $cause->name }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-outline-danger me-2"
                                                    data-bs-toggle="tooltip" 
                                                    title="Delete">
                                                <i class="fas fa-trash me-2"></i>Delete
                                            </button>
                                              
                                        </button>
                                        </form>
                                     
                                        <button type="submit" class="btn btn-warning btn-lg shadow-sm">
                                            <i class="fas fa-save me-2"></i>Update Campaign
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    function confirmDelete(event, causeName) {
    event.preventDefault();
    Swal.fire({
        title: 'Are you sure?',
        html: `<p>You are about to delete: <strong>"${causeName}"</strong></p><p class="text-danger">This action cannot be undone!</p>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            event.target.closest('form').submit();
        }
    });
}

</script>

<style>
.admin-causes-edit {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
}

.page-title {
    color: #2c3e50;
    font-weight: 700;
    position: relative;
    padding-bottom: 10px;
}

.page-title:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 4px;
    background: linear-gradient(90deg, #f39c12, #f1c40f);
    border-radius: 2px;
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #f39c12 0%, #f1c40f 100%);
}

.card {
    border: none;
    border-radius: 15px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
}

.card-header {
    border-bottom: none;
    border-radius: 15px 15px 0 0 !important;
}

.section-title {
    color: #2c3e50;
    font-size: 1.25rem;
    font-weight: 600;
    padding-bottom: 10px;
    border-bottom: 2px solid #f0f2f5;
    position: relative;
}

.section-title:after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 50px;
    height: 2px;
    background: #3498db;
}

.form-section {
    background: white;
    padding: 2rem;
    border-radius: 10px;
    border: 1px solid #eef1f6;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
}

.form-section:hover {
    border-color: #3498db;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
}

.form-control {
    border: 2px solid #e0e6ed;
    border-radius: 10px;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
}

.form-control-lg {
    font-size: 1.1rem;
    padding: 1rem 1.25rem;
}

.input-group-text {
    background-color: #f8f9fa;
    border: 2px solid #e0e6ed;
    border-right: none;
}

.input-group .form-control {
    border-left: none;
}

.input-group .form-control:focus {
    border-left: none;
}

textarea.form-control {
    resize: vertical;
    min-height: 120px;
}

.error-message {
    color: #e74c3c;
    font-size: 0.875rem;
    padding: 0.5rem;
    background-color: rgba(231, 76, 60, 0.1);
    border-radius: 5px;
    border-left: 3px solid #e74c3c;
}

.progress-card {
    border: 2px solid #e0e6ed;
    transition: all 0.3s ease;
}

.progress-card:hover {
    border-color: #3498db;
    transform: translateY(-2px);
}

.progress {
    background-color: #e9ecef;
    border-radius: 10px;
    overflow: hidden;
}

.progress-bar {
    border-radius: 10px;
    transition: width 0.6s ease;
}

.progress-label {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
}

.file-upload-area {
    border: 3px dashed #dee2e6;
    background-color: #f8fafc;
    transition: all 0.3s ease;
    cursor: pointer;
}

.file-upload-area:hover {
    border-color: #3498db;
    background-color: #f0f7ff;
}

.file-upload-area.dragover {
    border-color: #2ecc71;
    background-color: #e8f8f1;
}

.current-image-wrapper {
    position: relative;
    overflow: hidden;
    border-radius: 10px;
}

.image-preview-card {
    position: relative;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.image-preview-card img {
    transition: transform 0.3s ease;
    width: 100%;
    height: 250px;
    object-fit: cover;
}

.image-preview-card img.zoomed {
    transform: scale(1.5);
}

.image-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
    padding: 1rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.image-preview-card:hover .image-overlay {
    opacity: 1;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
    padding: 0.75rem 1.5rem;
    transition: all 0.3s ease;
}

.btn-warning {
    background: linear-gradient(135deg, #f39c12 0%, #f1c40f 100%);
    border: none;
    color: #2c3e50;
}

.btn-warning:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(243, 156, 18, 0.3);
}

.btn-outline-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(108, 117, 125, 0.2);
}

.btn-outline-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.2);
}

.btn-lg {
    padding: 1rem 2rem;
    font-size: 1.1rem;
}

.breadcrumb {
    background: transparent;
    padding: 0;
}

.breadcrumb-item a {
    color: #3498db;
    text-decoration: none;
    transition: color 0.3s ease;
}

.breadcrumb-item a:hover {
    color: #2980b9;
}

.breadcrumb-item.active {
    color: #7f8c8d;
}

.badge {
    font-weight: 500;
    letter-spacing: 0.3px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .admin-causes-edit .container-fluid {
        padding-left: 15px;
        padding-right: 15px;
    }
    
    .form-section {
        padding: 1.5rem;
    }
    
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 1rem;
    }
    
    .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
}
</style>

<script>
// Character counter for content textarea
document.addEventListener('DOMContentLoaded', function() {
    const contentTextarea = document.getElementById('content');
    const charCount = document.getElementById('charCount');
    
    if (contentTextarea && charCount) {
        // Update counter on load
        charCount.textContent = contentTextarea.value.length + ' characters';
        
        // Update counter on input
        contentTextarea.addEventListener('input', function() {
            charCount.textContent = this.value.length + ' characters';
        });
    }
    
    // File upload preview
    const fileInput = document.getElementById('image');
    const fileName = document.getElementById('fileName');
    const fileUploadArea = document.querySelector('.file-upload-area');
    
    if (fileInput) {
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileName.textContent = 'Selected: ' + this.files[0].name;
                fileUploadArea.classList.add('dragover');
                
                // Preview image
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-fluid rounded mt-2';
                    img.style.maxHeight = '150px';
                    
                    // Remove previous preview
                    const oldPreview = fileUploadArea.querySelector('img');
                    if (oldPreview) oldPreview.remove();
                    
                    fileUploadArea.appendChild(img);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
        
        // Drag and drop functionality
        fileUploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });
        
        fileUploadArea.addEventListener('dragleave', function() {
            this.classList.remove('dragover');
        });
        
        fileUploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
            
            if (e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
                fileInput.dispatchEvent(new Event('change'));
            }
        });
        
        // Click to upload
        fileUploadArea.addEventListener('click', function() {
            fileInput.click();
        });
    }
});

function resetForm() {
    if (confirm('Are you sure you want to reset all changes?')) {
        document.getElementById('editCauseForm').reset();
        const fileName = document.getElementById('fileName');
        if (fileName) fileName.textContent = '';
        
        // Remove uploaded image preview
        const previewImg = document.querySelector('.file-upload-area img');
        if (previewImg) previewImg.remove();
        
        // Reset character count
        const charCount = document.getElementById('charCount');
        const contentTextarea = document.getElementById('content');
        if (charCount && contentTextarea) {
            charCount.textContent = contentTextarea.value.length + ' characters';
        }
    }
}


// Form validation
document.getElementById('editCauseForm').addEventListener('submit', function(e) {
    const targetGoal = document.getElementById('target_goal').value;
    const raised = document.getElementById('raised').value;
    
    if (parseFloat(raised) > parseFloat(targetGoal)) {
        e.preventDefault();
        Swal.fire({
            title: 'Invalid Amount',
            text: 'Raised amount cannot exceed target goal!',
            icon: 'error',
            confirmButtonColor: '#3498db'
        });
    }
});
</script>

<!-- Include SweetAlert -->
@if(!request()->routeIs('causes.edit'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endif
@endsection