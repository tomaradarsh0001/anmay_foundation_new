@extends('admin.layouts.app')

@section('title', 'Admin - Create New Cause')

@section('content')
<div class="admin-causes-create">
    <div class="container-fluid py-5">
        <!-- Header Section -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="page-title mb-2">Launch New Campaign</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('causes.index') }}" class="text-decoration-none">Campaigns</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create New</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="action-buttons">
                        <a href="{{ route('causes.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Campaigns
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
                    <div class="card-header bg-gradient-primary text-white py-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="mb-1 h4">
                                    <i class="fas fa-plus-circle me-2"></i>Create New Fundraising Campaign
                                </h2>
                                <small class="opacity-75">Fill in the details to launch your new campaign</small>
                            </div>
                            <div class="creation-steps">
                                <span class="badge bg-white text-primary px-3 py-2 rounded-pill">
                                    <i class="fas fa-rocket me-1"></i> Step 1 of 1
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="{{ route('causes.store') }}" method="POST" enctype="multipart/form-data" id="createCauseForm">
                            @csrf

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
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">
                                                    <i class="fas fa-heading text-primary"></i>
                                                </span>
                                                <input type="text" 
                                                       name="name" 
                                                       id="name"
                                                       class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                                       value="{{ old('name') }}"
                                                       placeholder="Enter campaign name (e.g., Education for All)"
                                                       required
                                                       autofocus>
                                            </div>
                                            @error('name')
                                            <div class="error-message mt-2">
                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                            </div>
                                            @enderror
                                            <small class="form-text text-muted mt-1">This will appear as the badge/name of your campaign</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label for="heading" class="form-label">
                                                <i class="fas fa-text-height me-2 text-muted"></i>Campaign Heading
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">
                                                    <i class="fas fa-bold text-primary"></i>
                                                </span>
                                                <input type="text" 
                                                       name="heading" 
                                                       id="heading"
                                                       class="form-control form-control-lg @error('heading') is-invalid @enderror" 
                                                       value="{{ old('heading') }}"
                                                       placeholder="Enter main heading (e.g., Help Build Schools in Rural Areas)"
                                                       required>
                                            </div>
                                            @error('heading')
                                            <div class="error-message mt-2">
                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                            </div>
                                            @enderror
                                            <small class="form-text text-muted mt-1">The main title that will capture attention</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="content" class="form-label">
                                        <i class="fas fa-align-left me-2 text-muted"></i>Campaign Story & Description
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="editor-wrapper">
                                        <textarea name="content" 
                                                  id="content" 
                                                  class="form-control form-control-lg @error('content') is-invalid @enderror" 
                                                  rows="6"
                                                  placeholder="Tell the compelling story of your campaign. Explain why it matters, who it will help, and how donations will be used..."
                                                  required>{{ old('content') }}</textarea>
                                        <div class="editor-toolbar mt-2">
                                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="formatText('bold')">
                                                <i class="fas fa-bold"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="formatText('italic')">
                                                <i class="fas fa-italic"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="formatText('underline')">
                                                <i class="fas fa-underline"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('content')
                                    <div class="error-message mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                    <div class="form-text d-flex justify-content-between mt-2">
                                        <span class="text-muted">Tell a compelling story to inspire donors</span>
                                        <span id="charCount" class="text-muted">0/2000 characters</span>
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
                                                <i class="fas fa-bullseye me-2 text-muted"></i>Target Goal (Rs. )
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">
                                                    <i class="fas fa-dollar-sign text-success"></i>
                                                </span>
                                                <input type="number" 
                                                       name="target_goal" 
                                                       id="target_goal"
                                                       class="form-control form-control-lg @error('target_goal') is-invalid @enderror" 
                                                       value="{{ old('target_goal') }}"
                                                       placeholder="Enter target amount (e.g., 10000)"
                                                       min="100"
                                                       step="1"
                                                       required>
                                                <span class="input-group-text bg-light">USD</span>
                                            </div>
                                            @error('target_goal')
                                            <div class="error-message mt-2">
                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                            </div>
                                            @enderror
                                            <small class="form-text text-muted mt-1">Set a realistic fundraising target</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label for="raised" class="form-label">
                                                <i class="fas fa-hand-holding-usd me-2 text-muted"></i>Initial Raised Amount (Rs. )
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">
                                                    <i class="fas fa-money-bill-wave text-success"></i>
                                                </span>
                                                <input type="number" 
                                                       name="raised" 
                                                       id="raised"
                                                       class="form-control form-control-lg @error('raised') is-invalid @enderror" 
                                                       value="{{ old('raised', 0) }}"
                                                       placeholder="Enter initial amount (e.g., 0)"
                                                       min="0"
                                                       step="1">
                                                <span class="input-group-text bg-light">USD</span>
                                            </div>
                                            @error('raised')
                                            <div class="error-message mt-2">
                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                            </div>
                                            @enderror
                                            <small class="form-text text-muted mt-1">Leave as 0 if starting fresh, or enter seed funding</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Progress Preview -->
                                <div class="progress-preview bg-light rounded p-4 mb-4">
                                    <h5 class="mb-3">
                                        <i class="fas fa-eye me-2 text-primary"></i>Goal Progress Preview
                                    </h5>
                                    <div class="progress-wrapper" id="progressPreview">
                                        <div class="d-flex justify-content-between mb-2">
                                            <div>
                                                <span class="progress-label h5 mb-0">0%</span>
                                                <small class="text-muted ms-2">of target reached</small>
                                            </div>
                                            <div>
                                                <small class="text-muted" id="amountPreview">
                                                    Rs. 0 / Rs. 0
                                                </small>
                                            </div>
                                        </div>
                                        <div class="progress" style="height: 12px;">
                                            <div class="progress-bar bg-primary" 
                                                 role="progressbar" 
                                                 style="width: 0%"
                                                 id="progressBar">
                                            </div>
                                        </div>
                                        <div class="mt-3 text-center">
                                            <small class="text-muted">
                                                <i class="fas fa-info-circle me-1"></i>
                                                This is how donors will see your campaign progress
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Image Upload Section -->
                            <div class="form-section mb-5">
                                <h3 class="section-title mb-4">
                                    <i class="fas fa-image me-2 text-info"></i>Campaign Visuals
                                </h3>
                                
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label for="image" class="form-label">
                                                <i class="fas fa-upload me-2 text-muted"></i>Upload Campaign Image
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="file-upload-wrapper">
                                                <div class="file-upload-area border-dashed rounded p-5 text-center" id="dropArea">
                                                    <div id="uploadIcon">
                                                        <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                                    </div>
                                                    <h5 class="mb-2" id="uploadTitle">Drop image here or click to upload</h5>
                                                    <p class="text-muted mb-3" id="uploadSubtitle">Supports JPG, PNG, GIF (Max: 5MB)</p>
                                                    <input type="file" 
                                                           name="image" 
                                                           id="image"
                                                           class="form-control form-control-lg d-none @error('image') is-invalid @enderror"
                                                           accept="image/*"
                                                           required>
                                                    <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('image').click()">
                                                        <i class="fas fa-folder-open me-2"></i>Browse Files
                                                    </button>
                                                    <div id="fileName" class="mt-3 text-muted"></div>
                                                    <div id="imagePreview" class="mt-3"></div>
                                                </div>
                                                @error('image')
                                                <div class="error-message mt-2">
                                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                                </div>
                                                @enderror
                                                <div class="image-guidelines mt-3">
                                                    <div class="alert alert-info border-0">
                                                        <i class="fas fa-lightbulb me-2"></i>
                                                        <strong>Tips for a great campaign image:</strong>
                                                        <ul class="mb-0 mt-2">
                                                            <li>Use high-quality, relevant images</li>
                                                            <li>Recommended size: 1200×800 pixels</li>
                                                            <li>Show people benefiting from the campaign</li>
                                                            <li>Use bright, inspiring colors</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <div class="preview-sidebar">
                                            <h6 class="mb-3">
                                                <i class="fas fa-magic me-2"></i>Quick Preview
                                            </h6>
                                            <div class="preview-card bg-white border rounded p-3 shadow-sm">
                                                <div class="preview-image bg-light rounded mb-3" style="height: 150px; overflow: hidden;" id="sidebarPreview">
                                                    <div class="h-100 d-flex align-items-center justify-content-center">
                                                        <span class="text-muted">Image Preview</span>
                                                    </div>
                                                </div>
                                                <h6 class="mb-2" id="previewName">Campaign Name</h6>
                                                <p class="text-muted small mb-2" id="previewHeading">Heading will appear here</p>
                                                <div class="progress mb-2" style="height: 6px;">
                                                    <div class="progress-bar bg-primary" style="width: 0%"></div>
                                                </div>
                                                <div class="d-flex justify-content-between small">
                                                    <span class="text-muted">Rs. 0 raised</span>
                                                    <span class="text-muted">of Rs. 0</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Campaign Status & Options -->
                            
                            <!-- Action Buttons -->
                            <div class="form-section border-top pt-4">
                                <div class="d-flex justify-content-between align-items-center">
                                  
                                    <div>
                                        <button type="reset" class="btn btn-outline-danger me-2" onclick="clearForm()">
                                            <i class="fas fa-times me-2"></i>Clear Form
                                        </button>
                                        <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                            <i class="fas fa-rocket me-2"></i>Launch Campaign
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

