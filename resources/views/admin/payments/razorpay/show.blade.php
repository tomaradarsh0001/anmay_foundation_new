{{-- resources/views/admin/payments/razorpay/show.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Razorpay Payment Details - ' . $payment->merchant_order_id)

@section('content')
<style>
    :root {
        --razorpay-gradient: linear-gradient(135deg, #0C5ADB 0%, #2A6EF5 100%);
        --shadow-sm: 0 4px 6px rgba(0, 0, 0, 0.07);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .breadcrumb {
        background: transparent;
        padding: 0.5rem 0;
        margin-bottom: 1rem;
    }

    .breadcrumb-item a {
        color: #0C5ADB;
        text-decoration: none;
        font-weight: 500;
    }

    .breadcrumb-item a:hover {
        text-decoration: underline;
    }

    .breadcrumb-item.active {
        color: #6b7280;
    }

    .card {
        border: none;
        border-radius: 16px;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        margin-bottom: 1.5rem;
    }

    .card:hover {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background: white;
        border-bottom: 1px solid #e5e7eb;
        padding: 1.25rem 1.5rem;
        border-radius: 16px 16px 0 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .card-header h6 {
        margin: 0;
        font-size: 1rem;
        font-weight: 700;
        color: #1f2937;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .detail-item {
        border-bottom: 1px solid #f3f4f6;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
    }

    .detail-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
        margin-bottom: 0;
    }

    .detail-label {
        color: #6b7280;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .detail-value {
        font-weight: 600;
        color: #1f2937;
        font-size: 1rem;
        word-break: break-word;
    }

    .detail-value-large {
        font-size: 1.5rem;
        font-weight: 700;
        background: var(--razorpay-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .badge-status {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .badge-status::before {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
    }

    .badge-paid {
        background: rgba(16, 185, 129, 0.1);
        color: #047857;
    }

    .badge-paid::before {
        background: #10b981;
    }

    .badge-pending {
        background: rgba(245, 158, 11, 0.1);
        color: #92400e;
    }

    .badge-pending::before {
        background: #f59e0b;
    }

    .badge-failed {
        background: rgba(239, 68, 68, 0.1);
        color: #b91c1c;
    }

    .badge-failed::before {
        background: #ef4444;
    }

    .badge-refunded {
        background: rgba(139, 92, 246, 0.1);
        color: #6d28d9;
    }

    .badge-refunded::before {
        background: #8b5cf6;
    }

    .signature-badge {
        background: rgba(12, 90, 219, 0.1);
        color: #0C5ADB;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    .signature-verified {
        color: #10b981;
    }

    .signature-missing {
        color: #ef4444;
    }

    .info-box {
        background: #f9fafb;
        border-radius: 12px;
        padding: 1.25rem;
        margin-top: 1rem;
    }

    .info-box-title {
        font-size: 0.8rem;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .response-pre {
        background: #1e293b;
        color: #e2e8f0;
        padding: 1.25rem;
        border-radius: 12px;
        font-size: 0.8rem;
        line-height: 1.5;
        max-height: 400px;
        overflow: auto;
        font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
        white-space: pre-wrap;
        word-wrap: break-word;
    }

    .btn-action {
        padding: 0.6rem 1.2rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
        margin-bottom: 0.5rem;
        border: none;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        color: white;
    }

    .btn-primary-action {
        background: var(--razorpay-gradient);
        color: white;
    }

    .btn-primary-action:hover {
        box-shadow: 0 8px 15px rgba(12, 90, 219, 0.3);
    }

    .btn-success-action {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
    }

    .btn-success-action:hover {
        box-shadow: 0 8px 15px rgba(17, 153, 142, 0.3);
    }

    .btn-info-action {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
    }

    .btn-info-action:hover {
        box-shadow: 0 8px 15px rgba(59, 130, 246, 0.3);
    }

    .btn-warning-action {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }

    .btn-warning-action:hover {
        box-shadow: 0 8px 15px rgba(245, 158, 11, 0.3);
    }

    .btn-danger-action {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }

    .btn-danger-action:hover {
        box-shadow: 0 8px 15px rgba(239, 68, 68, 0.3);
    }

    .btn-secondary-action {
        background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
        color: white;
    }

    .btn-secondary-action:hover {
        box-shadow: 0 8px 15px rgba(107, 114, 128, 0.3);
    }

    .timeline {
        position: relative;
        padding-left: 1.5rem;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e5e7eb;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 1.5rem;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: -1.5rem;
        top: 0.25rem;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: white;
        border: 2px solid #0C5ADB;
    }

    .timeline-item:last-child {
        padding-bottom: 0;
    }

    .timeline-time {
        font-size: 0.75rem;
        color: #6b7280;
        margin-bottom: 0.25rem;
    }

    .timeline-title {
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.25rem;
    }

    .timeline-description {
        font-size: 0.8rem;
        color: #6b7280;
    }

    .copy-btn {
        background: transparent;
        border: 1px solid #e5e7eb;
        padding: 0.25rem 0.75rem;
        border-radius: 6px;
        font-size: 0.75rem;
        color: #6b7280;
        transition: var(--transition);
    }

    .copy-btn:hover {
        background: #f3f4f6;
        border-color: #0C5ADB;
        color: #0C5ADB;
    }

    .amount-breakdown {
        display: flex;
        align-items: baseline;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .amount-main {
        font-size: 2rem;
        font-weight: 700;
        background: var(--razorpay-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .amount-paise {
        font-size: 0.9rem;
        color: #6b7280;
        font-weight: 500;
    }

    .razorpay-icon-small {
        width: 24px;
        height: 24px;
        background: white;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 4px;
    }

    .razorpay-icon-small img {
        width: 100%;
        height: auto;
    }

    @media (max-width: 768px) {
        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.75rem;
        }
        
        .detail-item {
            padding-bottom: 0.75rem;
            margin-bottom: 0.75rem;
        }
        
        .amount-main {
            font-size: 1.75rem;
        }
    }
</style>

<div class="container-fluid px-3 px-md-4">
    <!-- Breadcrumb Navigation -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <i class="fas fa-home me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.payments.razorpay.index') }}">
                            <i class="fas fa-credit-card me-1"></i>Razorpay Payments
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $payment->merchant_order_id }}
                    </li>
                </ol>
            </nav>
            
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <h1 class="h3 mb-0" style="color: #1f2937;">Payment Details</h1>
                        <div class="razorpay-icon-small">
                            <img src="{{ asset('assets/img/razorpay.png') }}" alt="Razorpay">
                        </div>
                    </div>
                    <p class="text-muted mb-0">
                        <i class="fas fa-hashtag me-1"></i>Order ID: {{ $payment->merchant_order_id }}
                    </p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.payments.razorpay.index') }}" class="btn btn-secondary-action">
                        <i class="fas fa-arrow-left"></i>
                        <span class="d-none d-sm-inline">Back to List</span>
                    </a>
                    <button onclick="window.print()" class="btn btn-info-action">
                        <i class="fas fa-print"></i>
                        <span class="d-none d-sm-inline">Print</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Row -->
    <div class="row">
        <!-- Left Column - Main Details -->
        <div class="col-lg-8">
            <!-- Transaction Information Card -->
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6>
                        <i class="fas fa-exchange-alt" style="color: #0C5ADB;"></i>
                        Transaction Information
                    </h6>
                    @php
                        $statusClass = match($payment->status) {
                            'paid' => 'badge-paid',
                            'pending' => 'badge-pending',
                            'failed' => 'badge-failed',
                            'refunded' => 'badge-refunded',
                            default => 'badge-pending'
                        };
                        
                        $statusText = match($payment->status) {
                            'paid' => 'PAID',
                            'pending' => 'PENDING',
                            'failed' => 'FAILED',
                            'refunded' => 'REFUNDED',
                            default => strtoupper($payment->status)
                        };
                    @endphp
                    <span class="badge-status {{ $statusClass }}">
                        <i class="fas fa-circle"></i> {{ $statusText }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-item">
                                <div class="detail-label">Merchant Order ID</div>
                                <div class="detail-value">
                                    <i class="fas fa-hashtag text-muted me-1" style="font-size: 0.8rem;"></i>
                                    {{ $payment->merchant_order_id }}
                                </div>
                            </div>
                            
                            <div class="detail-item">
                                <div class="detail-label">Razorpay Order ID</div>
                                @if($payment->razorpay_order_id)
                                    <div class="detail-value">
                                        <i class="fas fa-qrcode text-muted me-1" style="font-size: 0.8rem;"></i>
                                        {{ $payment->razorpay_order_id }}
                                    </div>
                                    <div class="mt-2">
                                        @if($payment->razorpay_signature)
                                            <span class="signature-badge">
                                                <i class="fas fa-check-circle signature-verified"></i>
                                                Signature Verified
                                            </span>
                                        @else
                                            <span class="signature-badge">
                                                <i class="fas fa-times-circle signature-missing"></i>
                                                No Signature
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <div class="detail-value text-muted">Not generated yet</div>
                                @endif
                            </div>
                            
                            <div class="detail-item">
                                <div class="detail-label">Razorpay Payment ID</div>
                                @if($payment->razorpay_payment_id)
                                    <div class="detail-value">
                                        <i class="fas fa-credit-card text-muted me-1" style="font-size: 0.8rem;"></i>
                                        {{ $payment->razorpay_payment_id }}
                                    </div>
                                    <div class="mt-2">
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                            <i class="fas fa-check-circle me-1"></i> Payment Captured
                                        </span>
                                    </div>
                                @else
                                    <div class="detail-value text-muted">Payment not completed</div>
                                @endif
                            </div>
                            
                            <div class="detail-item">
                                <div class="detail-label">Currency</div>
                                <div class="detail-value">
                                    <i class="fas fa-coins text-muted me-1" style="font-size: 0.8rem;"></i>
                                    {{ $payment->currency }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="detail-item">
                                <div class="detail-label">Amount</div>
                                <div class="amount-breakdown">
                                    <span class="amount-main">₹{{ number_format($payment->amount, 2) }}</span>
                                    <span class="amount-paise">{{ intval($payment->amount * 100) }} paise</span>
                                </div>
                            </div>
                            
                            <div class="detail-item">
                                <div class="detail-label">Transaction Timeline</div>
                                <div class="timeline mt-2">
                                    <div class="timeline-item">
                                        <div class="timeline-time">{{ $payment->created_at->format('d M Y, h:i A') }}</div>
                                        <div class="timeline-title">Payment Initiated</div>
                                        <div class="timeline-description">Order created via Razorpay</div>
                                    </div>
                                    
                                    @if($payment->razorpay_payment_id)
                                    <div class="timeline-item">
                                        <div class="timeline-time">
                                            {{ $payment->updated_at->format('d M Y, h:i A') }}
                                        </div>
                                        <div class="timeline-title">
                                            @if($payment->status == 'paid')
                                                Payment Completed
                                            @elseif($payment->status == 'failed')
                                                Payment Failed
                                            @else
                                                Payment {{ ucfirst($payment->status) }}
                                            @endif
                                        </div>
                                        <div class="timeline-description">
                                            @if($payment->status == 'paid')
                                                Payment ID: {{ $payment->razorpay_payment_id }}
                                            @elseif($payment->status == 'failed' && $payment->failure_reason)
                                                Reason: {{ $payment->failure_reason }}
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            @if($payment->description)
                            <div class="detail-item">
                                <div class="detail-label">Description</div>
                                <div class="detail-value">
                                    <i class="fas fa-align-left text-muted me-1" style="font-size: 0.8rem;"></i>
                                    {{ $payment->description }}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    @if($payment->failure_reason)
                    <div class="info-box" style="background: rgba(239, 68, 68, 0.05); border-left: 4px solid #ef4444;">
                        <div class="info-box-title" style="color: #b91c1c;">
                            <i class="fas fa-exclamation-triangle"></i>
                            Failure Reason
                        </div>
                        <p class="mb-0" style="color: #b91c1c; font-weight: 500;">
                            {{ $payment->failure_reason }}
                        </p>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Donor Information Card -->
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6>
                        <i class="fas fa-user-circle" style="color: #0C5ADB;"></i>
                        Donor Information
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-item">
                                <div class="detail-label">Full Name</div>
                                <div class="detail-value">
                                    <i class="fas fa-user text-muted me-1" style="font-size: 0.8rem;"></i>
                                    {{ $payment->full_name }}
                                </div>
                            </div>
                            
                            <div class="detail-item">
                                <div class="detail-label">Email Address</div>
                                <div class="detail-value">
                                    <i class="fas fa-envelope text-muted me-1" style="font-size: 0.8rem;"></i>
                                    <a href="mailto:{{ $payment->email }}" class="text-decoration-none" style="color: #0C5ADB;">
                                        {{ $payment->email }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="detail-item">
                                <div class="detail-label">Phone Number</div>
                                <div class="detail-value">
                                    <i class="fas fa-phone text-muted me-1" style="font-size: 0.8rem;"></i>
                                    <a href="tel:{{ $payment->phone }}" class="text-decoration-none" style="color: #0C5ADB;">
                                        {{ $payment->phone }}
                                    </a>
                                </div>
                            </div>
                            
                            <div class="detail-item">
                                <div class="detail-label">Donor Since</div>
                                <div class="detail-value">
                                    <i class="fas fa-calendar-alt text-muted me-1" style="font-size: 0.8rem;"></i>
                                    {{ $payment->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="d-flex gap-2 mt-3 pt-3 border-top">
                        <a href="mailto:{{ $payment->email }}" class="btn-action btn-info-action" style="width: auto; padding: 0.5rem 1.5rem;">
                            <i class="fas fa-envelope"></i>
                            Email Donor
                        </a>
                        <a href="tel:{{ $payment->phone }}" class="btn-action btn-success-action" style="width: auto; padding: 0.5rem 1.5rem;">
                            <i class="fas fa-phone-alt"></i>
                            Call Donor
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Payment Response Card -->
            @if($payment->payment_response)
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6>
                        <i class="fas fa-code" style="color: #0C5ADB;"></i>
                        Payment Response Data
                    </h6>
                    <button class="copy-btn" onclick="copyResponseData()">
                        <i class="fas fa-copy me-1"></i> Copy JSON
                    </button>
                </div>
                <div class="card-body">
                    @php
                        $responseData = is_array($payment->payment_response) 
                            ? $payment->payment_response 
                            : json_decode($payment->payment_response, true);
                    @endphp
                    
                    <div class="response-pre" id="paymentResponseData">
                        {{ json_encode($responseData, JSON_PRETTY_PRINT) }}
                    </div>
                    
                    @if(isset($responseData['payment_details']) || isset($responseData['captured_details']))
                    <div class="row mt-4">
                        <div class="col-12">
                            <h6 class="fw-bold mb-3" style="color: #1f2937;">Parsed Payment Details</h6>
                            
                            @if(isset($responseData['payment_details']))
                            <div class="info-box">
                                <div class="info-box-title">
                                    <i class="fas fa-credit-card"></i>
                                    Payment Details
                                </div>
                                <div class="row">
                                    @if(isset($responseData['payment_details']['method']))
                                    <div class="col-md-4 mb-2">
                                        <div class="small text-muted">Method</div>
                                        <div class="fw-bold">{{ $responseData['payment_details']['method'] }}</div>
                                    </div>
                                    @endif
                                    
                                    @if(isset($responseData['payment_details']['bank']))
                                    <div class="col-md-4 mb-2">
                                        <div class="small text-muted">Bank</div>
                                        <div class="fw-bold">{{ $responseData['payment_details']['bank'] }}</div>
                                    </div>
                                    @endif
                                    
                                    @if(isset($responseData['payment_details']['wallet']))
                                    <div class="col-md-4 mb-2">
                                        <div class="small text-muted">Wallet</div>
                                        <div class="fw-bold">{{ $responseData['payment_details']['wallet'] }}</div>
                                    </div>
                                    @endif
                                    
                                    @if(isset($responseData['payment_details']['vpa']))
                                    <div class="col-md-4 mb-2">
                                        <div class="small text-muted">VPA</div>
                                        <div class="fw-bold">{{ $responseData['payment_details']['vpa'] }}</div>
                                    </div>
                                    @endif
                                    
                                    @if(isset($responseData['payment_details']['fee']))
                                    <div class="col-md-4 mb-2">
                                        <div class="small text-muted">Fee</div>
                                        <div class="fw-bold">₹{{ $responseData['payment_details']['fee'] / 100 }}</div>
                                    </div>
                                    @endif
                                    
                                    @if(isset($responseData['payment_details']['tax']))
                                    <div class="col-md-4 mb-2">
                                        <div class="small text-muted">Tax</div>
                                        <div class="fw-bold">₹{{ $responseData['payment_details']['tax'] / 100 }}</div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif
                            
                            @if(isset($responseData['captured_details']))
                            <div class="info-box mt-3">
                                <div class="info-box-title">
                                    <i class="fas fa-check-circle" style="color: #10b981;"></i>
                                    Capture Details
                                </div>
                                <div class="row">
                                    @if(isset($responseData['captured_details']['captured_at']))
                                    <div class="col-md-6 mb-2">
                                        <div class="small text-muted">Captured At</div>
                                        <div class="fw-bold">{{ $responseData['captured_details']['captured_at'] }}</div>
                                    </div>
                                    @endif
                                    
                                    @if(isset($responseData['captured_details']['status']))
                                    <div class="col-md-6 mb-2">
                                        <div class="small text-muted">Capture Status</div>
                                        <div class="fw-bold text-success">{{ $responseData['captured_details']['status'] }}</div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
        
        <!-- Right Column - Sidebar -->
        <div class="col-lg-4">
            <!-- Summary Card -->
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6>
                        <i class="fas fa-chart-pie" style="color: #0C5ADB;"></i>
                        Payment Summary
                    </h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="amount-main" style="font-size: 2.5rem;">₹{{ number_format($payment->amount, 2) }}</div>
                        <div class="text-muted">{{ $payment->currency }}</div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                        <span class="text-muted">Status</span>
                        <span class="badge-status {{ $statusClass }}">
                            {{ $statusText }}
                        </span>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                        <span class="text-muted">Payment ID</span>
                        <span class="fw-bold">{{ $payment->razorpay_payment_id ?? 'N/A' }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                        <span class="text-muted">Order ID</span>
                        <span class="fw-bold text-truncate" style="max-width: 200px;">{{ $payment->razorpay_order_id ?? 'N/A' }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                        <span class="text-muted">Created On</span>
                        <span class="fw-bold">{{ $payment->created_at->format('d M Y') }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                        <span class="text-muted">Last Updated</span>
                        <span class="fw-bold">{{ $payment->updated_at->format('d M Y, h:i A') }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Signature</span>
                        @if($payment->razorpay_signature)
                            <span class="text-success">
                                <i class="fas fa-check-circle"></i> Verified
                            </span>
                        @else
                            <span class="text-muted">
                                <i class="fas fa-times-circle"></i> Not Available
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Actions Card -->
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6>
                        <i class="fas fa-cog" style="color: #0C5ADB;"></i>
                        Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.payments.razorpay.index') }}" class="btn-action btn-secondary-action">
                            <i class="fas fa-list"></i>
                            Back to Payments List
                        </a>
                        
                        @if($payment->status == 'pending')
                        <button type="button" class="btn-action btn-warning-action" data-bs-toggle="modal" data-bs-target="#updateStatusModal">
                            <i class="fas fa-edit"></i>
                            Update Status
                        </button>
                        @endif
                        
                        @if($payment->status == 'pending' || $payment->status == 'failed')
                        <form action="{{ route('admin.payments.razorpay.destroy', $payment->id) }}" 
                              method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this payment record? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-danger-action">
                                <i class="fas fa-trash"></i>
                                Delete Record
                            </button>
                        </form>
                        @endif
                        
                        @if($payment->status == 'paid' && $payment->razorpay_payment_id)
                        <button type="button" class="btn-action btn-info-action" onclick="window.open('https://dashboard.razorpay.com/app/payments/{{ $payment->razorpay_payment_id }}', '_blank')">
                            <i class="fas fa-external-link-alt"></i>
                            View on Razorpay
                        </button>
                        @endif
                        
                        <button type="button" class="btn-action btn-success-action" onclick="window.location.href='mailto:{{ $payment->email }}?subject=Donation Payment Status - {{ $payment->merchant_order_id }}&body=Dear {{ $payment->full_name }},%0D%0A%0D%0AThank you for your donation.'">
                            <i class="fas fa-paper-plane"></i>
                            Send Email
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Raw Data Card -->
            @if($payment->razorpay_order_id || $payment->razorpay_payment_id || $payment->razorpay_signature)
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6>
                        <i class="fas fa-database" style="color: #0C5ADB;"></i>
                        Raw Data
                    </h6>
                    <button class="copy-btn" onclick="copyRawData()">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="response-pre" style="max-height: 200px;" id="rawData">
                        {
                            "merchant_order_id": "{{ $payment->merchant_order_id }}",
                            "razorpay_order_id": "{{ $payment->razorpay_order_id }}",
                            "razorpay_payment_id": "{{ $payment->razorpay_payment_id }}",
                            "razorpay_signature": "{{ $payment->razorpay_signature }}",
                            "amount": {{ $payment->amount }},
                            "currency": "{{ $payment->currency }}",
                            "status": "{{ $payment->status }}"
                        }
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Update Status Modal -->
@if($payment->status == 'pending')
<div class="modal fade" id="updateStatusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-edit me-2" style="color: #0C5ADB;"></i>
                    Update Payment Status
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.payments.razorpay.status', $payment->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Order ID</label>
                        <input type="text" class="form-control bg-light" value="{{ $payment->merchant_order_id }}" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Donor Name</label>
                        <input type="text" class="form-control bg-light" value="{{ $payment->full_name }}" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Amount</label>
                        <input type="text" class="form-control bg-light" value="₹{{ number_format($payment->amount, 2) }}" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Current Status</label>
                        <div>
                            <span class="badge-status badge-pending">
                                {{ strtoupper($payment->status) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Update Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="">Select Status</option>
                            <option value="paid">Paid (Success)</option>
                            <option value="failed">Failed</option>
                            <option value="refunded">Refunded</option>
                            <option value="pending">Keep Pending</option>
                        </select>
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Updating status to "Paid" will mark this transaction as successful.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn" style="background: var(--razorpay-gradient); color: white;">
                        <i class="fas fa-save me-1"></i> Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@endsection

@push('scripts')
<script>
    function copyResponseData() {
        const data = document.getElementById('paymentResponseData').innerText;
        navigator.clipboard.writeText(data).then(() => {
            alert('Payment response data copied to clipboard!');
        }).catch(() => {
            alert('Failed to copy data');
        });
    }

    function copyRawData() {
        const data = document.getElementById('rawData').innerText;
        navigator.clipboard.writeText(data).then(() => {
            alert('Raw data copied to clipboard!');
        }).catch(() => {
            alert('Failed to copy data');
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Auto-hide alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                if (alert) {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        alert.remove();
                    }, 500);
                }
            }, 5000);
        });

        // Add tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush

@push('styles')
<style>
    @media print {
        .btn, .modal, .card-header button, .breadcrumb, .footer, nav {
            display: none !important;
        }
        
        .card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }
        
        body {
            background-color: white !important;
        }
    }
</style>
@endpush