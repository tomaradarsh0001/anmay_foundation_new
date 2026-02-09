@extends('admin.layouts.app')

@section('title', 'Donations - Anmay Foundation')

@section('content')
<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header">
            <h4 class="mb-0">
                <i class="fas fa-donate me-2"></i>Donation Submissions
            </h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="donationsTable">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Amount (₹)</th>
                            <th>UTR Number</th>
                            <th>Screenshot</th>
                            <th>Status</th>
                            <th>Submitted At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($donations as $donation)
                        <tr>
                            <td>{{ $donation->id }}</td>
                            <td>{{ $donation->name ?? 'N/A' }}</td>
                            <td>{{ $donation->email ?? 'N/A' }}</td>
                            <td>{{ $donation->phone ?? 'N/A' }}</td>
                            <td>₹{{ number_format($donation->amount, 2) }}</td>
                            <td>
                                <code>{{ $donation->utr_number }}</code>
                            </td>
                            <td>
                                @if($donation->screenshot_path)
                                    <a href="{{ Storage::url($donation->screenshot_path) }}" 
                                       target="_blank" 
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-eye me-1"></i>View
                                    </a>
                                @else
                                    <span class="badge bg-warning">No Image</span>
                                @endif
                            </td>
                            <td>
                                @if($donation->status == 'verified')
                                    <span class="badge bg-success">Verified</span>
                                @elseif($donation->status == 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                            <td>{{ $donation->created_at->format('d M Y, h:i A') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <!-- Verify Button -->
                                    @if($donation->status != 'verified')
                                    <form action="{{ route('admin.donations.update-status', $donation->id) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="verified">
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-check me-1"></i>Verify
                                        </button>
                                    </form>
                                    @endif
                                    
                                    <!-- Reject Button -->
                                    @if($donation->status != 'rejected')
                                    <button type="button" class="btn btn-sm btn-danger ms-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#rejectModal{{ $donation->id }}">
                                        <i class="fas fa-times me-1"></i>Reject
                                    </button>
                                    @endif
                                    
                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.donations.destroy', $donation->id) }}" 
                                          method="POST" class="d-inline ms-1"
                                          onsubmit="return confirm('Are you sure you want to delete this donation?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                
                                <!-- Reject Modal -->
                                <div class="modal fade" id="rejectModal{{ $donation->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Reject Donation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('admin.donations.update-status', $donation->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <input type="hidden" name="status" value="rejected">
                                                    <div class="mb-3">
                                                        <label class="form-label">Reason for rejection (Optional)</label>
                                                        <textarea name="admin_notes" class="form-control" rows="3" 
                                                                  placeholder="Enter reason for rejection..."></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Confirm Reject</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if($donations->isEmpty())
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle me-2"></i>
                    No donation submissions yet.
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .badge {
        font-size: 0.85em;
        padding: 0.35em 0.65em;
    }
    .table th {
        font-weight: 600;
        background-color: #f8f9fa;
    }
</style>

<script>
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
@endsection