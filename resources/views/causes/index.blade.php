@extends('admin.layouts.app')

@section('title', 'Admin - Causes')

@section('content')
<div class="admin-causes-index">
    <div class="container-fluid py-5">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="page-title mb-2">Campaign Causes</h1>
                <p class="text-muted mb-0">Manage and track all fundraising campaigns</p>
            </div>
            <a href="{{ route('causes.create') }}" class="btn btn-primary btn-lg shadow-sm">
                <i class="fas fa-plus-circle me-2"></i>Add New Cause
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-5">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card bg-primary text-white shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2 opacity-75">Total Causes</h6>
                                <h2 class="card-title mb-0">{{ $causes->count() }}</h2>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-hands-helping fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card bg-success text-white shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2 opacity-75">Total Raised</h6>
                                <h2 class="card-title mb-0">${{ number_format($causes->sum('raised')) }}</h2>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-dollar-sign fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card bg-info text-white shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2 opacity-75">Total Goal</h6>
                                <h2 class="card-title mb-0">${{ number_format($causes->sum('target_goal')) }}</h2>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-bullseye fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                @php
                    $totalRaised = $causes->sum('raised');
                    $totalGoal = $causes->sum('target_goal');
                    $overallPercent = $totalGoal > 0 ? ($totalRaised / $totalGoal) * 100 : 0;
                @endphp
                <div class="card stat-card bg-warning text-dark shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2 opacity-75">Overall Progress</h6>
                                <h2 class="card-title mb-0">{{ round($overallPercent) }}%</h2>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-chart-line fa-2x opacity-75"></i>
                            </div>
                        </div>
                        <div class="progress mt-3 bg-white bg-opacity-25" style="height: 6px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: {{ $overallPercent }}%"></div>
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

        <!-- Table Section -->
        <div class="card shadow-lg border-0">
            <div class="card-header bg-white border-bottom-0 py-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-list-alt me-2 text-primary"></i>Causes List
                    </h3>
                    <div class="table-actions">
                        <button class="btn btn-outline-secondary btn-sm me-2">
                            <i class="fas fa-download me-1"></i>Export
                        </button>
                        <button class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-filter me-1"></i>Filter
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                    </div>
                                </th>
                                <th class="text-nowrap">ID</th>
                                <th class="text-nowrap">Campaign Details</th>
                                <th class="text-nowrap">Financial Goals</th>
                                <th class="text-nowrap">Progress</th>
                                <th class="text-nowrap">Image</th>
                                <th class="text-nowrap text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($causes as $cause)
                            <tr class="hover-row">
                                <td class="ps-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $cause->id }}">
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1">
                                        #{{ $cause->id }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <strong class="mb-1">{{ $cause->name }}</strong>
                                        <small class="text-muted">{{ Str::limit($cause->heading, 50) }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <div class="mb-1">
                                            <small class="text-muted">Target:</small>
                                            <strong class="text-success">${{ number_format($cause->target_goal) }}</strong>
                                        </div>
                                        <div>
                                            <small class="text-muted">Raised:</small>
                                            <strong class="text-primary">${{ number_format($cause->raised) }}</strong>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $percent = ($cause->raised / $cause->target_goal) * 100;
                                        $percent = min($percent, 100);
                                    @endphp
                                    <div class="progress-wrapper">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span class="progress-label">{{ round($percent) }}%</span>
                                            @if($percent >= 100)
                                            <span class="badge bg-success rounded-pill px-2">Complete</span>
                                            @elseif($percent >= 75)
                                            <span class="badge bg-warning rounded-pill px-2">Near Goal</span>
                                            @else
                                            <span class="badge bg-info rounded-pill px-2">Active</span>
                                            @endif
                                        </div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar 
                                                @if($percent >= 100) bg-success
                                                @elseif($percent >= 75) bg-warning
                                                @else bg-primary @endif" 
                                                role="progressbar" 
                                                style="width: {{ $percent }}%">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="cause-image-wrapper">
                                        <img src="{{ asset('storage/'.$cause->image) }}" 
                                             alt="{{ $cause->heading }}" 
                                             class="cause-image rounded shadow-sm"
                                             data-bs-toggle="modal" 
                                             data-bs-target="#imageModal{{ $cause->id }}">
                                    </div>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('causes.edit', $cause->id) }}" 
                                           class="btn btn-outline-primary btn-sm me-1"
                                           data-bs-toggle="tooltip" 
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('causes.destroy', $cause->id) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirmDelete(event, '{{ $cause->name }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-outline-danger btn-sm"
                                                    data-bs-toggle="tooltip" 
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                      
                                    </div>
                                </td>
                            </tr>

                            <!-- Image Modal -->
                            <div class="modal fade" id="imageModal{{ $cause->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ $cause->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img src="{{ asset('storage/'.$cause->image) }}" 
                                                 alt="{{ $cause->heading }}" 
                                                 class="img-fluid rounded">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <h4 class="text-muted">No Causes Found</h4>
                                        <p class="text-muted mb-4">Start by creating your first fundraising campaign</p>
                                        <a href="{{ route('causes.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-2"></i>Create First Cause
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

           
        </div>
    </div>
</div>

<style>
.admin-causes-index {
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

.stat-card {
    border-radius: 15px;
    transition: all 0.3s ease;
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

.alert-success {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    border: none;
    border-radius: 10px;
    border-left: 4px solid #28a745;
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

.progress-wrapper {
    min-width: 150px;
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
    font-size: 0.85rem;
    font-weight: 600;
    color: #2c3e50;
}

.cause-image-wrapper {
    width: 80px;
    height: 80px;
    overflow: hidden;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.cause-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.cause-image-wrapper:hover .cause-image {
    transform: scale(1.1);
}

.cause-image-wrapper:hover {
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
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

.btn-outline-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(52, 152, 219, 0.2);
}

.btn-outline-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.2);
}

.empty-state {
    padding: 3rem 1rem;
}

.empty-state i {
    opacity: 0.5;
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

.pagination {
    margin-bottom: 0;
}

.pagination .page-link {
    border: none;
    border-radius: 8px;
    margin: 0 3px;
    color: #3498db;
    font-weight: 500;
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
}

.pagination .page-link:hover {
    background-color: rgba(52, 152, 219, 0.1);
    transform: translateY(-1px);
}
</style>
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

// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Select all checkbox functionality
    const selectAllCheckbox = document.getElementById('selectAll');
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.form-check-input[type="checkbox"]:not(#selectAll)');
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });
    }
});
</script>

<!-- Include SweetAlert if not already included -->
@if(!request()->routeIs('causes.index'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endif
@endsection