<style>
.admin-causes-create {
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
    background: linear-gradient(90deg, #3498db, #2ecc71);
    border-radius: 2px;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
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

.form-label .text-danger {
    margin-left: 4px;
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

.form-control.is-invalid {
    border-color: #e74c3c;
}

.form-control.is-invalid:focus {
    box-shadow: 0 0 0 0.25rem rgba(231, 76, 60, 0.25);
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
    min-height: 150px;
}

.editor-toolbar {
    display: flex;
    gap: 5px;
}

.editor-toolbar .btn {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}

.error-message {
    color: #e74c3c;
    font-size: 0.875rem;
    padding: 0.5rem;
    background-color: rgba(231, 76, 60, 0.1);
    border-radius: 5px;
    border-left: 3px solid #e74c3c;
    animation: slideIn 0.3s ease;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-10px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.progress-preview {
    border: 2px solid #e0e6ed;
    transition: all 0.3s ease;
}

.progress-preview:hover {
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
    position: relative;
    overflow: hidden;
}

.file-upload-area:hover {
    border-color: #3498db;
    background-color: #f0f7ff;
}

.file-upload-area.dragover {
    border-color: #2ecc71;
    background-color: #e8f8f1;
}

.file-upload-area.dragover #uploadIcon i {
    color: #2ecc71;
    animation: bounce 0.5s ease infinite alternate;
}

@keyframes bounce {
    from { transform: translateY(0); }
    to { transform: translateY(-5px); }
}

#imagePreview img {
    max-width: 100%;
    max-height: 300px;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}

.preview-card {
    transition: transform 0.3s ease;
}

.preview-card:hover {
    transform: translateY(-3px);
}

.preview-card .preview-image {
    background-size: cover;
    background-position: center;
    transition: all 0.3s ease;
}

.alert-info {
    background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
    border: none;
    border-radius: 10px;
    border-left: 4px solid #17a2b8;
}

.timeline-settings, .notification-settings {
    border: 1px solid #e0e6ed;
    border-radius: 8px;
    background: white;
}

.form-check-input:checked {
    background-color: #3498db;
    border-color: #3498db;
}

.form-check-label {
    cursor: pointer;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
    padding: 0.75rem 1.5rem;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    border: none;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
}

.btn-outline-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(108, 117, 125, 0.2);
}

.btn-outline-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.2);
}

