{{-- resources/views/admin/payments/razorpay/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Razorpay Payment Management')

@section('content')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        --warning-gradient: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);
        --danger-gradient: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
        --info-gradient: linear-gradient(135deg, #36d1dc 0%, #5b86e5 100%);
        --secondary-gradient: linear-gradient(135deg, #8e2de2 0%, #4a00e0 100%);
        --razorpay-gradient: linear-gradient(135deg, #0C5ADB 0%, #2A6EF5 100%);
        --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.1);
        --shadow-sm: 0 4px 6px rgba(0, 0, 0, 0.07);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Statistics Cards */
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
        width: 240px;
        min-height: 180px;
        border: none;
        border-radius: 16px;
        background: white;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        position: relative;
        z-index: 1;
        border-left: 4px solid transparent;
    }

    @media (min-width: 768px) {
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            overflow-x: visible;
        }
        
        .stat-card {
            width: 100%;
        }
    }

    @media (min-width: 1400px) {
        .stats-container {
            grid-template-columns: repeat(4, 1fr);
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
        border-radius: 16px;
    }

    .stat-card:hover::before {
        opacity: 0.05;
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
    .stat-icon-razorpay { background: var(--razorpay-gradient); }

    .stat-value {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        text-align: center;
        line-height: 1.2;
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

    .stat-sub-label {
        color: #9ca3af;
        font-size: 0.75rem;
        text-align: center;
        margin-top: 0.5rem;
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
        background: var(--razorpay-gradient);
        border: none;
        border-radius: 10px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        color: white;
        transition: var(--transition);
        width: 100%;
        height: calc(100% - 24px);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .filter-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(12, 90, 219, 0.3);
        color: white;
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
        border: none;
    }

    .export-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(17, 153, 142, 0.3);
        color: white;
    }

    .clear-btn {
        background: linear-gradient(135deg, #6b7280 0%, #9ca3af 100%);
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

    .clear-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(107, 114, 128, 0.3);
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
        border-color: #0C5ADB;
        box-shadow: 0 0 0 3px rgba(12, 90, 219, 0.1);
    }

    .input-group-text {
        border: 2px solid #e5e7eb;
        border-right: none;
        background: #f9fafb;
        border-radius: 10px 0 0 10px;
    }

    .form-control.border-start-0 {
        border-left: none;
        border-radius: 0 10px 10px 0;
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
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
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
        min-width: 1200px;
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
    }

    .payment-table td {
        padding: 1.25rem 1rem;
        border-bottom: 1px solid #e5e7eb;
        vertical-align: middle;
    }

    @media (max-width: 768px) {
        .payment-table td,
        .payment-table th {
            padding: 0.75rem 0.5rem;
        }
    }

    .donor-info {
        min-width: 200px;
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

    .order-id {
        font-size: 0.8rem;
        font-weight: 600;
        color: #0C5ADB;
        margin-bottom: 0.25rem;
    }

    .payment-id {
        font-size: 0.7rem;
        color: #6b7280;
        word-break: break-all;
    }

    .amount-badge {
        background: var(--razorpay-gradient);
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

    .currency-badge {
        font-size: 0.7rem;
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

    .status-paid {
        background: rgba(16, 185, 129, 0.1);
        color: #047857;
    }

    .status-paid::before {
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

    .status-refunded {
        background: rgba(139, 92, 246, 0.1);
        color: #6d28d9;
    }

    .status-refunded::before {
        background: #8b5cf6;
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

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .btn-action {
        padding: 0.5rem;
        border-radius: 8px;
        transition: var(--transition);
        color: white;
        border: none;
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-view {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    }

    .btn-view:hover {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3);
        color: white;
    }

    .btn-edit {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(217, 119, 6, 0.3);
        color: white;
    }

    .failure-reason {
        max-width: 200px;
        font-size: 0.7rem;
        color: #b91c1c;
        background: rgba(239, 68, 68, 0.05);
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        margin-top: 0.5rem;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
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
        background: var(--razorpay-gradient);
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

    .razorpay-badge {
        background: var(--razorpay-gradient);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .signature-indicator {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
    }

    .signature-verified {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .signature-missing {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }
</style>

<div class="container-fluid px-3 px-md-4">
    <!-- Header with Razorpay Branding -->
    <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
        <div>
            <div class="d-flex align-items-center gap-3 mb-2">
                <h1 class="h2 mb-0" style="color: #1f2937;">Razorpay Payments</h1>
                <span class="razorpay-badge">
                    <i class="fas fa-shield-alt"></i> Razorpay
                </span>
            </div>
            <p class="text-muted mb-0">Monitor and manage all Razorpay payment transactions</p>
        </div>
        <div class="mt-3 mt-md-0">
            <a href="{{ route('admin.payments.razorpay.export', request()->query()) }}" class="export-btn">
                <i class="fas fa-download"></i>
                <span class="d-none d-sm-inline">Export CSV</span>
            </a>
        </div>
    </div>

    <!-- Statistics Grid -->
    <div class="stats-container">
        <div class="stat-card" style="border-left-color: #0C5ADB;">
            <div class="card-body p-3 p-md-4">
                <div class="stat-icon stat-icon-razorpay text-white mb-3">
                    <i class="fas fa-credit-card"></i>
                </div>
                <div class="stat-value">{{ $stats['total'] }}</div>
                <div class="stat-label">Total Payments</div>
                <div class="stat-sub-label">All Razorpay Transactions</div>
            </div>
        </div>

        <div class="stat-card" style="border-left-color: #10b981;">
            <div class="card-body p-3 p-md-4">
                <div class="stat-icon stat-icon-success text-white mb-3">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-value">{{ $stats['success'] }}</div>
                <div class="stat-label">Successful Payments</div>
                <div class="stat-sub-label">{{ $stats['success_rate'] }}% Success Rate</div>
            </div>
        </div>

        <div class="stat-card" style="border-left-color: #f59e0b;">
            <div class="card-body p-3 p-md-4">
                <div class="stat-icon stat-icon-warning text-white mb-3">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-value">{{ $stats['pending'] }}</div>
                <div class="stat-label">Pending Payments</div>
                <div class="stat-sub-label">Awaiting Confirmation</div>
            </div>
        </div>

        <div class="stat-card" style="border-left-color: #ef4444;">
            <div class="card-body p-3 p-md-4">
                <div class="stat-icon stat-icon-danger text-white mb-3">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="stat-value">{{ $stats['failed'] }}</div>
                <div class="stat-label">Failed Payments</div>
                <div class="stat-sub-label">Requires Attention</div>
            </div>
        </div>

        <div class="stat-card" style="border-left-color: #3b82f6;">
            <div class="card-body p-3 p-md-4">
                <div class="stat-icon stat-icon-info text-white mb-3">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <div class="stat-value">{{ $stats['today_total'] }}</div>
                <div class="stat-label">Today's Payments</div>
                <div class="stat-sub-label">{{ $stats['month_total'] }} This Month</div>
            </div>
        </div>

        <div class="stat-card" style="border-left-color: #11998e;">
            <div class="card-body p-3 p-md-4">
                <div class="stat-icon stat-icon-success text-white mb-3">
                    <i class="fas fa-indian-rupee-sign"></i>
                </div>
                <div class="stat-value">₹{{ number_format($stats['today_amount'], 0) }}</div>
                <div class="stat-label">Today's Amount</div>
                <div class="stat-sub-label">Avg: ₹{{ number_format($stats['avg_amount'], 0) }}</div>
            </div>
        </div>

        <div class="stat-card" style="border-left-color: #8b5cf6;">
            <div class="card-body p-3 p-md-4">
                <div class="stat-icon stat-icon-secondary text-white mb-3">
                    <i class="fas fa-coins"></i>
                </div>
                <div class="stat-value">₹{{ number_format($stats['total_amount'], 0) }}</div>
                <div class="stat-label">Total Amount</div>
                <div class="stat-sub-label">Lifetime Collection</div>
            </div>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="filter-card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0" style="color: #1f2937;">
                <i class="fas fa-filter me-2" style="color: #0C5ADB;"></i>Filter Razorpay Payments
            </h5>
        </div>
        <div class="card-body p-3 p-md-4">
            <form method="GET" action="{{ route('admin.payments.razorpay.index') }}">
                <div class="row g-2 g-md-3">
                    <div class="col-12 col-md-6 col-lg-3">
                        <label class="form-label small text-muted fw-bold">Search</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" name="search" 
                                   value="{{ request('search') }}" placeholder="Order ID, Name, Email, Phone...">
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6 col-lg-2">
                        <label class="form-label small text-muted fw-bold">Status</label>
                        <select class="form-select" name="status">
                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Status</option>
                            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                            <option value="refunded" {{ request('status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
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
                    
                    <div class="col-12 col-md-6 col-lg-1">
                        <label class="form-label small text-muted fw-bold">&nbsp;</label>
                        <button type="submit" class="filter-btn">
                            <i class="fas fa-filter"></i>
                            <span class="d-none d-md-inline">Filter</span>
                        </button>
                    </div>
                </div>
                
                @if(request()->hasAny(['search', 'status', 'date', 'start_date', 'end_date']) && request()->status != 'all')
                <div class="row mt-3">
                    <div class="col-12">
                        <a href="{{ route('admin.payments.razorpay.index') }}" class="clear-btn">
                            <i class="fas fa-times-circle"></i>
                            Clear All Filters
                        </a>
                    </div>
                </div>
                @endif
            </form>
        </div>
    </div>

    <!-- Payments Table Card -->
    <div class="table-card shadow-sm">
        <div class="card-header">
            <div>
                <h5 class="mb-1" style="color: #1f2937;">
                    <i class="fas fa-list me-2" style="color: #0C5ADB;"></i>Razorpay Transactions
                </h5>
                <p class="text-muted small mb-0">
                    Total {{ $payments->total() }} transactions found
                </p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-light text-dark px-3 py-2">
                    <i class="fas fa-rupee-sign me-1"></i> INR
                </span>
            </div>
        </div>
        
        <div class="card-body p-0">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close float-end" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close float-end" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($payments->count() > 0)
                <div class="table-container">
                    <table class="payment-table">
                        <thead>
                            <tr>
                                <th>Order Details</th>
                                <th>Donor Information</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Payment ID</th>
                                <th>Date & Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td>
                                    <div class="order-id">
                                        <i class="fas fa-hashtag" style="font-size: 0.7rem;"></i>
                                        {{ $payment->merchant_order_id }}
                                    </div>
                                    @if($payment->razorpay_order_id)
                                        <div class="payment-id">
                                            <i class="fas fa-qrcode" style="font-size: 0.7rem;"></i>
                                            {{ $payment->razorpay_order_id }}
                                        </div>
                                    @endif
                                    @if($payment->razorpay_signature)
                                        <div class="mt-2">
                                            <span class="signature-indicator signature-verified" title="Signature Verified">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            <span class="small text-success ms-1">Verified</span>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="donor-info">
                                        <div class="donor-name">
                                            <i class="fas fa-user text-muted me-1" style="font-size: 0.75rem;"></i>
                                            {{ $payment->full_name }}
                                        </div>
                                        <div class="donor-contact">
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <i class="fas fa-envelope text-muted" style="font-size: 0.7rem;"></i>
                                                <span>{{ $payment->email }}</span>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="fas fa-phone text-muted" style="font-size: 0.7rem;"></i>
                                                <span>{{ $payment->phone }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="amount-badge">₹{{ number_format($payment->amount, 2) }}</div>
                                    <div class="currency-badge">{{ $payment->currency }}</div>
                                </td>
                                <td>
                                    @php
                                        $statusClass = match($payment->status) {
                                            'paid' => 'status-paid',
                                            'pending' => 'status-pending',
                                            'failed' => 'status-failed',
                                            'refunded' => 'status-refunded',
                                            default => 'status-pending'
                                        };
                                        
                                        $statusText = match($payment->status) {
                                            'paid' => 'PAID',
                                            'pending' => 'PENDING',
                                            'failed' => 'FAILED',
                                            'refunded' => 'REFUNDED',
                                            default => strtoupper($payment->status)
                                        };
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">
                                        {{ $statusText }}
                                    </span>
                                    @if($payment->failure_reason)
                                        <div class="failure-reason">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            {{ $payment->failure_reason }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if($payment->razorpay_payment_id)
                                        <div class="payment-id">
                                            {{ $payment->razorpay_payment_id }}
                                        </div>
                                        <small class="text-success d-block mt-1">
                                            <i class="fas fa-check-circle"></i> Captured
                                        </small>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="date-time">
                                        <div class="date-primary">
                                            <i class="fas fa-calendar-alt text-muted me-1" style="font-size: 0.75rem;"></i>
                                            {{ $payment->created_at->format('d M, Y') }}
                                        </div>
                                        <div class="date-secondary">
                                            <i class="fas fa-clock text-muted me-1" style="font-size: 0.7rem;"></i>
                                            {{ $payment->created_at->format('h:i:s A') }}
                                        </div>
                                        @if($payment->status == 'paid' && $payment->updated_at != $payment->created_at)
                                            <div class="text-success small mt-1">
                                                <i class="fas fa-check-circle"></i> Paid: {{ $payment->updated_at->format('d M, h:i A') }}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.payments.razorpay.show', $payment->id) }}" 
                                           class="btn-action btn-view" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                    </div>
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
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h4 class="text-muted mb-3">No Razorpay Payments Found</h4>
                    <p class="text-muted mb-4">No transactions match your search criteria</p>
                    @if(request()->hasAny(['search', 'status', 'date', 'start_date', 'end_date']) && request()->status != 'all')
                        <a href="{{ route('admin.payments.razorpay.index') }}" class="btn" style="background: var(--razorpay-gradient); color: white; padding: 0.75rem 2rem; border-radius: 10px;">
                            <i class="fas fa-times me-2"></i>Clear All Filters
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
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-submit filters when status changes
        const statusSelect = document.querySelector('[name="status"]');
        if (statusSelect) {
            statusSelect.addEventListener('change', function() {
                if (this.value !== 'all' && this.value !== '') {
                    this.form.submit();
                }
            });
        }

        // Add hover effects to table rows
        const rows = document.querySelectorAll('.payment-table tbody tr');
        rows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#f8fafc';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.backgroundColor = 'transparent';
            });
        });

        // Tooltips for action buttons
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

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
    });

    // Confirm status update
    
</script>
@endpush