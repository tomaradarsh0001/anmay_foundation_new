@extends('admin.layouts.app')

@section('title', 'Payment Management')

@section('content')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        --warning-gradient: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);
        --danger-gradient: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
        --info-gradient: linear-gradient(135deg, #36d1dc 0%, #5b86e5 100%);
        --secondary-gradient: linear-gradient(135deg, #8e2de2 0%, #4a00e0 100%);
        --today-amount-gradient: linear-gradient(135deg, #11d62b 0%, #1aab2b 100%);
        --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.1);
        --shadow-sm: 0 4px 6px rgba(0, 0, 0, 0.07);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Statistics Cards - Responsive */
    .stats-container {
        display: flex;
        overflow-x: auto;
        gap: 1rem;
        padding-bottom: 0.5rem;
        margin-bottom: 2rem;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    .stats-container::-webkit-scrollbar {
        display: none;
    }
    
    .stat-card {
        flex: 0 0 auto;
        width: 220px;
        min-height: 180px;
        border: none;
        border-radius: 16px;
        background: white;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        position: relative;
        z-index: 1;
    }

    @media (min-width: 768px) {
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
            overflow-x: visible;
        }
        
        .stat-card {
            width: 100%;
        }
    }

    @media (min-width: 1400px) {
        .stats-container {
            grid-template-columns: repeat(7, 1fr);
        }
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg) !important;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--primary-gradient);
        opacity: 0;
        transition: var(--transition);
        z-index: -1;
    }

    .stat-card:hover::before {
        opacity: 0.1;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin: 0 auto 1rem;
    }

    .stat-icon-primary { background: var(--primary-gradient); }
    .stat-icon-success { background: var(--success-gradient); }
    .stat-icon-warning { background: var(--warning-gradient); }
    .stat-icon-danger { background: var(--danger-gradient); }
    .stat-icon-info { background: var(--info-gradient); }
    .stat-icon-secondary { background: var(--secondary-gradient); }
    .stat-icon-today-amount { background: var(--today-amount-gradient); }

    .stat-value {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        text-align: center;
        line-height: 1.2;
    }
    
    .stat-card:nth-child(1) .stat-value {
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .stat-card:nth-child(2) .stat-value {
        background: var(--success-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .stat-card:nth-child(3) .stat-value {
        background: var(--warning-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .stat-card:nth-child(4) .stat-value {
        background: var(--danger-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .stat-card:nth-child(5) .stat-value {
        background: var(--info-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .stat-card:nth-child(6) .stat-value {
        background: var(--today-amount-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .stat-card:nth-child(7) .stat-value {
        background: var(--secondary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stat-label {
        color: #6b7280;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        text-align: center;
        line-height: 1.4;
    }

    /* Filter Card */
    .filter-card {
        border: none;
        border-radius: 16px;
        background: white;
        box-shadow: var(--shadow-sm);
        margin-bottom: 2rem;
    }

    .filter-card .card-header {
        background: white;
        border-bottom: 1px solid #e5e7eb;
        padding: 1.5rem;
        border-radius: 16px 16px 0 0;
    }

    .filter-btn {
        background: var(--primary-gradient);
        border: none;
        border-radius: 10px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        color: white;
        transition: var(--transition);
        width: 100%;
        height: calc(100% - 24px);
    }

    .filter-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(102, 126, 234, 0.3);
        color: white;
    }

    .form-control, .form-select {
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        transition: var(--transition);
        width: 100%;
    }

    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .input-group-text {
        border: 2px solid #e5e7eb;
        border-right: none;
        background: #f9fafb;
    }

    .form-control.border-start-0 {
        border-left: none;
    }

    /* Table Card */
    .table-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        background: white;
        box-shadow: var(--shadow-sm);
        margin-top: 2rem;
    }

    .table-card .card-header {
        background: white;
        border-bottom: 1px solid #e5e7eb;
        padding: 1.5rem;
    }

    .table-container {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    @media (max-width: 768px) {
        .table-container {
            margin: 0 -1rem;
            padding: 0 1rem;
        }
    }

    .payment-table {
        width: 100%;
        min-width: 900px;
        border-collapse: separate;
        border-spacing: 0;
    }

    .payment-table thead th {
        background: #f9fafb;
        color: #374151;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        padding: 1rem;
        border-bottom: 2px solid #e5e7eb;
        white-space: nowrap;
    }

    .payment-table tbody tr {
        transition: var(--transition);
    }

    .payment-table tbody tr:hover {
        background: #f8fafc;
        transform: scale(1.002);
    }

    .payment-table td {
        padding: 1.25rem 1rem;
        border-bottom: 1px solid #e5e7eb;
        vertical-align: middle;
    }

    /* Mobile Responsive Table */
    @media (max-width: 768px) {
        .payment-table {
            font-size: 0.875rem;
        }
        
        .payment-table td,
        .payment-table th {
            padding: 0.75rem 0.5rem;
        }
    }

    .donor-info {
        min-width: 180px;
    }

    .donor-name {
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.25rem;
        font-size: 0.95rem;
    }

    .donor-contact {
        font-size: 0.75rem;
        color: #6b7280;
    }

    .amount-badge {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        display: inline-block;
        text-align: center;
        min-width: 100px;
    }

    @media (max-width: 768px) {
        .amount-badge {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            min-width: 80px;
        }
    }

    .amount-paise {
        font-size: 0.75rem;
        color: #6b7280;
        margin-top: 0.25rem;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        white-space: nowrap;
    }

    @media (max-width: 768px) {
        .status-badge {
            padding: 0.375rem 0.75rem;
            font-size: 0.7rem;
        }
    }

    .status-badge::before {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
        flex-shrink: 0;
    }

    .status-success {
        background: rgba(16, 185, 129, 0.1);
        color: #047857;
    }

    .status-success::before {
        background: #10b981;
    }

    .status-pending {
        background: rgba(245, 158, 11, 0.1);
        color: #92400e;
    }

    .status-pending::before {
        background: #f59e0b;
    }

    .status-failed {
        background: rgba(239, 68, 68, 0.1);
        color: #b91c1c;
    }

    .status-failed::before {
        background: #ef4444;
    }

    .status-processing {
        background: rgba(59, 130, 246, 0.1);
        color: #1d4ed8;
    }

    .status-processing::before {
        background: #3b82f6;
    }

    .method-badge {
        background: #e0e7ff;
        color: #3730a3;
        padding: 0.375rem 0.75rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 500;
        display: inline-block;
    }

    .date-time {
        font-size: 0.875rem;
        min-width: 140px;
    }

    .date-primary {
        color: #1f2937;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .date-secondary {
        color: #6b7280;
        font-size: 0.75rem;
    }

    .export-btn {
        background: var(--success-gradient);
        border: none;
        border-radius: 10px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        color: white;
        transition: var(--transition);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .export-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(17, 153, 142, 0.3);
        color: white;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
    }

    .empty-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 1.75rem;
        color: #9ca3af;
    }

    /* Pagination */
    .pagination-container {
        background: #f9fafb;
        padding: 1.25rem;
        border-radius: 0 0 16px 16px;
    }

    @media (max-width: 768px) {
        .pagination-container {
            padding: 1rem;
        }
    }

    .pagination .page-link {
        border: none;
        color: #6b7280;
        padding: 0.5rem 0.75rem;
        margin: 0 0.125rem;
        border-radius: 8px;
        transition: var(--transition);
        font-size: 0.875rem;
    }

    @media (max-width: 576px) {
        .pagination .page-link {
            padding: 0.375rem 0.5rem;
            font-size: 0.8rem;
        }
    }

    .pagination .page-link:hover {
        background: #e5e7eb;
        color: #374151;
    }

    .pagination .page-item.active .page-link {
        background: var(--primary-gradient);
        color: white;
    }

    /* Alerts */
    .alert {
        border: none;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        margin: 1rem 1.25rem;
        font-size: 0.95rem;
    }

    @media (max-width: 768px) {
        .alert {
            margin: 1rem;
            padding: 0.875rem 1rem;
        }
    }

    .alert-success {
        background: rgba(16, 185, 129, 0.1);
        border-left: 4px solid #10b981;
        color: #047857;
    }

    .alert-danger {
        background: rgba(239, 68, 68, 0.1);
        border-left: 4px solid #ef4444;
        color: #b91c1c;
    }

    /* Form Responsive */
    @media (max-width: 768px) {
        .filter-card .card-body {
            padding: 1rem !important;
        }
        
        .form-label {
            font-size: 0.8rem;
        }
        
        .form-control, .form-select {
            padding: 0.625rem 0.75rem;
            font-size: 0.875rem;
        }
        
        .input-group-text {
            padding: 0.625rem 0.75rem;
        }
    }

    /* Header */
    .page-header {
        margin-bottom: 2rem;
    }

    @media (max-width: 768px) {
        .page-header {
            margin-bottom: 1.5rem;
        }
        
        .page-header h1 {
            font-size: 1.5rem !important;
        }
        
        .page-header p {
            font-size: 0.875rem;
        }
    }

    /* Button Responsive */
    .btn {
        border-radius: 10px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: var(--transition);
        font-size: 0.95rem;
    }

    @media (max-width: 768px) {
        .btn {
            padding: 0.625rem 1.25rem;
            font-size: 0.875rem;
        }
    }

    /* Grid Responsive */
    @media (max-width: 576px) {
        .row.g-3 {
            margin-left: -0.5rem;
            margin-right: -0.5rem;
        }
        
        .row.g-3 > [class*="col-"] {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }
    }
</style>

<div class="container-fluid px-3 px-md-4">
    <!-- Header -->
    <div class="page-header">
        <div>
            <h1 class="h2 mb-2" style="color: #1f2937;">Payment Management</h1>
            <p class="text-muted mb-0">Monitor and manage all payment transactions</p>
        </div>
    </div>

    <!-- Statistics Grid -->
    <div class="stats-container">
        <div class="stat-card" style="border-left: 4px solid #667eea;">
            <div class="card-body p-3 p-md-4">
                <div class="stat-icon stat-icon-primary text-white mb-3">
                    <i class="fas fa-receipt"></i>
                </div>
                <div class="stat-value">{{ $stats['total'] }}</div>
                <div class="stat-label">Total Payments</div>
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid #10b981;">
            <div class="card-body p-3 p-md-4">
                <div class="stat-icon stat-icon-success text-white mb-3">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-value">{{ $stats['success'] }}</div>
                <div class="stat-label">Successful Payments</div>
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid #f59e0b;">
            <div class="card-body p-3 p-md-4">
                <div class="stat-icon stat-icon-warning text-white mb-3">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-value">{{ $stats['pending'] }}</div>
                <div class="stat-label">Pending Payments</div>
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid #ef4444;">
            <div class="card-body p-3 p-md-4">
                <div class="stat-icon stat-icon-danger text-white mb-3">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="stat-value">{{ $stats['failed'] }}</div>
                <div class="stat-label">Failed Payments</div>
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid #3b82f6;">
            <div class="card-body p-3 p-md-4">
                <div class="stat-icon stat-icon-info text-white mb-3">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <div class="stat-value">{{ $stats['today_total'] }}</div>
                <div class="stat-label">Today's Payments</div>
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid #11d62b;">
            <div class="card-body p-3 p-md-4">
                <div class="stat-icon stat-icon-today-amount text-white mb-3">
                    <i class="fas fa-indian-rupee-sign"></i>
                </div>
                <div class="stat-value">₹{{ number_format($stats['today_amount'], 2) }}</div>
                <div class="stat-label">Today's Amount</div>
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid #8b5cf6;">
            <div class="card-body p-3 p-md-4">
                <div class="stat-icon stat-icon-secondary text-white mb-3">
                    <i class="fas fa-rupee-sign"></i>
                </div>
                <div class="stat-value">₹{{ number_format($stats['total_amount'], 0) }}</div>
                <div class="stat-label">Total Amount</div>
            </div>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="filter-card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0" style="color: #1f2937;"><i class="fas fa-filter me-2"></i>Filter Payments</h5>
        </div>
        <div class="card-body p-3 p-md-4">
            <form method="GET" action="{{ route('admin.payments.index') }}">
                <div class="row g-2 g-md-3">
                    <div class="col-12 col-md-6 col-lg-3">
                        <label class="form-label small text-muted fw-bold">Search</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" name="search" 
                                   value="{{ request('search') }}" placeholder="Order ID, Name, Email...">
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6 col-lg-2">
                        <label class="form-label small text-muted fw-bold">Status</label>
                        <select class="form-select" name="status">
                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Status</option>
                            <option value="COMPLETED" {{ request('status') == 'COMPLETED' ? 'selected' : '' }}>Success</option>
                            <option value="PENDING" {{ request('status') == 'PENDING' ? 'selected' : '' }}>Pending</option>
                            <option value="FAILED" {{ request('status') == 'FAILED' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>
                    
                    <div class="col-12 col-md-6 col-lg-2">
                        <label class="form-label small text-muted fw-bold">Single Date</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-calendar text-muted"></i>
                            </span>
                            <input type="date" class="form-control border-start-0" name="date" 
                                   value="{{ request('date') }}">
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6 col-lg-2">
                        <label class="form-label small text-muted fw-bold">Start Date</label>
                        <input type="date" class="form-control" name="start_date" 
                               value="{{ request('start_date') }}">
                    </div>
                    
                    <div class="col-12 col-md-6 col-lg-2">
                        <label class="form-label small text-muted fw-bold">End Date</label>
                        <input type="date" class="form-control" name="end_date" 
                               value="{{ request('end_date') }}">
                    </div>
                    
                    <div class="col-12 col-md-6 col-lg-1 d-flex align-items-end">
                        <button type="submit" class="filter-btn">
                            <i class="fas fa-filter me-1 me-md-2"></i>
                            <span class="d-none d-md-inline">Filter</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Payments Table Card -->
    <div class="table-card shadow-sm">
        <div class="card-body p-0">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                </div>
            @endif

            @if($payments->count() > 0)
                <div class="table-container">
                    <table class="payment-table">
                        <thead>
                            <tr>
                                <th style="min-width: 150px;">Order Details</th>
                                <th style="min-width: 180px;">Donor Information</th>
                                <th style="min-width: 110px;">Amount</th>
                                <th style="min-width: 120px;">Status</th>
                                <th style="min-width: 100px;">Method</th>
                                <th style="min-width: 140px;">Date & Time</th>
                                <th style="min-width: 140px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td>
                                    <div class="fw-bold text-primary">{{ $payment->merchant_order_id }}</div>
                                    @if(!empty($payment->transaction_id))
                                        <div class="small text-muted mt-1">TX: {{ $payment->transaction_id }}</div>
                                    @endif
                                </td>
                                <td>
                                    <div class="donor-info">
                                        <div class="donor-name">{{ $payment->donor_name }}</div>
                                        <div class="donor-contact">
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <i class="fas fa-envelope text-muted" style="font-size: 0.75rem;"></i>
                                                <span>{{ $payment->donor_email }}</span>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="fas fa-phone text-muted" style="font-size: 0.75rem;"></i>
                                                <span>{{ $payment->donor_phone }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="amount-badge">₹{{ number_format($payment->amount, 2) }}</div>
                                    @if($payment->amount_paise)
                                        <div class="amount-paise">{{ $payment->amount_paise }} paise</div>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $statusClass = match($payment->status) {
                                            'SUCCESS' => 'status-success',
                                            'PENDING' => 'status-pending',
                                            'FAILED' => 'status-failed',
                                            'PROCESSING' => 'status-processing',
                                            default => 'status-pending'
                                        };
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">
                                        {{ $payment->status }}
                                    </span>
                                    @if($payment->error_message)
                                        <div class="small text-danger mt-2">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            {{ Str::limit($payment->error_message, 25) }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($payment->payment_method))
                                        <span class="method-badge">
                                            <i class="fas fa-wallet me-1"></i>
                                            <span class="d-none d-md-inline">{{ $payment->payment_method }}</span>
                                            <span class="d-inline d-md-none">{{ Str::limit($payment->payment_method, 10) }}</span>
                                        </span>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="date-time">
                                        <div class="date-primary">{{ $payment->created_at->format('d M Y') }}</div>
                                        <div class="date-secondary">{{ $payment->created_at->format('h:i A') }}</div>
                                        @if($payment->payment_date)
                                            <div class="text-success small mt-1">
                                                <i class="fas fa-check me-1"></i>Paid: {{ $payment->payment_date->format('d M, h:i A') }}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                     <a href="{{ route('admin.payments.show', $payment->id) }}" 
                                       class="btn btn-sm btn-info" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($payments->hasPages())
                <div class="pagination-container">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                        <div class="text-muted small text-center text-md-start">
                            Showing <span class="fw-bold">{{ $payments->firstItem() }}</span> to 
                            <span class="fw-bold">{{ $payments->lastItem() }}</span> of 
                            <span class="fw-bold">{{ $payments->total() }}</span> entries
                        </div>
                        <nav>
                            {{ $payments->withQueryString()->links('pagination::bootstrap-4') }}
                        </nav>
                    </div>
                </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <h4 class="text-muted mb-3">No payments found</h4>
                    <p class="text-muted mb-4">Try adjusting your filters or search criteria</p>
                    @if(request()->hasAny(['search', 'status', 'date', 'start_date', 'end_date']))
                        <a href="{{ route('admin.payments.index') }}" class="btn btn-primary">
                            <i class="fas fa-times me-2"></i>Clear Filters
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function confirmDelete(id) {
        const form = document.getElementById('deleteForm');
        form.action = "{{ route('admin.payments.destroy', '') }}/" + id;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }

    // Auto-submit filters when status changes
    document.querySelector('[name="status"]').addEventListener('change', function() {
        if(this.value !== 'all') {
            this.form.submit();
        }
    });

    // Add hover effects to table rows
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('.payment-table tbody tr');
        rows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.cursor = 'pointer';
                this.style.transform = 'scale(1.002)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });
    });
</script>
@endpush