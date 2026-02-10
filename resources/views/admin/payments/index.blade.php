@extends('admin.layouts.app')

@section('title', 'Payment Management')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">Payment Management</h1>
        </div>
    </div>

    <!-- Statistics Row -->
    <div class="row mb-4">
        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-receipt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Success</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['success'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pending'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Failed</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['failed'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Today</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['today_total'] }}</div>
                            <div class="text-xs text-success">₹{{ number_format($stats['today_amount'], 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-md-4 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                Total Amount</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹{{ number_format($stats['total_amount'], 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filters</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.payments.index') }}">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="search">Search</label>
                            <input type="text" class="form-control" id="search" name="search" 
                                   value="{{ request('search') }}" placeholder="Order ID, Name, Email, Phone...">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Status</option>
                                <option value="COMPLETED" {{ request('status') == 'COMPLETED' ? 'selected' : '' }}>Success</option>
                                <option value="PENDING" {{ request('status') == 'PENDING' ? 'selected' : '' }}>Pending</option>
                                <option value="FAILED" {{ request('status') == 'FAILED' ? 'selected' : '' }}>Failed</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" 
                                   value="{{ request('date') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" 
                                   value="{{ request('start_date') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" 
                                   value="{{ request('end_date') }}">
                        </div>
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <div class="form-group w-100">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Payments Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">All Payments</h6>
            <div>
                <a href="{{ route('admin.payments.export') }}?{{ http_build_query(request()->except('page')) }}" 
                   class="btn btn-sm btn-success mr-2">
                    <i class="fas fa-file-export"></i> Export CSV
                </a>
               
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Transaction ID</th>
                            <th>Donor</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Payment Method</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $payment)
                     
                        <tr>
                            <td>
                                <a href="{{ route('admin.payments.show', $payment->id) }}" 
                                   class="font-weight-bold text-primary">
                                    {{ $payment->merchant_order_id }}
                                </a>
                            </td>
                            <td>
                                @if(!empty($payment->transaction_id))
                                    <span class="badge badge-success">{{ $payment->transaction_id }}</span>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif

                            </td>
                            <td>
                                <div class="font-weight-bold">{{ $payment->donor_name }}</div>
                                <div class="small text-muted">{{ $payment->donor_email }}</div>
                                <div class="small text-muted">{{ $payment->donor_phone }}</div>
                            </td>
                            <td class="font-weight-bold text-success">
                                ₹{{ number_format($payment->amount, 2) }}
                                <div class="small text-muted">{{ $payment->amount_paise }} paise</div>
                            </td>
                            <td>
                                @php
                                    $badgeClass = match($payment->status) {
                                        'SUCCESS' => 'badge-success',
                                        'PENDING' => 'badge-warning',
                                        'FAILED' => 'badge-danger',
                                        'PROCESSING' => 'badge-info',
                                        default => 'badge-secondary'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }} p-2">
                                    {{ $payment->status }}
                                </span>
                                @if($payment->error_message)
                                    <div class="small text-danger mt-1">{{ Str::limit($payment->error_message, 30) }}</div>
                                @endif
                            </td>
                            <td>
                                @if(!empty($payment->payment_method))
                                    <span class="badge badge-success">{{ $payment->payment_method }}</span>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif

                            </td>
                            <td>
                                <div>{{ $payment->created_at->format('d M Y') }}</div>
                                <div class="small text-muted">{{ $payment->created_at->format('h:i A') }}</div>
                                @if($payment->payment_date)
                                    <div class="small text-success">Paid: {{ $payment->payment_date->format('d M, h:i A') }}</div>
                                @endif
                            </td>
                            <td>
    <div class="btn-group" role="group">
        <a href="{{ route('admin.payments.show', $payment->id) }}" 
           class="btn btn-sm btn-info" title="View Details">
            <i class="fas fa-eye"></i>
        </a>
    
        
        @if($payment->status !== 'SUCCESS')
        <button type="button" class="btn btn-sm btn-danger" 
                onclick="confirmDelete({{ $payment->id }})" title="Delete">
            <i class="fas fa-trash"></i>
        </button>
        @endif
    </div>
</td>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No payments found</h5>
                                @if(request()->hasAny(['search', 'status', 'date', 'start_date', 'end_date']))
                                    <a href="{{ route('admin.payments.index') }}" class="btn btn-primary mt-2">
                                        Clear Filters
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($payments->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Showing {{ $payments->firstItem() }} to {{ $payments->lastItem() }} of {{ $payments->total() }} entries
                </div>
                <nav>
                    {{ $payments->withQueryString()->links() }}
                </nav>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this payment record? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function confirmDelete(id) {
        const form = document.getElementById('deleteForm');
        form.action = "{{ route('admin.payments.destroy', '') }}/" + id;
        $('#deleteModal').modal('show');
    }

    // Auto-submit filters when status changes
    document.getElementById('status').addEventListener('change', function() {
        if(this.value !== 'all') {
            this.form.submit();
        }
    });

    // Date picker initialization (if using datepicker library)
    @if(config('app.env') === 'local')
    document.addEventListener('DOMContentLoaded', function() {
        // Enable datepickers if you have a datepicker library
        // Example with flatpickr:
        // flatpickr("#date, #start_date, #end_date", {
        //     dateFormat: "Y-m-d",
        // });
    });
    @endif
</script>
@endpush

@push('styles')
<style>
    .badge-success { background-color: #28a745 !important; }
    .badge-warning { background-color: #ffc107 !important; color: #212529 !important; }
    .badge-danger { background-color: #dc3545 !important; }
    .badge-info { background-color: #17a2b8 !important; }
    .badge-secondary { background-color: #6c757d !important; }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,.02);
    }
    
    .btn-group .btn {
        padding: 0.25rem 0.5rem;
    }
</style>
@endpush