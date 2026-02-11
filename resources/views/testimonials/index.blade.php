@extends('admin.layouts.app')

@section('title', 'Testimonials - Anmay Foundation')

@section('content')
<style>
    .testimonials-container {
        padding: 30px;
        max-width: 1200px;
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

    .header-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
        padding: 20px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
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

    .stats {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .stat-item {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .add-btn {
        background: linear-gradient(135deg, #00b09b 0%, #96c93d 100%);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
    }

    .add-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 176, 155, 0.3);
        text-decoration: none;
        color: white;
    }

    .testimonials-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .testimonial-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
        animation: fadeInCard 0.6s ease-out;
        animation-fill-mode: both;
    }

    @keyframes fadeInCard {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .testimonial-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        border-color: #667eea;
    }

    .testimonial-card::before {
        content: '"';
        position: absolute;
        top: 20px;
        left: 25px;
        font-size: 80px;
        color: rgba(102, 126, 234, 0.1);
        font-family: Georgia, serif;
        line-height: 1;
        z-index: 0;
    }

    .testimonial-content {
        position: relative;
        z-index: 1;
        margin-bottom: 25px;
        line-height: 1.8;
        color: #444;
        font-size: 1.05rem;
        font-style: italic;
        padding-left: 20px;
        border-left: 4px solid #667eea;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .author-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 20px;
        flex-shrink: 0;
        border: 3px solid white;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
    }

    .author-info {
        flex: 1;
    }

    .author-name {
        font-weight: 700;
        color: #333;
        font-size: 1.2rem;
        margin-bottom: 3px;
    }

    .author-profession {
        color: #667eea;
        font-weight: 500;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .author-profession i {
        font-size: 0.85rem;
    }

    .testimonial-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 15px;
        border-top: 1px solid #f0f0f0;
        margin-top: 20px;
    }

    .testimonial-date {
        color: #888;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .testimonial-actions {
        display: flex;
        gap: 10px;
    }

    .action-btn {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid transparent;
    }

    .btn-edit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        text-decoration: none;
        color: white;
    }

    .btn-delete {
        background: transparent;
        color: #dc3545;
        border-color: #dc3545;
    }

    .btn-delete:hover {
        background: #dc3545;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        margin-top: 20px;
        animation: fadeIn 0.8s ease-out;
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
        color: #666;
        margin-bottom: 30px;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    .rating {
        display: flex;
        gap: 2px;
        margin-top: 10px;
    }

    .star {
        color: #ffc107;
        font-size: 1.2rem;
    }

    .star.empty {
        color: #e0e0e0;
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

    .filters {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .filter-btn {
        background: white;
        border: 2px solid #e0e0e0;
        padding: 10px 20px;
        border-radius: 10px;
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

    .testimonial-status {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-left: 10px;
    }

    .status-active {
        background: #d4edda;
        color: #155724;
    }

    .status-inactive {
        background: #f8d7da;
        color: #721c24;
    }

    @media (max-width: 768px) {
        .testimonials-container {
            padding: 20px;
        }

        .page-header h1 {
            font-size: 2.2rem;
            flex-direction: column;
            gap: 10px;
        }

        .header-actions {
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }

        .stats {
            justify-content: center;
        }

        .testimonials-grid {
            grid-template-columns: 1fr;
        }

        .testimonial-actions {
            flex-direction: column;
        }

        .action-btn {
            width: 100%;
            justify-content: center;
        }
    }

    .delete-form {
        display: inline;
    }

    .featured-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: linear-gradient(135deg, #ff6b6b 0%, #ffa726 100%);
        color: white;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
        box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
    }
</style>

<div class="testimonials-container">
    <div class="page-header">
        <h1>
            <i class="fas fa-quote-left"></i>
            Testimonials
        </h1>
        <p>Manage and showcase what people are saying about Anmay Foundation</p>
    </div>

    @if(session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle"></i>
            <div>
                <strong>Success!</strong> {{ session('success') }}
            </div>
        </div>
    @endif

    @php
        // Calculate statistics
        $totalTestimonials = $testimonials->count();
        $featuredCount = $testimonials->where('is_featured', true)->count();
        $activeCount = $testimonials->where('is_active', true)->count();
    @endphp

    <div class="header-actions">
        <div class="stats">
            
             <button class="filter-btn active">
            <i class="fas fa-list"></i>
            All Testimonials ({{ $totalTestimonials }})
        </button>
        </div>

        <a href="{{ route('testimonials.create') }}" class="add-btn">
            <i class="fas fa-plus"></i>
            Add New Testimonial
        </a>
    </div>

    
    @if($testimonials->count() > 0)
        <div class="testimonials-grid">
            @foreach($testimonials as $index => $testimonial)
                <div class="testimonial-card" style="animation-delay: {{ $index * 0.1 }}s;">
                    @if($testimonial->is_featured)
                        <div class="featured-badge">
                            <i class="fas fa-star"></i>
                            Featured
                        </div>
                    @endif
                    
                    <div class="testimonial-content">
                        {{ $testimonial->text }}
                    </div>

                    <div class="testimonial-author">
                       @if($testimonial->image && Storage::disk('public')->exists($testimonial->image))
                            <div class="author-avatar">
                                <img src="{{ asset('storage/' . $testimonial->image) }}" 
                                    alt="{{ $testimonial->name }}" 
                                    class="avatar-image">
                            </div>
                        @else
                            <div class="author-avatar placeholder">
                                {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="author-info">
                            <div class="author-name">
                                {{ $testimonial->name }}
                                @if(isset($testimonial->is_active))
                                    <span class="testimonial-status {{ $testimonial->is_active ? 'status-active' : 'status-inactive' }}">
                                        {{ $testimonial->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                @endif
                            </div>
                            <div class="author-profession">
                                <i class="fas fa-briefcase"></i>
                                {{ $testimonial->profession }}
                            </div>
                        </div>
                    </div>

                    @if(isset($testimonial->rating) && $testimonial->rating)
                        <div class="rating">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star star {{ $i <= $testimonial->rating ? '' : 'empty' }}"></i>
                            @endfor
                            <span style="margin-left: 10px; color: #888; font-size: 0.9rem;">{{ $testimonial->rating }}/5</span>
                        </div>
                    @endif

                    <div class="testimonial-meta">
                        <div class="testimonial-date">
                            <i class="far fa-calendar"></i>
                            @if($testimonial->created_at)
                                {{ $testimonial->created_at->format('M d, Y') }}
                            @else
                                No date
                            @endif
                        </div>
                        <div class="testimonial-actions">
                            <a href="{{ route('testimonials.edit', $testimonial->id) }}" class="action-btn btn-edit">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('testimonials.destroy', $testimonial->id) }}" class="delete-form" onsubmit="return confirmDelete(event)">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn btn-delete">
                                    <i class="fas fa-trash"></i>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-quote-right"></i>
            <h3>No Testimonials Yet</h3>
            <p>Start collecting testimonials from your supporters. Add your first testimonial to showcase what people are saying about your foundation.</p>
            <a href="{{ route('testimonials.create') }}" class="add-btn" style="width: auto; padding: 15px 40px;">
                <i class="fas fa-plus"></i>
                Add First Testimonial
            </a>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter functionality
        const filterButtons = document.querySelectorAll('.filter-btn:not(.disabled)');
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                if (!this.disabled) {
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    
                    const filterType = this.textContent.trim().toLowerCase();
                    console.log(`Filtering by: ${filterType}`);
                    // You would typically make an AJAX call here to filter testimonials
                }
            });
        });

        // Hover effect for testimonial cards
        const testimonialCards = document.querySelectorAll('.testimonial-card');
        testimonialCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                const avatar = this.querySelector('.author-avatar');
                if (avatar) {
                    avatar.style.transform = 'scale(1.1)';
                    avatar.style.transition = 'transform 0.3s ease';
                }
            });
            
            card.addEventListener('mouseleave', function() {
                const avatar = this.querySelector('.author-avatar');
                if (avatar) {
                    avatar.style.transform = 'scale(1)';
                }
            });
        });

        // Copy testimonial text on double click
        testimonialCards.forEach(card => {
            const content = card.querySelector('.testimonial-content');
            content.addEventListener('dblclick', function() {
                const text = this.textContent.trim();
                navigator.clipboard.writeText(text).then(() => {
                    const originalColor = this.style.color;
                    this.style.color = '#28a745';
                    setTimeout(() => {
                        this.style.color = originalColor;
                    }, 1000);
                });
            });
        });
    });

    function confirmDelete(event) {
        event.preventDefault();
        const form = event.target.closest('form');
        
        // Check if SweetAlert is available
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Are you sure?',
                text: "This testimonial will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        } else {
            // Fallback to native confirm
            if (confirm('Are you sure you want to delete this testimonial?')) {
                form.submit();
            }
        }
    }

    // Export testimonials function (optional)
    function exportTestimonials() {
        // Implement CSV/JSON export functionality
        console.log('Exporting testimonials...');
    }

    // Bulk actions (optional)
    function selectAllTestimonials() {
        const checkboxes = document.querySelectorAll('.testimonial-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = true;
        });
    }
</script>
@endsection