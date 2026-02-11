@extends('admin.layouts.app')

@section('title', 'Donations - Anmay Foundation')

@section('content')
<div class="admin-donations-index">
    <div class="container-fluid py-5">
        <!-- Header Section with Stats -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="page-title mb-2">Donation Management</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Donations</li>
                            </ol>
                        </nav>
                    </div>
                 
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-5">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card bg-primary text-white shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2 opacity-75">Total Donations</h6>
                                <h2 class="card-title mb-0">{{ $donations->count() }}</h2>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-hand-holding-heart fa-2x opacity-75"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <small class="opacity-75">All time contributions</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card bg-success text-white shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2 opacity-75">Total Amount</h6>
                                <h2 class="card-title mb-0">₹{{ number_format($donations->sum('amount'), 2) }}</h2>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-rupee-sign fa-2x opacity-75"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <small class="opacity-75">Sum of all donations</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                @php
                    $verifiedCount = $donations->where('status', 'verified')->count();
                    $verifiedPercent = $donations->count() > 0 ? ($verifiedCount / $donations->count()) * 100 : 0;
                @endphp
                <div class="card stat-card bg-info text-white shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2 opacity-75">Verified</h6>
                                <h2 class="card-title mb-0">{{ $verifiedCount }}</h2>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-check-circle fa-2x opacity-75"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="opacity-75">{{ round($verifiedPercent) }}% verified</small>
                                <div class="progress bg-white bg-opacity-25" style="width: 60px; height: 4px;">
                                    <div class="progress-bar bg-white" style="width: {{ $verifiedPercent }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                @php
                    $pendingCount = $donations->where('status', 'pending')->count();
                @endphp
                <div class="card stat-card bg-warning text-dark shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2 opacity-75">Pending</h6>
                                <h2 class="card-title mb-0">{{ $pendingCount }}</h2>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-clock fa-2x opacity-75"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            @if($pendingCount > 0)
                            <a href="#" class="text-dark text-decoration-none" onclick="filterByStatus('pending')">
                                <small class="opacity-75">Requires attention <i class="fas fa-arrow-right ms-1"></i></small>
                            </a>
                            @else
                            <small class="opacity-75">All clear!</small>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-3 fa-lg"></i>
                <div class="flex-grow-1">{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif

        <!-- Main Table Card -->
        <div class="card shadow-lg border-0">
            <div class="card-header bg-white border-bottom-0 py-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-list-alt me-2 text-primary"></i>Donation Submissions
                    </h3>
                    <div class="table-actions">
                        <div class="input-group" style="width: 250px;">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" placeholder="Search donations..." id="searchInput">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                @if($donations->isEmpty())
                <div class="empty-state py-5">
                    <div class="text-center">
                        <i class="fas fa-donate fa-4x text-muted mb-4"></i>
                        <h4 class="text-muted">No Donations Yet</h4>
                        <p class="text-muted mb-4">Donation submissions will appear here once donors start contributing</p>
                        <a href="#" class="btn btn-primary" onclick="location.reload()">
                            <i class="fas fa-sync me-2"></i>Refresh
                        </a>
                    </div>
                </div>
                @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="donationsTable">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                    </div>
                                </th>
                                <th class="text-nowrap">ID</th>
                                <th class="text-nowrap">Donor Details</th>
                                <th class="text-nowrap">Amount</th>
                                <th class="text-nowrap">UTR / Reference</th>
                                <th class="text-nowrap">Proof</th>
                                <th class="text-nowrap">Status</th>
                                <th class="text-nowrap">Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($donations as $donation)
                            <tr class="hover-row" data-id="{{ $donation->id }}">
                                <td class="ps-4">
                                    <div class="form-check">
                                        <input class="form-check-input donation-checkbox" type="checkbox" value="{{ $donation->id }}">
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1">
                                        #{{ $donation->id }}
                                    </span>
                                </td>
                                <td>
                                    <div class="donor-info">
                                        <div class="d-flex align-items-center">
                                            <div class="donor-avatar me-3">
                                                <div class="avatar-circle bg-primary bg-opacity-10 text-primary">
                                                    {{ strtoupper(substr($donation->name ?? 'N', 0, 1)) }}
                                                </div>
                                            </div>
                                            <div>
                                                <strong class="d-block mb-1">{{ $donation->name ?? 'Anonymous' }}</strong>
                                                <div class="text-muted small">
                                                    <i class="fas fa-envelope me-1"></i>{{ $donation->email ?? 'N/A' }}
                                                </div>
                                                @if($donation->phone)
                                                <div class="text-muted small">
                                                    <i class="fas fa-phone me-1"></i>{{ $donation->phone }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="amount-display">
                                        <div class="amount-value h5 mb-0 text-success">
                                            ₹{{ number_format($donation->amount, 2) }}
                                        </div>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $donation->created_at->format('M d') }}
                                        </small>
                                    </div>
                                </td>
                                <td>
                                    <div class="utr-wrapper">
                                        <code class="utr-code bg-light px-2 py-1 rounded">{{ $donation->utr_number }}</code>
                                        <button class="btn btn-sm btn-link text-decoration-none" 
                                                onclick="copyToClipboard('{{ $donation->utr_number }}')"
                                                data-bs-toggle="tooltip" 
                                                title="Copy UTR">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    @if($donation->screenshot_path)
                                    <div class="screenshot-preview">
                                        
                                            <img src="{{ Storage::url($donation->screenshot_path) }}" 
                                                 alt="Screenshot" 
                                                 class="img-thumbnail">
                                           
                                        
                                    </div>
                                    
                                    <!-- Image Modal -->
                                    <div class="modal fade" id="imageModal{{ $donation->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Payment Proof - #{{ $donation->id }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="{{ Storage::url($donation->screenshot_path) }}" 
                                                         alt="Payment Screenshot" 
                                                         class="img-fluid rounded">
                                                    <div class="mt-3">
                                                        <a href="{{ Storage::url($donation->screenshot_path) }}" 
                                                           download 
                                                           class="btn btn-primary btn-sm">
                                                            <i class="fas fa-download me-1"></i>Download
                                                        </a>
                                                        <button class="btn btn-outline-primary btn-sm" 
                                                                onclick="window.open('{{ Storage::url($donation->screenshot_path) }}', '_blank')">
                                                            <i class="fas fa-external-link-alt me-1"></i>Open Full
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <span class="badge bg-warning bg-opacity-20 text-warning">
                                        <i class="fas fa-exclamation-circle me-1"></i>No Proof
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="status-wrapper">
                                        @if($donation->status == 'verified')
                                        <span class="badge bg-success rounded-pill px-3 py-2 status-badge">
                                            <i class="fas fa-check-circle me-1"></i>Verified
                                        </span>
                                        <div class="small text-muted mt-1">
                                            Verified on {{ $donation->updated_at->format('M d') }}
                                        </div>
                                        @elseif($donation->status == 'rejected')
                                        <span class="badge bg-danger rounded-pill px-3 py-2 status-badge">
                                            <i class="fas fa-times-circle me-1"></i>Rejected
                                        </span>
                                        @else
                                        <span class="badge bg-warning rounded-pill px-3 py-2 status-badge">
                                            <i class="fas fa-clock me-1"></i>Pending
                                        </span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="date-time">
                                        <div class="date-display">{{ $donation->created_at->format('d M Y') }}</div>
                                        <div class="time-display text-muted small">{{ $donation->created_at->format('h:i A') }}</div>
                                    </div>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

            <!-- Bulk Actions (Removed pagination section since $donations is not paginated) -->
            
        </div>
    </div>
