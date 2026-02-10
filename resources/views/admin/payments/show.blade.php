@extends('admin.layouts.app')

@section('title', 'Payment Details - ' . $payment->merchant_order_id)

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.payments.index') }}">Payments</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Details</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-gray-800">Payment Details</h1>
                <div>
                    <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Details Card -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Transaction Information</h6>
                    @php
                        $badgeClass = match($payment->status) {
                            'COMPLETED' => 'badge-success',
                            'PENDING' => 'badge-warning',
                            'FAILED' => 'badge-danger',
                            'PROCESSING' => 'badge-info',
                            default => 'badge-secondary'
                        };
                    @endphp
                    <span class="badge {{ $badgeClass }} p-2">
                        {{ $payment->status }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-item mb-3">
                                <label class="text-muted small mb-1">Order ID</label>
                                <div class="font-weight-bold">{{ $payment->merchant_order_id }}</div>
                            </div>
                            
                            <div class="detail-item mb-3">
                                <label class="text-muted small mb-1">Transaction ID</label>
                                <div class="font-weight-bold">
                                    {{ $payment->transaction_id ?? 'N/A' }}
                                </div>
                            </div>
                            
                            <div class="detail-item mb-3">
                                <label class="text-muted small mb-1">Payment Gateway</label>
                                <div class="font-weight-bold">{{ $payment->payment_gateway }}</div>
                            </div>
                            
                            <div class="detail-item mb-3">
                                <label class="text-muted small mb-1">Payment Method</label>
                                <div class="font-weight-bold">{{ $payment->payment_method ?? 'N/A' }}</div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="detail-item mb-3">
                                <label class="text-muted small mb-1">Amount</label>
                                <div class="font-weight-bold text-success h4">
                                    ₹{{ number_format($payment->amount, 2) }}
                                </div>
                                <div class="text-muted small">{{ $payment->amount_paise }} paise</div>
                            </div>
                            
                            <div class="detail-item mb-3">
                                <label class="text-muted small mb-1">Payment Date</label>
                                <div class="font-weight-bold">
                                    {{ $payment->payment_date ? $payment->payment_date->format('d M Y, h:i A') : 'N/A' }}
                                </div>
                            </div>
                            
                            <div class="detail-item mb-3">
                                <label class="text-muted small mb-1">Created Date</label>
                                <div class="font-weight-bold">
                                    {{ $payment->created_at->format('d M Y, h:i A') }}
                                </div>
                            </div>
                            
                            @if($payment->error_code)
                            <div class="detail-item mb-3">
                                <label class="text-muted small mb-1">Error Code</label>
                                <div class="font-weight-bold text-danger">{{ $payment->error_code }}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    @if($payment->error_message)
                    <div class="alert alert-danger mt-3">
                        <h6 class="alert-heading">Error Message</h6>
                        <p class="mb-0">{{ $payment->error_message }}</p>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Donor Information Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Donor Information</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-item mb-3">
                                <label class="text-muted small mb-1">Full Name</label>
                                <div class="font-weight-bold">{{ $payment->donor_name }}</div>
                            </div>
                            
                            <div class="detail-item mb-3">
                                <label class="text-muted small mb-1">Email Address</label>
                                <div class="font-weight-bold">{{ $payment->donor_email }}</div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="detail-item mb-3">
                                <label class="text-muted small mb-1">Phone Number</label>
                                <div class="font-weight-bold">{{ $payment->donor_phone }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- UDF Fields -->
                    @if($payment->udf1 || $payment->udf2 || $payment->udf3 || $payment->udf4 || $payment->udf5)
                    <div class="row mt-4">
                        <div class="col-12">
                            <h6 class="text-muted mb-3">Additional Information</h6>
                            <div class="row">
                                @if($payment->udf1)
                                <div class="col-md-4 mb-2">
                                    <label class="text-muted small mb-1">UDF 1</label>
                                    <div>{{ $payment->udf1 }}</div>
                                </div>
                                @endif
                                
                                @if($payment->udf2)
                                <div class="col-md-4 mb-2">
                                    <label class="text-muted small mb-1">UDF 2</label>
                                    <div>{{ $payment->udf2 }}</div>
                                </div>
                                @endif
                                
                                @if($payment->udf3)
                                <div class="col-md-4 mb-2">
                                    <label class="text-muted small mb-1">UDF 3</label>
                                    <div>{{ $payment->udf3 }}</div>
                                </div>
                                @endif
                                
                                @if($payment->udf4)
                                <div class="col-md-4 mb-2">
                                    <label class="text-muted small mb-1">UDF 4</label>
                                    <div>{{ $payment->udf4 }}</div>
                                </div>
                                @endif
                                
                                @if($payment->udf5)
                                <div class="col-md-4 mb-2">
                                    <label class="text-muted small mb-1">UDF 5</label>
                                    <div>{{ $payment->udf5 }}</div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Callback Data Card -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Callback Data</h6>
                    <button class="btn btn-sm btn-outline-primary" type="button" data-toggle="collapse" 
                            data-target="#callbackDataCollapse" aria-expanded="false">
                        Toggle View
                    </button>
                </div>
                <div class="card-body">
                    @if($payment->callback_data)
                    <div class="collapse show" id="callbackDataCollapse">
                        <pre class="bg-light p-3 rounded" style="max-height: 400px; overflow: auto;">
                            {{ json_encode($payment->callback_data, JSON_PRETTY_PRINT) }}
                        </pre>
                    </div>
                    @else
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-database fa-3x mb-3"></i>
                        <p>No callback data available</p>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Actions Card -->
            <!-- Actions Card -->
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Actions</h6>
    </div>
    <div class="card-body">
        <div class="d-grid gap-2">
            <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">
                <i class="fas fa-list"></i> Back to List
            </a>
            
          
            
            @if($payment->status !== 'SUCCESS')
            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $payment->id }})">
                <i class="fas fa-trash"></i> Delete Record
            </button>
            @endif
            
            @if($payment->donor_email)
            <a href="mailto:{{ $payment->donor_email }}" class="btn btn-info">
                <i class="fas fa-envelope"></i> Email Donor
            </a>
            @endif
            
            @if($payment->donor_phone)
            <a href="tel:{{ $payment->donor_phone }}" class="btn btn-success">
                <i class="fas fa-phone"></i> Call Donor
            </a>
            @endif
         @if($payment->status)
            @php
                $badgeClass = match($payment->status) {
                    'COMPLETED' => 'bg-success',
                    'PENDING'   => 'bg-warning text-dark',
                    'FAILED'    => 'bg-danger',
                    default     => 'bg-secondary',
                };
            @endphp
            <span class="badge p-3 {{ $badgeClass }}">
               Payment Status : {{ $payment->status }}
            </span>
        @endif


        </div>
    </div>
</div>
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
                Are you sure you want to delete payment record: <strong>{{ $payment->merchant_order_id }}</strong>?
                <br><br>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    This action cannot be undone. Only failed or pending payments can be deleted.
                </div>
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
    
    // Copy callback data to clipboard
    function copyCallbackData() {
        const data = `{{ json_encode($payment->callback_data, JSON_PRETTY_PRINT) }}`;
        navigator.clipboard.writeText(data).then(() => {
            alert('Callback data copied to clipboard!');
        });
    }
</script>
@endpush

@push('styles')
<style>
    .detail-item {
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }
    
    .detail-item:last-child {
        border-bottom: none;
    }
    
    pre {
        font-size: 0.875rem;
        line-height: 1.4;
    }
    
    .btn-group-vertical .btn {
        margin-bottom: 0.5rem;
    }
    
    .btn-group-vertical .btn:last-child {
        margin-bottom: 0;
    }
</style>
@endpush