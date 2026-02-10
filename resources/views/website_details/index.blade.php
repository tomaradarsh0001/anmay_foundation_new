@extends('admin.layouts.app')

@section('title', 'Website Details - Anmay Foundation')

@section('content')
<style>
    .details-container {
        padding: 10px;
        max-width: 1300px;
        margin: 0 auto;
    }

    .page-header {
        text-align: center;
        margin-bottom: 40px;
        animation: fadeInDown 0.8s ease-out;
    }

    .page-header h1 {
        font-size: 2.2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 15px;
    }

    .page-header p {
        color: #666;
        font-size: 1rem;
        max-width: 800px;
        margin: 0 auto;
    }

    .details-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        animation: fadeInUp 0.8s ease-out 0.2s both;
    }

    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 10px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .card-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
        background-size: 50px 50px;
        opacity: 0.2;
        animation: float 20s infinite linear;
    }

    .header-content {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }

    .header-content h2 {
        font-size: 1.2rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .header-content h2 i {
        background: white;
        width: 30px;
        height: 30px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #667eea;
        font-size: 1.5rem;
    }

    .edit-btn {
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

    .edit-btn:hover {
        background: white;
        color: #667eea;
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .card-body {
        padding: 20px;
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 10px;
        margin-bottom: 40px;
    }

    .detail-item {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 15px;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
    }

    .detail-item:hover {
        transform: translateY(-5px);
        border-color: #667eea;
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.1);
    }

    .detail-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
        background: linear-gradient(to bottom, #667eea, #764ba2);
        border-radius: 5px 0 0 5px;
    }

    .detail-label {
        color: #666;
        font-size: 0.9rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .detail-label i {
        color: #667eea;
        font-size: 1.2rem;
    }

    .detail-value {
        color: #333;
        font-size: 1rem;
        font-weight: 600;
        word-break: break-word;
        line-height: 1.5;
    }

    .detail-value.empty {
        color: #999;
        font-style: italic;
    }

    .social-section {
        margin-top: 40px;
        padding-top: 40px;
        border-top: 2px dashed #e0e0e0;
    }

    .section-title {
        font-size: 1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .section-title i {
        color: #667eea;
        font-size: 1.2rem;
    }

    .social-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 5px;
    }

    .social-item {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 15px;
        padding: 15px;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .social-item:hover {
        transform: translateY(-5px);
        border-color: #667eea;
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.1);
    }

    .social-icon {
        width: 40px;
        height: 40px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        margin-bottom: 20px;
        color: white;
    }

    .social-item.instagram .social-icon { background: linear-gradient(45deg, #405DE6, #5851DB, #833AB4, #C13584, #E1306C, #FD1D1D); }
    .social-item.twitter .social-icon { background: linear-gradient(45deg, #1DA1F2, #1DA1F2); }
    .social-item.facebook .social-icon { background: linear-gradient(45deg, #4267B2, #4267B2); }
    .social-item.linkedin .social-icon { background: linear-gradient(45deg, #0077B5, #0077B5); }
    .social-item.youtube .social-icon { background: linear-gradient(45deg, #FF0000, #FF0000); }

    .social-label {
        color: #666;
        font-size: 0.9rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .social-link {
        color: #333;
        font-size: 1.1rem;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: color 0.3s ease;
    }

    .social-link:hover {
        color: #667eea;
    }

    .social-link.empty {
        color: #999;
        font-style: italic;
        cursor: default;
    }

    .social-link i {
        font-size: 0.9rem;
        opacity: 0.7;
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

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes float {
        0% { transform: translate(0, 0) rotate(0deg); }
        100% { transform: translate(50px, 50px) rotate(360deg); }
    }

    @media (max-width: 768px) {
        .details-container {
            padding: 20px;
        }

        .page-header h1 {
            font-size: 2.2rem;
        }

        .card-body {
            padding: 25px;
        }

        .details-grid,
        .social-grid {
            grid-template-columns: 1fr;
        }

        .header-content {
            flex-direction: column;
            text-align: center;
        }

        .edit-btn {
            width: 100%;
            justify-content: center;
        }
    }

    .no-data {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .no-data i {
        font-size: 4rem;
        color: #ddd;
        margin-bottom: 20px;
    }

    .no-data h3 {
        font-size: 1.8rem;
        margin-bottom: 10px;
        color: #333;
    }

    .no-data p {
        margin-bottom: 30px;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }
</style>

<div class="details-container">
    <div class="page-header">
        <h1>Website Details</h1>
        <p>Manage and view all your website contact information and social media links</p>
    </div>

    @if(session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle"></i>
            <div>
                <strong>Success!</strong> {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="details-card">
        <div class="card-header">
            <div class="header-content">
                <h2 class="text-white">
                    <i class="fas fa-globe "></i>
                    Contact Information
                </h2>
                <a href="{{ route('website-details.edit') }}" class="edit-btn">
                    <i class="fas fa-edit"></i>
                    Edit Details
                </a>
            </div>
        </div>

        <div class="card-body">
            @if($detail)
                <div class="details-grid">
                    <!-- Contact Details -->
                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="fas fa-phone"></i>
                            Phone Number
                        </div>
                        <div class="detail-value {{ !$detail->phone ? 'empty' : '' }}">
                            {{ $detail->phone ?: 'Not set' }}
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="fas fa-envelope"></i>
                            Email Address
                        </div>
                        <div class="detail-value {{ !$detail->email ? 'empty' : '' }}">
                            {{ $detail->email ?: 'Not set' }}
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">
                            <i class="fas fa-map-marker-alt"></i>
                            Address
                        </div>
                        <div class="detail-value {{ !$detail->address ? 'empty' : '' }}">
                            {{ $detail->address ?: 'Not set' }}
                        </div>
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
                        <div class="social-item instagram">
                            <div class="social-icon">
                                <i class="fab fa-instagram"></i>
                            </div>
                            <div class="social-label">Instagram</div>
                            @if($detail->instagram)
                                <a href="{{ $detail->instagram }}" target="_blank" class="social-link">
                                    {{ parse_url($detail->instagram, PHP_URL_HOST) ?: $detail->instagram }}
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            @else
                                <span class="social-link empty">Not set</span>
                            @endif
                        </div>

                        <!-- Twitter -->
                        <div class="social-item twitter">
                            <div class="social-icon">
                                <i class="fab fa-twitter"></i>
                            </div>
                            <div class="social-label">Twitter</div>
                            @if($detail->twitter)
                                <a href="{{ $detail->twitter }}" target="_blank" class="social-link">
                                    {{ parse_url($detail->twitter, PHP_URL_HOST) ?: $detail->twitter }}
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            @else
                                <span class="social-link empty">Not set</span>
                            @endif
                        </div>

                        <!-- Facebook -->
                        <div class="social-item facebook">
                            <div class="social-icon">
                                <i class="fab fa-facebook-f"></i>
                            </div>
                            <div class="social-label">Facebook</div>
                            @if($detail->facebook)
                                <a href="{{ $detail->facebook }}" target="_blank" class="social-link">
                                    {{ parse_url($detail->facebook, PHP_URL_HOST) ?: $detail->facebook }}
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            @else
                                <span class="social-link empty">Not set</span>
                            @endif
                        </div>

                        <!-- LinkedIn -->
                        <div class="social-item linkedin">
                            <div class="social-icon">
                                <i class="fab fa-linkedin-in"></i>
                            </div>
                            <div class="social-label">LinkedIn</div>
                            @if($detail->linkedin)
                                <a href="{{ $detail->linkedin }}" target="_blank" class="social-link">
                                    {{ parse_url($detail->linkedin, PHP_URL_HOST) ?: $detail->linkedin }}
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            @else
                                <span class="social-link empty">Not set</span>
                            @endif
                        </div>

                        <!-- YouTube -->
                        <div class="social-item youtube">
                            <div class="social-icon">
                                <i class="fab fa-youtube"></i>
                            </div>
                            <div class="social-label">YouTube</div>
                            @if($detail->youtube)
                                <a href="{{ $detail->youtube }}" target="_blank" class="social-link">
                                    {{ parse_url($detail->youtube, PHP_URL_HOST) ?: $detail->youtube }}
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            @else
                                <span class="social-link empty">Not set</span>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="no-data">
                    <i class="fas fa-info-circle"></i>
                    <h3>No Website Details Found</h3>
                    <p>Please add your website contact information and social media links to get started.</p>
                    <a href="{{ route('website-details.edit') }}" class="edit-btn" style="width: auto; display: inline-flex;">
                        <i class="fas fa-plus"></i>
                        Add Website Details
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Additional Info -->
    @if($detail)
        <div class="mt-4 text-center text-muted">
            <small>
                <i class="fas fa-info-circle"></i>
                Last updated: {{ $detail->updated_at ? $detail->updated_at->format('F d, Y \a\t h:i A') : 'Never' }}
            </small>
        </div>
    @endif
</div>

<script>
    // Add staggered animation for detail items
    document.addEventListener('DOMContentLoaded', function() {
        const detailItems = document.querySelectorAll('.detail-item, .social-item');
        
        detailItems.forEach((item, index) => {
            item.style.animationDelay = `${index * 0.1}s`;
        });

        // Add hover effect for social links
        const socialLinks = document.querySelectorAll('.social-link:not(.empty)');
        socialLinks.forEach(link => {
            link.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(5px)';
            });
            
            link.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
            });
        });
    });
</script>
@endsection