.btn-outline-info:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(23, 162, 184, 0.2);
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
    .admin-causes-create .container-fluid {
        padding-left: 15px;
        padding-right: 15px;
    }
    
    .form-section {
        padding: 1.5rem;
    }
    
    .row {
        margin-left: -10px;
        margin-right: -10px;
    }
    
    .col-md-6, .col-lg-8, .col-lg-4 {
        padding-left: 10px;
        padding-right: 10px;
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
document.addEventListener('DOMContentLoaded', function() {
    // Character counter for content textarea
    const contentTextarea = document.getElementById('content');
    const charCount = document.getElementById('charCount');
    const maxChars = 2000;
    
    if (contentTextarea && charCount) {
        // Update counter on load
        const currentLength = contentTextarea.value.length;
        charCount.textContent = `${currentLength}/${maxChars} characters`;
        charCount.className = currentLength > maxChars ? 'text-danger' : 'text-muted';
        
        // Update counter on input
        contentTextarea.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = `${length}/${maxChars} characters`;
            charCount.className = length > maxChars ? 'text-danger' : 'text-muted';
            
            if (length > maxChars) {
                this.value = this.value.substring(0, maxChars);
                charCount.textContent = `${maxChars}/${maxChars} characters (max reached)`;
            }
            
            // Update preview
            updatePreview();
        });
    }
    
    // Progress preview calculation
    const targetGoalInput = document.getElementById('target_goal');
    const raisedInput = document.getElementById('raised');
    const progressBar = document.getElementById('progressBar');
    const progressLabel = document.querySelector('.progress-label');
    const amountPreview = document.getElementById('amountPreview');
    
    function updateProgressPreview() {
        const target = parseFloat(targetGoalInput.value) || 0;
        const raised = parseFloat(raisedInput.value) || 0;
        const percent = target > 0 ? (raised / target) * 100 : 0;
        const limitedPercent = Math.min(percent, 100);
        
        if (progressBar) {
            progressBar.style.width = limitedPercent + '%';
            progressBar.className = 'progress-bar ' + 
                (limitedPercent >= 100 ? 'bg-success' : 
                 limitedPercent >= 75 ? 'bg-warning' : 'bg-primary');
        }
        
        if (progressLabel) {
            progressLabel.textContent = Math.round(limitedPercent) + '%';
        }
        
        if (amountPreview) {
            amountPreview.textContent = `Rs.${raised.toLocaleString()} / Rs.${target.toLocaleString()}`;
        }
        
        // Update sidebar preview
        updateSidebarPreview(target, raised, limitedPercent);
    }
    
    if (targetGoalInput && raisedInput) {
        targetGoalInput.addEventListener('input', updateProgressPreview);
        raisedInput.addEventListener('input', updateProgressPreview);
    }
    
    // File upload functionality
    const fileInput = document.getElementById('image');
    const dropArea = document.getElementById('dropArea');
    const fileName = document.getElementById('fileName');
    const imagePreview = document.getElementById('imagePreview');
    
    if (fileInput && dropArea) {
        fileInput.addEventListener('change', handleFileSelect);
        
        // Drag and drop functionality
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight() {
            dropArea.classList.add('dragover');
        }
        
        function unhighlight() {
            dropArea.classList.remove('dragover');
        }
        
        dropArea.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length) {
                fileInput.files = files;
                handleFileSelect();
            }
        }
        
        // Click to upload
        dropArea.addEventListener('click', function() {
            fileInput.click();
        });
    }
    
    function handleFileSelect() {
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            
            // Validate file size (5MB max)
            const maxSize = 5 * 1024 * 1024; // 5MB in bytes
            if (file.size > maxSize) {
                alert('File size must be less than 5MB');
                fileInput.value = '';
                return;
            }
            
            // Validate file type
            const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!validTypes.includes(file.type)) {
                alert('Please select a valid image file (JPG, PNG, GIF, WebP)');
                fileInput.value = '';
                return;
            }
            
            fileName.textContent = 'Selected: ' + file.name + ' (' + formatBytes(file.size) + ')';
            
            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                // Clear previous preview
                imagePreview.innerHTML = '';
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'img-fluid rounded shadow';
                imagePreview.appendChild(img);
                
                // Update sidebar preview
                const sidebarPreview = document.getElementById('sidebarPreview');
                if (sidebarPreview) {
                    sidebarPreview.style.backgroundImage = `url(${e.target.result})`;
                    sidebarPreview.style.backgroundSize = 'cover';
                    sidebarPreview.style.backgroundPosition = 'center';
                    sidebarPreview.innerHTML = '';
                }
                
                // Update upload area appearance
                dropArea.querySelector('#uploadIcon').style.display = 'none';
                dropArea.querySelector('#uploadTitle').textContent = 'Image Ready!';
                dropArea.querySelector('#uploadSubtitle').textContent = 'Click or drag to change';
            }
            reader.readAsDataURL(file);
        }
    }
    
    function formatBytes(bytes, decimals = 2) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }
    
    // Update preview sidebar
    function updatePreview() {
        const name = document.getElementById('name').value || 'Campaign Name';
        const heading = document.getElementById('heading').value || 'Heading will appear here';
        
        document.getElementById('previewName').textContent = name;
        document.getElementById('previewHeading').textContent = heading;
    }
    
    function updateSidebarPreview(target, raised, percent) {
        const sidebarProgress = document.querySelector('.preview-card .progress-bar');
        const sidebarAmounts = document.querySelectorAll('.preview-card .text-muted');
        
        if (sidebarProgress) {
            sidebarProgress.style.width = percent + '%';
        }
        
        if (sidebarAmounts.length >= 2) {
            sidebarAmounts[0].textContent = `Rs.${raised.toLocaleString()} raised`;
            sidebarAmounts[1].textContent = `of Rs.${target.toLocaleString()}`;
        }
    }
    
    // Initialize preview
    updatePreview();
    updateProgressPreview();
    
    // Add event listeners for preview updates
    document.getElementById('name').addEventListener('input', updatePreview);
    document.getElementById('heading').addEventListener('input', updatePreview);
});

