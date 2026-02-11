@extends('admin.layouts.app')

@section('title', 'Admin - Submissions')

@section('content')
<div class="admin-submission-details">
    <div class="container py-5">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="page-title mb-2">Submission Details</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('submissions.index') }}" class="text-decoration-none">Submissions</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $submission->name }}</li>
                    </ol>
                </nav>
            </div>
            <div class="action-buttons">
                <a href="{{ route('submissions.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to List
                </a>
            </div>
        </div>

        <!-- Main Card -->
        <div class="card shadow-lg border-0">
            <!-- Card Header -->
            <div class="card-header bg-gradient-primary text-white py-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="mb-1 h4">
                            <i class="fas fa-file-alt me-2"></i>Contact Submission
                        </h2>
                        <small class="opacity-75">Submitted on {{ $submission->created_at->format('F d, Y \a\t h:i A') }}</small>
                    </div>
                    <span class="badge bg-white text-primary px-3 py-2 rounded-pill">
                        <i class="fas fa-id-card me-1"></i> ID: #{{ $submission->id }}
                    </span>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="row">
                    <!-- Personal Information Section -->
                    <div class="col-lg-6 mb-4">
                        <div class="info-section">
                            <h3 class="section-title mb-4">
                                <i class="fas fa-user-circle me-2 text-primary"></i>Personal Information
                            </h3>
                            
                            <div class="info-item mb-3">
                                <div class="info-label">
                                    <i class="fas fa-user me-2 text-muted"></i>Full Name
                                </div>
                                <div class="info-value">
                                    {{ $submission->name }}
                                </div>
                            </div>

                            <div class="info-item mb-3">
                                <div class="info-label">
                                    <i class="fas fa-envelope me-2 text-muted"></i>Email Address
                                </div>
                                <div class="info-value">
                                    <a href="mailto:{{ $submission->email }}" class="text-decoration-none">
                                        {{ $submission->email }}
                                        <i class="fas fa-external-link-alt ms-1 text-primary"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-calendar-alt me-2 text-muted"></i>Submission Date
                                </div>
                                <div class="info-value">
                                    {{ $submission->created_at->format('M d, Y') }}
                                    <span class="text-muted ms-2">({{ $submission->created_at->diffForHumans() }})</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Subject & Message Section -->
                    <div class="col-lg-6 mb-4">
                        <div class="info-section">
                            <h3 class="section-title mb-4">
                                <i class="fas fa-comment-dots me-2 text-primary"></i>Message Details
                            </h3>

                            <div class="info-item mb-3">
                                <div class="info-label">
                                    <i class="fas fa-tag me-2 text-muted"></i>Subject
                                </div>
                                <div class="info-value">
                                    @if($submission->subject)
                                        <span class="badge bg-primary-light text-primary rounded-pill px-3 py-1">
                                            {{ $submission->subject }}
                                        </span>
                                    @else
                                        <span class="text-muted fst-italic">No subject provided</span>
                                    @endif
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-comment me-2 text-muted"></i>Message
                                </div>
                                <div class="info-value mt-2">
                                    @if($submission->comment)
                                        <div class="message-content p-3 bg-light rounded">
                                            {{ $submission->comment }}
                                        </div>
                                    @else
                                        <span class="text-muted fst-italic">No message provided</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CV Attachment Section -->
                @if($submission->cv)
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="info-section">
                            <h3 class="section-title mb-4">
                                <i class="fas fa-file-pdf me-2 text-primary"></i>Attachments
                            </h3>
                            
                            <div class="attachment-card bg-light rounded p-4">
                                <div class="d-flex align-items-center">
                                    <div class="attachment-icon me-3">
                                        <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1">Curriculum Vitae (CV)</h5>
                                        <p class="text-muted mb-2">Submitted by candidate</p>
                                        <a href="{{ asset('storage/'.$submission->cv) }}" 
                                           target="_blank" 
                                           class="btn btn-primary btn-sm me-2">
                                            <i class="fas fa-download me-1"></i>Download CV
                                        </a>
                                        <a href="{{ asset('storage/'.$submission->cv) }}" 
                                           target="_blank" 
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-eye me-1"></i>Preview
                                        </a>
                                    </div>
                                    <div class="text-end">
                                        <small class="text-muted">PDF Document</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="row mt-5 pt-4 border-top">
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('submissions.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Back to List
                                </a>
                                <button type="button" class="btn btn-outline-info ms-2" onclick="window.print()">
                                    <i class="fas fa-print me-2"></i>Print
                                </button>
                            </div>
                            <div>
                                <a href="mailto:{{ $submission->email }}" class="btn btn-primary">
                                    <i class="fas fa-reply me-2"></i>Reply
                                </a>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.admin-submission-details {
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

.bg-primary-light {
    background-color: rgba(52, 152, 219, 0.1);
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

.info-section {
    background: white;
    padding: 1.5rem;
    border-radius: 10px;
    border: 1px solid #eef1f6;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
}

.info-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.info-label {
    flex: 0 0 150px;
    color: #7f8c8d;
    font-weight: 500;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-value {
    flex: 1;
    color: #2c3e50;
    font-size: 1rem;
    font-weight: 500;
}

.message-content {
    background: #f8f9fa;
    border-left: 4px solid #3498db;
    font-size: 0.95rem;
    line-height: 1.6;
    white-space: pre-wrap;
    word-break: break-word;
}

.attachment-card {
    border: 2px dashed #e0e6ed;
    transition: all 0.3s ease;
}

.attachment-card:hover {
    border-color: #3498db;
    background: #f8fafc;
    transform: translateY(-2px);
}

.btn {
    border-radius: 8px;
    font-weight: 500;
    padding: 0.5rem 1.25rem;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    border: none;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
}

.btn-outline-secondary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(108, 117, 125, 0.2);
}

.badge {
    font-weight: 500;
    letter-spacing: 0.3px;
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

/* Responsive Design */
@media (max-width: 768px) {
    .admin-submission-details .container {
        padding-left: 15px;
        padding-right: 15px;
    }
    
    .info-item {
        flex-direction: column;
        margin-bottom: 1.5rem;
    }
    
    .info-label {
        flex: none;
        margin-bottom: 0.25rem;
    }
    
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 1rem;
    }
    
    .action-buttons {
        width: 100%;
    }
    
    .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
}
</style>
@endsection