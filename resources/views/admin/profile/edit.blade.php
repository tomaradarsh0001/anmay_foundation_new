@extends('admin.layouts.app')

@section('title', 'Edit Profile - Anmay Foundation')

@section('content')
<style>
    .profile-container {
        min-height: 100vh;
        padding: 40px 20px;
    }
    
    .profile-card {
        background: white;
        border-radius: 20px;
        max-width: 800px;
        margin: 0 auto;
        box-shadow: 0 20px 50px rgba(0,0,0,0.3);
        overflow: hidden;
    }
    
    .profile-header {
        background: linear-gradient(135deg, #2563ff 0%, #009dff 100%);
        padding: 40px;
        text-align: center;
        color: white;
        position: relative;
    }
    
    .profile-header h1 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 10px;
    }
    
    .profile-header p {
        font-size: 16px;
        opacity: 0.9;
    }
    
    .profile-body {
        padding: 40px;
    }
    
    
    .input-with-icon {
        position: relative;
    }
    
    .input-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #888;
        font-size: 18px;
    }
    
    .input-with-icon .form-control {
        padding-left: 55px;
    }
    
  
    
    .password-toggle {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #888;
        cursor: pointer;
        font-size: 18px;
    }
    
    .alert {
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 25px;
        border-left: 4px solid;
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
        border-left-color: #28a745;
    }
    
    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        border-left-color: #dc3545;
    }
    
    .alert-warning {
        background: #fff3cd;
        color: #856404;
        border-left-color: #ffc107;
    }
    
    .alert i {
        margin-right: 10px;
    }
    
   
    
    @media (max-width: 768px) {
        .col-md-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }
        
        .profile-body {
            padding: 30px 20px;
        }
        
        .profile-header {
            padding: 30px 20px;
        }
    }
    
    .loading-spinner {
        display: none;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>

<div class="profile-container">
    <div class="profile-card">
        <!-- Header -->
        <div class="profile-header">
            <h1 class="text-white"><i class="fas fa-user-cog text-light"></i>  Edit Profile</h1>
            <p class="text-white">Update your personal information and security settings</p>
        </div>
        
        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success m-4">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <!-- Profile Form -->
        <div class="profile-body">
            <!-- Personal Information Form -->
            <form id="profileForm" method="POST" action="{{ route('admin.profile.update') }}">
                @csrf
                @method('PUT')
                
                <div class="section-title">
                    <i class="fas fa-user"></i> Personal Information
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Full Name</label>
                            <div class="input-with-icon">
                                <i class="fas fa-user input-icon"></i>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       class="form-control" 
                                       value="{{ old('name', $user->name) }}" 
                                       required
                                       placeholder="Enter your full name">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="email">Email Address</label>
                            <div class="input-with-icon">
                                <i class="fas fa-envelope input-icon"></i>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       class="form-control" 
                                       value="{{ old('email', $user->email) }}" 
                                       required
                                       placeholder="Enter your email address">
                            </div>
                            <div class="form-text">Your email will be used for account notifications</div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    
                </div>
                
                <div class="text-end">
                    <button type="submit" class="btn-save" id="saveProfileBtn">
                        <i class="fas fa-save"></i> Save Changes
                        <i class="fas fa-spinner loading-spinner" id="profileSpinner"></i>
                    </button>
                </div>
            </form>
            
            <!-- Password Change Form -->
            <div class="mt-5 pt-4 border-top">
                <div class="section-title">
                    <i class="fas fa-lock"></i> Change Password
                </div>
                
                <form id="passwordForm" method="POST" action="{{ route('admin.profile.password') }}">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="current_password">Current Password</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-key input-icon"></i>
                                    <input type="password" 
                                           id="current_password" 
                                           name="current_password" 
                                           class="form-control" 
                                           required
                                           placeholder="Enter current password">
                                    <button type="button" class="password-toggle" onclick="togglePassword('current_password')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="password">New Password</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-lock input-icon"></i>
                                    <input type="password" 
                                           id="password" 
                                           name="password" 
                                           class="form-control" 
                                           required
                                           minlength="8"
                                           placeholder="Enter new password">
                                    <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="form-text">
                                    Password must be at least 8 characters long
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="password_confirmation">Confirm New Password</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-lock input-icon"></i>
                                    <input type="password" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           class="form-control" 
                                           required
                                           placeholder="Confirm new password">
                                    <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-end">
                        <button type="submit" class="btn-save" id="savePasswordBtn">
                            <i class="fas fa-key"></i> Change Password
                            <i class="fas fa-spinner loading-spinner" id="passwordSpinner"></i>
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Account Info -->
            <div class="mt-5 pt-4 border-top">
                <div class="section-title">
                    <i class="fas fa-info-circle"></i> Account Information
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Account Created</label>
                            <div class="input-with-icon">
                                <i class="fas fa-calendar input-icon"></i>
                                <input type="text" 
                                       class="form-control" 
                                       value="{{ $user->created_at->format('F d, Y') }}" 
                                       readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Last Updated</label>
                            <div class="input-with-icon">
                                <i class="fas fa-history input-icon"></i>
                                <input type="text" 
                                       class="form-control" 
                                       value="{{ $user->updated_at->format('F d, Y') }}" 
                                       readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Profile form submission
        const profileForm = document.getElementById('profileForm');
        const saveProfileBtn = document.getElementById('saveProfileBtn');
        const profileSpinner = document.getElementById('profileSpinner');
        
        profileForm.addEventListener('submit', function(e) {
            saveProfileBtn.disabled = true;
            profileSpinner.style.display = 'inline-block';
        });
        
        // Password form submission
        const passwordForm = document.getElementById('passwordForm');
        const savePasswordBtn = document.getElementById('savePasswordBtn');
        const passwordSpinner = document.getElementById('passwordSpinner');
        
        passwordForm.addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('New password and confirmation password do not match.');
                return;
            }
            
            if (password.length < 8) {
                e.preventDefault();
                alert('Password must be at least 8 characters long.');
                return;
            }
            
            savePasswordBtn.disabled = true;
            passwordSpinner.style.display = 'inline-block';
        });
        
        // Form validation
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!form.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                form.classList.add('was-validated');
            });
        });
    });
    
    // Toggle password visibility
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const toggleBtn = input.nextElementSibling;
        const icon = toggleBtn.querySelector('i');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
    
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            const fadeOut = setInterval(() => {
                if (!alert.style.opacity) {
                    alert.style.opacity = 1;
                }
                if (alert.style.opacity > 0) {
                    alert.style.opacity -= 0.1;
                } else {
                    clearInterval(fadeOut);
                    alert.style.display = 'none';
                }
            }, 50);
        });
    }, 5000);
</script>
@endsection