// Text formatting functions
function formatText(command) {
    const textarea = document.getElementById('content');
    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const selectedText = textarea.value.substring(start, end);
    
    let formattedText = selectedText;
    switch(command) {
        case 'bold':
            formattedText = `<strong>${selectedText}</strong>`;
            break;
        case 'italic':
            formattedText = `<em>${selectedText}</em>`;
            break;
        case 'underline':
            formattedText = `<u>${selectedText}</u>`;
            break;
    }
    
    textarea.value = textarea.value.substring(0, start) + formattedText + textarea.value.substring(end);
    textarea.focus();
    textarea.setSelectionRange(start + formattedText.length, start + formattedText.length);
}

// Form actions
function previewCampaign() {
    const name = document.getElementById('name').value;
    const heading = document.getElementById('heading').value;
    
    if (!name || !heading) {
        Swal.fire({
            title: 'Incomplete Form',
            text: 'Please fill in the campaign name and heading first',
            icon: 'warning',
            confirmButtonColor: '#3498db'
        });
        return;
    }
    
    Swal.fire({
        title: 'Campaign Preview',
        html: `
            <div class="text-left">
                <h4>${name}</h4>
                <p class="text-muted">${heading}</p>
                <hr>
                <p>This is how your campaign will appear to donors. All details will be finalized upon submission.</p>
            </div>
        `,
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Looks Good!',
        cancelButtonText: 'Edit More',
        confirmButtonColor: '#3498db'
    });
}