</div>


<style>
.admin-donations-index {
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

.stat-card {
    border-radius: 15px;
    transition: all 0.3s ease;
    cursor: pointer;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2) !important;
}

.stat-icon {
    opacity: 0.3;
    transform: scale(1);
    transition: all 0.3s ease;
}

.stat-card:hover .stat-icon {
    opacity: 0.5;
    transform: scale(1.1);
}

.card {
    border: none;
    border-radius: 15px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
}

.table {
    margin-bottom: 0;
}

.table thead th {
    border-bottom: 2px solid #e9ecef;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
    color: #6c757d;
    padding: 1rem 0.75rem;
}

.table tbody td {
    padding: 1rem 0.75rem;
    vertical-align: middle;
    border-color: #e9ecef;
}

.hover-row {
    transition: all 0.2s ease;
}

.hover-row:hover {
    background-color: rgba(52, 152, 219, 0.05) !important;
    transform: scale(1.002);
}

.donor-avatar .avatar-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 1.1rem;
}

.amount-value {
    font-family: 'Courier New', monospace;
    font-weight: 700;
}

.utr-wrapper {
    display: flex;
    align-items: center;
    gap: 8px;
}

.utr-code {
    font-family: 'Courier New', monospace;
    font-size: 0.9rem;
    color: #2c3e50;
    border: 1px solid #e0e6ed;
}

