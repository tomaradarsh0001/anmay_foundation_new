@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2 class="title-1">Welcome to Anmay Foundation Dashboard</h2>
    </div>
</div>

<div class="dashboard-tiles">
    

     <a href="{{ route('admin.profile.edit') }}" class="tile">
        <div class="tile-icon">
            <i class="fas fa-user"></i>
        </div>
        <div class="tile-label">Profile</div>
    </a>
    <a href="{{ route('website-details.index') }}" class="tile">
        <div class="tile-icon">
            <i class="fas fa-globe"></i>
        </div>
        <div class="tile-label">Website Details</div>
    </a>

    <a href="{{ route('admin.contacts') }}" class="tile">
        <div class="tile-icon">
            <i class="fas fa-envelope-open-text"></i>
        </div>
        <div class="tile-label">Contact Forms</div>
    </a>

    <a href="{{ route('testimonials.index') }}" class="tile">
        <div class="tile-icon">
            <i class="fas fa-comments"></i>
        </div>
        <div class="tile-label">Testimonials</div>
    </a>

    <a href="{{ route('submissions.index') }}" class="tile">
        <div class="tile-icon">
            <i class="fas fa-file-alt"></i>
        </div>
        <div class="tile-label">Submissions</div>
    </a>

    <a href="{{ route('causes.index') }}" class="tile">
        <div class="tile-icon">
            <i class="fas fa-hand-holding-heart"></i>
        </div>
        <div class="tile-label">Causes</div>
    </a>

    <a href="{{ route('admin.donations.index') }}" class="tile">
        <div class="tile-icon">
            <i class="fas fa-donate"></i>
        </div>
        <div class="tile-label">Direct Donations (QR)</div>
    </a>

    <a href="{{ route('admin.payments.index') }}" class="tile">
        <div class="tile-icon">
            <i class="fas fa-money-bill-wave"></i>
        </div>
        <div class="tile-label">PhonePe Donations</div>
    </a>
   <a href="{{ route('admin.payments.razorpay.index') }}" class="tile">
    <div class="tile-icon">
        <i class="fas fa-credit-card"></i>
    </div>
    <div class="tile-label">Razorpay Donations</div>
</a>
    <!-- Logout Tile -->
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="tile">
        <div class="tile-icon logout-icon">
            <i class="fas fa-sign-out-alt"></i>
        </div>
        <div class="tile-label">Logout</div>
    </a>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
</div>

<style>
    /* Container */
.dashboard-tiles {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 30px;
    margin: 40px 0;
}
/* Logout specific icon color */
.tile .logout-icon {
    color: #e74a3b; /* red */
}

.tile:hover .logout-icon {
    color: #fff; /* white on hover */
}
/* Each Tile */
.tile {
    background: #fff;
    border-radius: 20px;
    padding: 50px 20px; /* bigger tile height */
    text-align: center;
    text-decoration: none;
    color: #333;
    box-shadow: 0 6px 20px rgba(0,0,0,0.12);
    transition: transform 0.4s ease, box-shadow 0.4s ease, background 0.4s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

/* Icon inside tile */
.tile-icon {
    font-size: 3.5rem; /* bigger icon */
    margin-bottom: 15px;
    color: #4e73df;
    transition: color 0.4s ease, transform 0.4s ease;
}

/* Label inside tile */
.tile-label {
    font-size: 1.2rem;
    font-weight: 600;
}

/* Hover Effect */
.tile:hover {
    transform: translateY(-10px) scale(1.05);
    box-shadow: 0 12px 30px rgba(0,0,0,0.2);
    background: linear-gradient(135deg, #4e73df, #1cc88a);
    color: #fff;
}

.tile:hover .tile-icon {
    color: #fff;
    transform: rotate(10deg) scale(1.1);
}

/* Smooth fade-in animation on load */
.tile {
    opacity: 0;
    transform: translateY(30px);
    animation: fadeInUp 0.6s forwards;
}

.tile:nth-child(1) { animation-delay: 0.05s; }
.tile:nth-child(2) { animation-delay: 0.10s; }
.tile:nth-child(3) { animation-delay: 0.15s; }
.tile:nth-child(4) { animation-delay: 0.20s; }
.tile:nth-child(5) { animation-delay: 0.25s; }
.tile:nth-child(6) { animation-delay: 0.30s; }
.tile:nth-child(7) { animation-delay: 0.35s; }
.tile:nth-child(8) { animation-delay: 0.40s; }

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive adjustments for mobile */
@media (max-width: 768px) {
    .tile {
        padding: 40px 15px;
    }
    .tile-icon {
        font-size: 3rem;
    }
    .tile-label {
        font-size: 1rem;
    }
}


</style>


@endsection