function saveAsDraft() {
    Swal.fire({
        title: 'Save as Draft?',
        text: 'Your campaign will be saved but not published yet',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, Save Draft',
        cancelButtonText: 'Continue Editing',
        confirmButtonColor: '#3498db'
    }).then((result) => {
        if (result.isConfirmed) {
            // Add draft flag to form
            const draftInput = document.createElement('input');
            draftInput.type = 'hidden';
            draftInput.name = 'draft';
            draftInput.value = '1';
            document.getElementById('createCauseForm').appendChild(draftInput);
            
            // Submit form
            document.getElementById('createCauseForm').submit();
        }
    });
}

function clearForm() {
    Swal.fire({
        title: 'Clear Form?',
        text: 'This will reset all form fields to their default values',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, Clear All',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('createCauseForm').reset();
            
            // Clear previews
            document.getElementById('fileName').textContent = '';
            document.getElementById('imagePreview').innerHTML = '';
            document.getElementById('sidebarPreview').style.backgroundImage = '';
            document.getElementById('sidebarPreview').innerHTML = '<div class="h-100 d-flex align-items-center justify-content-center"><span class="text-muted">Image Preview</span></div>';
            
            // Reset upload area
            const dropArea = document.getElementById('dropArea');
            dropArea.querySelector('#uploadIcon').style.display = 'block';
            dropArea.querySelector('#uploadTitle').textContent = 'Drop image here or click to upload';
            dropArea.querySelector('#uploadSubtitle').textContent = 'Supports JPG, PNG, GIF (Max: 5MB)';
            
            // Reset progress preview
            updateProgressPreview();
            updatePreview();
            
            // Reset character count
            const charCount = document.getElementById('charCount');
            if (charCount) {
                charCount.textContent = '0/2000 characters';
                charCount.className = 'text-muted';
            }
        }
    });
}

// Form validation
document.getElementById('createCauseForm').addEventListener('submit', function(e) {
    const targetGoal = document.getElementById('target_goal').value;
    const raised = document.getElementById('raised').value;
    const image = document.getElementById('image').value;
    
    if (parseFloat(raised) > parseFloat(targetGoal)) {
        e.preventDefault();
        Swal.fire({
            title: 'Invalid Amount',
            text: 'Raised amount cannot exceed target goal!',
            icon: 'error',
            confirmButtonColor: '#3498db'
        });
        return;
    }
    
    if (!image) {
        e.preventDefault();
        Swal.fire({
            title: 'Image Required',
            text: 'Please upload a campaign image',
            icon: 'warning',
            confirmButtonColor: '#3498db'
        });
        return;
    }
    
    // Show loading animation
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalHtml = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating Campaign...';
    submitBtn.disabled = true;
    
    // Animation for progress bar
    const progressBar = document.getElementById('progressBar');
    if (progressBar) {
        progressBar.style.transition = 'width 2s ease';
        progressBar.style.width = '100%';
    }
});
</script>

<!-- Include SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection