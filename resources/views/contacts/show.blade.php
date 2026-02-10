@extends('admin.layouts.app')

@section('title', 'Message Details - Anmay Foundation')

@section('content')
<style>
    .message-details-container {
        padding: 30px;
        max-width: 1000px;
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
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .message-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        overflow: hidden;
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

    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 30px 40px;
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

    .message-subject {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .message-subject i {
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

    .message-subject h2 {
        font-size: 1.8rem;
        font-weight: 600;
        margin: 0;
    }

    .message-status {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .status-badge {
        background: rgba(255, 255, 255, 0.2);
        border: 2px solid rgba(255, 255, 255, 0.3);
        padding: 8px 20px;
        border-radius: 20px;
        font-weight: 600;
        backdrop-filter: blur(10px);
    }

    .message-actions {
        display: flex;
        gap: 10px;
        margin-top: 15px;
        width: 100%;
    }

    .btn-action {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
        padding: 8px 20px;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        cursor: pointer;
        border: none;
        font-size: 14px;
    }

    .btn-action:hover {
        background: white;
        color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .btn-action.delete:hover {
        background: #dc3545;
        color: white;
    }

    .btn-action.reply:hover {
        background: #28a745;
        color: white;
    }

    .card-body {
        padding: 40px;
    }

    .sender-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
        animation: slideInLeft 0.6s ease-out 0.3s both;
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .info-item {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 25px;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
    }

    .info-item:hover {
        transform: translateY(-5px);
        border-color: #667eea;
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.1);
    }

    .info-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
        background: linear-gradient(to bottom, #667eea, #764ba2);
        border-radius: 5px 0 0 5px;
    }

    .info-label {
        color: #666;
        font-size: 0.9rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-label i {
        color: #667eea;
        font-size: 1.2rem;
    }

    .info-value {
        color: #333;
        font-size: 1.3rem;
        font-weight: 600;
        word-break: break-word;
        line-height: 1.5;
    }

    .info-value.empty {
        color: #999;
        font-style: italic;
    }

    .message-content-section {
        margin-bottom: 40px;
        animation: slideInRight 0.6s ease-out 0.4s both;
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .section-title i {
        color: #667eea;
        font-size: 1.8rem;
    }

    .message-content {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 30px;
        border: 2px solid #e9ecef;
        line-height: 1.8;
        color: #444;
        font-size: 1.1rem;
        white-space: pre-wrap;
        word-wrap: break-word;
        position: relative;
        transition: all 0.3s ease;
    }

    .message-content:hover {
        border-color: #667eea;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .message-content::before {
        content: '"';
        position: absolute;
        top: -20px;
        left: 20px;
        font-size: 80px;
        color: rgba(102, 126, 234, 0.1);
        font-family: Georgia, serif;
        z-index: 0;
    }

    .message-content::after {
        content: '"';
        position: absolute;
        bottom: -40px;
        right: 20px;
        font-size: 80px;
        color: rgba(102, 126, 234, 0.1);
        font-family: Georgia, serif;
        z-index: 0;
    }

    .meta-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
        padding-top: 30px;
        margin-top: 40px;
        border-top: 2px dashed #e0e0e0;
        animation: fadeIn 0.6s ease-out 0.5s both;
    }

    .timestamps {
        display: flex;
        gap: 30px;
        flex-wrap: wrap;
    }

    .timestamp {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .timestamp-label {
        color: #666;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .timestamp-value {
        color: #333;
        font-weight: 600;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .timestamp-value i {
        color: #667eea;
    }

    .back-button {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 14px 30px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }

    .back-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        text-decoration: none;
        color: white;
    }

    @media (max-width: 768px) {
        .message-details-container {
            padding: 20px;
        }

        .page-header h1 {
            font-size: 2.2rem;
            flex-direction: column;
            gap: 10px;
        }

        .header-content {
            flex-direction: column;
            text-align: center;
            gap: 15px;
        }

        .card-body {
            padding: 25px;
        }

        .sender-info {
            grid-template-columns: 1fr;
        }

        .message-actions {
            justify-content: center;
        }

        .meta-info {
            flex-direction: column;
            text-align: center;
        }

        .timestamps {
            flex-direction: column;
            gap: 15px;
        }
    }

    .contact-links {
        display: flex;
        gap: 15px;
        margin-top: 10px;
        flex-wrap: wrap;
    }

    .contact-link {
        background: white;
        border: 2px solid #e0e0e0;
        padding: 8px 20px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        color: #333;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .contact-link:hover {
        background: #667eea;
        color: white;
        border-color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
        text-decoration: none;
    }

    .contact-link.email:hover {
        background: #dc3545;
        border-color: #dc3545;
    }

    .contact-link.phone:hover {
        background: #28a745;
        border-color: #28a745;
    }

    .empty-state {
        text-align: center;
        padding: 40px;
        color: #666;
    }

    .empty-state i {
        font-size: 4rem;
        color: #e0e0e0;
        margin-bottom: 20px;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .alert-success {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        border: none;
        border-left: 5px solid #28a745;
        border-radius: 12px;
        padding: 20px 25px;
        margin-bottom: 30px;
        color: #155724;
        animation: slideInRight 0.5s ease-out;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .alert-success i {
        font-size: 1.5rem;
    }
</style>

<div class="message-details-container">
    <div class="page-header">
        <h1>
            <i class="fas fa-envelope-open-text"></i>
            Message Details
        </h1>
        <p>View and manage individual contact message details</p>
    </div>

    @if(session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle"></i>
            <div>
                <strong>Success!</strong> {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="message-card">
        <div class="card-header">
            <div class="header-content">
                <div class="message-subject">
                    <i class="fas fa-envelope"></i>
                    <h2 class="text-white">Message from {{ $contact->first_name }}</h2>
                </div>
                <div class="message-status">
                         
                
                <button class="btn-action delete" onclick="confirmDelete({{ $contact->id }})">
                    <i class="fas fa-trash"></i>
                    Delete Message
                </button>
                  
                </div>
            </div>
            
    
        </div>

        <div class="card-body">
            <!-- Sender Information -->
            <div class="sender-info">
                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-user"></i>
                        Full Name
                    </div>
                    <div class="info-value">
                        {{ $contact->first_name }} {{ $contact->last_name }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-envelope"></i>
                        Email Address
                    </div>
                    <div class="info-value">
                        {{ $contact->email }}
                    </div>
                    
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="fas fa-phone"></i>
                        Phone Number
                    </div>
                    <div class="info-value {{ !$contact->phone ? 'empty' : '' }}">
                        {{ $contact->phone ?: 'Not provided' }}
                    </div>
                    
                </div>
            </div>

            <!-- Message Content -->
            <div class="message-content-section">
                <h3 class="section-title">
                    <i class="fas fa-comment-alt"></i>
                    Message Content
                </h3>
                <div class="message-content">
                    {{ $contact->message }}
                </div>
            </div>

            <!-- Meta Information -->
            <div class="meta-info">
                <div class="timestamps">
                    <div class="timestamp">
                        <span class="timestamp-label">Received</span>
                        <span class="timestamp-value">
                            <i class="far fa-clock"></i>
                            {{ $contact->created_at->format('F d, Y \a\t h:i A') }}
                        </span>
                    </div>
                    
                    @if($contact->read_at)
                        <div class="timestamp">
                            <span class="timestamp-label">Read</span>
                            <span class="timestamp-value">
                                <i class="fas fa-eye"></i>
                                {{ $contact->read_at->format('F d, Y \a\t h:i A') }}
                            </span>
                        </div>
                    @endif
                </div>

                <a href="{{ route('admin.contacts') }}" class="back-button">
                    <i class="fas fa-arrow-left"></i>
                    Back to Messages
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this message? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Message</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
  
   

   

    function confirmDelete(contactId) {
        const form = document.getElementById('deleteForm');
        form.action = `/admin/contacts/${contactId}`;
        
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }


</script>
@endsection