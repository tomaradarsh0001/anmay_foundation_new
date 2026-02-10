@extends('admin.layouts.app')

@section('title', 'Contact Messages - Anmay Foundation')

@section('content')
<style>
    .messages-container {
        padding: 30px;
        max-width: 1400px;
        margin: 0 auto;
        animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .page-header {
        text-align: center;
        margin-bottom: 40px;
        animation: fadeInDown 0.8s ease-out;
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

    .page-header h1 {
        font-size: 2.8rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
    }

    .page-header p {
        color: #666;
        font-size: 1.1rem;
        max-width: 800px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .stats-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
        animation: fadeInUp 0.8s ease-out 0.2s both;
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

    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        display: flex;
        align-items: center;
        gap: 20px;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
        border-color: #667eea;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
    }

    .stat-card:nth-child(1) .stat-icon { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .stat-card:nth-child(2) .stat-icon { background: linear-gradient(135deg, #00b09b 0%, #96c93d 100%); }
    .stat-card:nth-child(3) .stat-icon { background: linear-gradient(135deg, #ff6b6b 0%, #ffa726 100%); }
    .stat-card:nth-child(4) .stat-icon { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }

    .stat-content h3 {
        font-size: 32px;
        font-weight: 700;
        color: #333;
        margin-bottom: 5px;
        line-height: 1;
    }

    .stat-content p {
        color: #666;
        font-size: 14px;
        margin: 0;
        font-weight: 500;
    }

    .messages-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        animation: fadeInUp 0.8s ease-out 0.4s both;
    }

    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 25px 30px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .card-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
        background-size: 50px 50px;
        opacity: 0.2;
        animation: float 20s infinite linear;
    }

    @keyframes float {
        0% { transform: translate(0, 0) rotate(0deg); }
        100% { transform: translate(50px, 50px) rotate(360deg); }
    }

    .header-content {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
    }

    .header-content h2 {
        font-size: 1.8rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .header-content h2 i {
        background: white;
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #667eea;
        font-size: 1.5rem;
    }

    .message-count {
        background: rgba(255, 255, 255, 0.2);
        border: 2px solid rgba(255, 255, 255, 0.3);
        padding: 8px 20px;
        border-radius: 20px;
        font-weight: 600;
        backdrop-filter: blur(10px);
    }

    .card-body {
        padding: 0;
    }

    .table-container {
        overflow-x: auto;
    }

    .messages-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        min-width: 1000px;
    }

    .messages-table thead {
        background: #f8f9fa;
    }

    .messages-table thead th {
        padding: 20px;
        text-align: left;
        font-weight: 600;
        color: #333;
        border-bottom: 2px solid #e9ecef;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .messages-table tbody tr {
        transition: all 0.3s ease;
        animation: fadeInRow 0.5s ease-out;
        animation-fill-mode: both;
    }

    @keyframes fadeInRow {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .messages-table tbody tr:hover {
        background: #f8f9fa;
        transform: scale(1.002);
    }

    .messages-table tbody td {
        padding: 20px;
        border-bottom: 1px solid #e9ecef;
        vertical-align: middle;
        color: #555;
        font-size: 15px;
    }

    .messages-table tbody tr:last-child td {
        border-bottom: none;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 16px;
        flex-shrink: 0;
    }

    .user-details {
        flex: 1;
    }

    .user-name {
        font-weight: 600;
        color: #333;
        margin-bottom: 2px;
    }

    .user-name span {
        font-size: 13px;
        color: #666;
        font-weight: normal;
    }

    .contact-email {
        color: #667eea;
        font-size: 13px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .contact-email:hover {
        text-decoration: underline;
    }

    .contact-phone {
        color: #555;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .contact-phone.empty {
        color: #999;
        font-style: italic;
    }

    .message-preview {
        max-width: 250px;
        color: #666;
        line-height: 1.5;
        font-size: 14px;
    }

    .message-preview .more-text {
        color: #667eea;
        font-weight: 500;
        cursor: pointer;
        margin-left: 5px;
    }

    .date-cell {
        font-size: 14px;
        color: #666;
    }

    .date-day {
        font-weight: 600;
        color: #333;
        margin-bottom: 2px;
    }

    .date-time {
        font-size: 13px;
        color: #999;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-show {
        background: linear-gradient(135deg, #00b09b 0%, #96c93d 100%);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-show:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 176, 155, 0.3);
        text-decoration: none;
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .empty-state i {
        font-size: 5rem;
        color: #e0e0e0;
        margin-bottom: 20px;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .empty-state h3 {
        font-size: 1.8rem;
        margin-bottom: 10px;
        color: #333;
    }

    .empty-state p {
        margin-bottom: 30px;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    .pagination-container {
        padding: 25px 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-top: 1px solid #e9ecef;
        background: #f8f9fa;
    }

    .pagination {
        display: flex;
        gap: 8px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .page-item {
        transition: all 0.3s ease;
    }

    .page-item.active .page-link {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-color: #667eea;
    }

    .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        color: #333;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        background: white;
    }

    .page-link:hover {
        background: #f8f9fa;
        border-color: #667eea;
        color: #667eea;
        transform: translateY(-2px);
    }

    .page-item.disabled .page-link {
        background: #f8f9fa;
        color: #999;
        cursor: not-allowed;
        transform: none;
    }

    .pagination-info {
        color: #666;
        font-size: 14px;
        margin-left: 20px;
    }

    @media (max-width: 768px) {
        .messages-container {
            padding: 20px;
        }

        .page-header h1 {
            font-size: 2.2rem;
            flex-direction: column;
            gap: 10px;
        }

        .stats-cards {
            grid-template-columns: repeat(2, 1fr);
        }

        .header-content {
            flex-direction: column;
            text-align: center;
            gap: 15px;
        }

        .messages-table {
            font-size: 14px;
        }

        .messages-table thead th,
        .messages-table tbody td {
            padding: 12px 8px;
        }

        .action-buttons {
            flex-direction: column;
            gap: 5px;
        }

        .btn-show {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .stats-cards {
            grid-template-columns: 1fr;
        }
    }

    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-read {
        background: #d4edda;
        color: #155724;
    }

    .status-unread {
        background: #fff3cd;
        color: #856404;
    }

    .status-important {
        background: #f8d7da;
        color: #721c24;
    }

    .filters {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .filter-btn {
        background: white;
        border: 2px solid #e0e0e0;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
        color: #666;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .filter-btn:hover,
    .filter-btn.active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-color: transparent;
        transform: translateY(-2px);
    }

    .filter-btn.active {
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }
</style>

<div class="messages-container">
    <div class="page-header">
        <h1>
            <i class="fas fa-envelope"></i>
            Contact Messages
        </h1>
        <p>Manage and respond to all contact inquiries from your website visitors</p>
    </div>

   

    <!-- Filters -->
    <div class="filters">
        <button class="filter-btn active">
            <i class="fas fa-list"></i>
            All Messages
        </button>
       
    </div>

    <div class="messages-card">
        <div class="card-header">
            <div class="header-content">
                <h2 class="text-white">
                    <i class="fas fa-inbox"></i>
                    Message Inbox
                </h2>
                <div class="message-count">
                    Showing {{ $contacts->firstItem() ?? 0 }}-{{ $contacts->lastItem() ?? 0 }} of {{ $contacts->total() }} messages
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-container">
                @if($contacts->count() > 0)
                    <table class="messages-table">
                        <thead>
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th style="width: 220px;">Contact</th>
                                <th style="width: 150px;">Phone</th>
                                <th style="min-width: 300px;">Message</th>
                                <th style="width: 120px;">Date</th>
                                <th style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $index => $contact)
                                <tr style="animation-delay: {{ $index * 0.05 }}s;">
                                    <td>
                                        <div style="font-weight: 600; color: #667eea;">{{ $loop->iteration }}</div>
                                    </td>
                                    <td>
                                        <div class="user-info">
                                            <div class="user-avatar">
                                                {{ strtoupper(substr($contact->first_name, 0, 1)) }}{{ strtoupper(substr($contact->last_name, 0, 1)) }}
                                            </div>
                                            <div class="user-details">
                                                <div class="user-name">
                                                    {{ $contact->first_name }} {{ $contact->last_name }}
                                                    <span class="status-badge {{ $contact->is_read ? 'status-read' : 'status-unread' }}">
                                                        {{ $contact->is_read ? 'Read' : 'New' }}
                                                    </span>
                                                </div>
                                                <a href="mailto:{{ $contact->email }}" class="contact-email">
                                                    <i class="fas fa-envelope"></i>
                                                    {{ $contact->email }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($contact->phone)
                                            <div class="contact-phone">
                                                <i class="fas fa-phone"></i>
                                                {{ $contact->phone }}
                                            </div>
                                        @else
                                            <div class="contact-phone empty">
                                                <i class="fas fa-phone-slash"></i>
                                                Not provided
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="message-preview">
                                            {{ Str::limit($contact->message, 80) }}
                                            @if(strlen($contact->message) > 80)
                                                <span class="more-text" onclick="showFullMessage({{ $contact->id }})">Read more</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="date-cell">
                                            <div class="date-day">{{ $contact->created_at->format('d M Y') }}</div>
                                            <div class="date-time">{{ $contact->created_at->format('h:i A') }}</div>
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn-show">
                                                <i class="fas fa-eye"></i>
                                                View
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h3>No Messages Yet</h3>
                        <p>When visitors contact you through the contact form, their messages will appear here.</p>
                        <a href="{{ route('admin.dashboard') }}" class="btn-show" style="width: auto; padding: 12px 30px;">
                            <i class="fas fa-home"></i>
                            Back to Dashboard
                        </a>
                    </div>
                @endif
            </div>
        </div>

        @if($contacts->hasPages())
            <div class="pagination-container">
                <nav>
                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        @if($contacts->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $contacts->previousPageUrl() }}" rel="prev">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach(range(1, $contacts->lastPage()) as $page)
                            @if($page == $contacts->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $contacts->url($page) }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if($contacts->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $contacts->nextPageUrl() }}" rel="next">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            </li>
                        @endif
                    </ul>
                </nav>
                
                <div class="pagination-info">
                    Page {{ $contacts->currentPage() }} of {{ $contacts->lastPage() }}
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter functionality
        const filterButtons = document.querySelectorAll('.filter-btn');
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                // Add filter logic here
                const filterType = this.textContent.trim().toLowerCase();
                console.log(`Filtering by: ${filterType}`);
                // You would typically make an AJAX call here to filter messages
            });
        });

        // Row click functionality (except for action buttons)
        const tableRows = document.querySelectorAll('.messages-table tbody tr');
        tableRows.forEach(row => {
            const actionButton = row.querySelector('.btn-show');
            row.addEventListener('click', function(e) {
                if (!actionButton.contains(e.target)) {
                    const contactId = this.querySelector('.more-text')?.getAttribute('onclick')?.match(/\d+/)?.[0];
                    if (contactId) {
                        window.location.href = `/admin/contacts/${contactId}`;
                    }
                }
            });
        });

        // Tooltip for message preview
        const messagePreviews = document.querySelectorAll('.message-preview');
        messagePreviews.forEach(preview => {
            const fullText = preview.textContent.replace('Read more', '').trim();
            preview.setAttribute('title', fullText);
        });
    });

    // Function to show full message (for "Read more" links)
    function showFullMessage(contactId) {
        window.location.href = `/admin/contacts/${contactId}`;
    }

    // Auto-refresh messages every 30 seconds (optional)
    setInterval(() => {
        if (document.visibilityState === 'visible') {
            // You could add AJAX refresh here
            // console.log('Auto-refreshing messages...');
        }
    }, 30000);
</script>
@endsection