.screenshot-preview {
    position: relative;
    width: 80px;
    height: 80px;
}

.screenshot-thumbnail {
    display: block;
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
    border-radius: 8px;
}

.screenshot-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.screenshot-thumbnail:hover img {
    transform: scale(1.1);
}

.thumbnail-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    color: white;
}

.screenshot-thumbnail:hover .thumbnail-overlay {
    opacity: 1;
}

.status-badge {
    font-size: 0.8rem;
    font-weight: 500;
}

.date-time {
    min-width: 120px;
}

.date-display {
    font-weight: 600;
    color: #2c3e50;
}

.time-display {
    font-size: 0.85rem;
}

.badge {
    font-weight: 500;
    letter-spacing: 0.3px;
}

.form-check-input {
    width: 18px;
    height: 18px;
    cursor: pointer;
}

.form-check-input:checked {
    background-color: #3498db;
    border-color: #3498db;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
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

.btn-outline-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.2);
}

.btn-outline-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.2);
}

.btn-outline-info:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(23, 162, 184, 0.2);
}

.empty-state {
    padding: 4rem 1rem;
}

.empty-state i {
    opacity: 0.5;
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

.alert-success {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    border: none;
    border-radius: 10px;
    border-left: 4px solid #28a745;
}

.modal-content {
    border: none;
    border-radius: 15px;
    overflow: hidden;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Select all checkbox functionality
    const selectAllCheckbox = document.getElementById('selectAll');
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.donation-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
            updateBulkActions();
        });
    }

    // Individual checkbox functionality
    document.querySelectorAll('.donation-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActions);
    });

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#donationsTable tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });
    }
});


function clearSelection() {
    document.querySelectorAll('.donation-checkbox').forEach(checkbox => {
        checkbox.checked = false;
    });
    document.getElementById('selectAll').checked = false;
    updateBulkActions();
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        // Show success message
        const toast = document.createElement('div');
        toast.className = 'position-fixed bottom-0 end-0 p-3';
        toast.innerHTML = `
            <div class="toast show" role="alert">
                <div class="toast-header">
                    <strong class="me-auto">Copied!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                    UTR copied to clipboard
                </div>
            </div>
        `;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 2000);
    });
}

function getSelectedIds() {
    const checkboxes = document.querySelectorAll('.donation-checkbox:checked');
    return Array.from(checkboxes).map(cb => cb.value);
}

function viewDonationDetails(donationId) {
    // You can implement a modal or separate page for detailed view
    window.location.href = `/admin/donations/${donationId}`;
}

function resetFilters() {
    document.getElementById('filterForm').reset();
    window.location.href = '{{ route('admin.donations.index') }}';
}
</script>

<!-- Include SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection