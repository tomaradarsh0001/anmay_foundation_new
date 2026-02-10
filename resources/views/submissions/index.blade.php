@extends('admin.layouts.app')

@section('title', 'Admin - Submissions')

@section('content')
<style>
  
    
    .content-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08), 
                    0 5px 15px rgba(0, 0, 0, 0.03);
        border: 1px solid rgba(229, 231, 235, 0.6);
    }
    
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid #f1f5f9;
    }
    
    .page-title {
        color: #1e293b;
        font-size: 1.875rem;
        font-weight: 600;
        letter-spacing: -0.025em;
        position: relative;
        display: inline-block;
    }
    
    .page-title:after {
        content: '';
        position: absolute;
        bottom: -1.2rem;
        left: 0;
        width: 70px;
        height: 3px;
        background: linear-gradient(90deg, #3b82f6, #6366f1);
        border-radius: 2px;
    }
    
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }
    
    .stat-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid #e2e8f0;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
    }
    
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.05);
        border-color: #cbd5e1;
    }
    
    .stat-value {
        color: #1e293b;
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .stat-label {
        color: #64748b;
        font-size: 0.875rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .table-container {
        overflow-x: auto;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        background: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
    }
    
    .data-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .data-table thead {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    }
    
    .data-table th {
        padding: 1rem 1.5rem;
        color: #475569;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        text-align: left;
        border-bottom: 2px solid #e2e8f0;
    }
    
    .data-table th:first-child {
        border-top-left-radius: 11px;
    }
    
    .data-table th:last-child {
        border-top-right-radius: 11px;
    }
    
    .data-table tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .data-table tbody tr:hover {
        background-color: #f8fafc;
        transform: scale(1.002);
        box-shadow: inset 0 0 0 1px #e2e8f0;
    }
    
    .data-table td {
        padding: 1.25rem 1.5rem;
        color: #334155;
        font-size: 0.95rem;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .data-table tr:last-child td {
        border-bottom: none;
    }
    
    .download-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 4px rgba(16, 185, 129, 0.2);
    }
    
    .download-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(16, 185, 129, 0.3);
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
    }
    
    .view-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.625rem 1.25rem;
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        border: none;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 4px rgba(59, 130, 246, 0.2);
    }
    
    .view-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3);
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    }
    
    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #64748b;
    }
    
    .empty-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 1rem;
        color: #cbd5e1;
    }
    
    .empty-text {
        font-size: 1.125rem;
        color: #94a3b8;
    }
    
    .date-badge {
        display: inline-block;
        padding: 0.375rem 0.75rem;
        background: #f1f5f9;
        color: #475569;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 500;
        border: 1px solid #e2e8f0;
    }
    
    .email-cell {
        color: #3b82f6;
        font-weight: 500;
    }
    
    @media (max-width: 768px) {
        .page-container {
            padding: 1rem;
        }
        
        .content-card {
            padding: 1.25rem;
        }
        
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        
        .stats-container {
            grid-template-columns: 1fr;
        }
        
        .data-table th,
        .data-table td {
            padding: 0.875rem 1rem;
            font-size: 0.875rem;
        }
    }
</style>

<div class="container">
    <div class="content-card">
        <div class="page-header">
            <h1 class="page-title">Submitted Forms</h1>
            <div class="header-info">
                <span class="date-badge">{{ now()->format('F d, Y') }}</span>
            </div>
        </div>
        
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-value">{{ $submissions->count() }}</div>
                <div class="stat-label">Total Submissions</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $submissions->where('cv', '!=', null)->count() }}</div>
                <div class="stat-label">With CV</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $submissions->where('subject', '!=', null)->count() }}</div>
                <div class="stat-label">With Subject</div>
            </div>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>CV</th>
                        <th>Submitted At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($submissions as $submission)
                        <tr>
                            <td>
                                <span class="font-semibold text-gray-700">#{{ $submission->id }}</span>
                            </td>
                            <td class="font-medium">{{ $submission->name }}</td>
                            <td class="email-cell">{{ $submission->email }}</td>
                            <td>
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-medium
                                    {{ $submission->subject ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-gray-50 text-gray-500 border border-gray-200' }}">
                                    {{ $submission->subject ?? '—' }}
                                </span>
                            </td>
                            <td>
                                @if($submission->cv)
                                    <a href="{{ asset('storage/'.$submission->cv) }}" target="_blank" class="download-link">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                            <polyline points="7 10 12 15 17 10"/>
                                            <line x1="12" y1="15" x2="12" y2="3"/>
                                        </svg>
                                        Download
                                    </a>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>
                            <td>
                                <span class="date-badge">
                                    {{ $submission->created_at->format('d M Y') }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('submissions.show', $submission->id) }}" class="view-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                    View Details
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <svg class="empty-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                                    </svg>
                                    <p class="empty-text">No submissions found.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection