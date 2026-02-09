<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Your App</title>
    
    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts (Inter) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .card-animation {
            animation: fadeIn 0.6s ease-out;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="flex flex-col justify-center py-12 sm:px-6 lg:px-8 card-animation">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <!-- Logo/Header -->
            <div class="flex justify-center">
                <div class="flex items-center space-x-3">
                    <div class="h-12 w-12 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-lock text-white text-xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Welcome Back</h2>
                </div>
            </div>
            
            <p class="mt-3 text-center text-gray-600">
                Sign in to your account to continue
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-6 shadow-2xl rounded-2xl sm:px-10 border border-gray-100">
                <!-- Session Status Message -->
                @if (session('status'))
                    <div class="mb-6 p-3 bg-blue-50 text-blue-700 rounded-lg text-sm">
                        {{ session('status') }}
                    </div>
                @endif
                
                <!-- Error Messages Container -->
                @if ($errors->any())
                    <div class="space-y-2 mb-6">
                        @foreach ($errors->all() as $error)
                            <div class="p-3 bg-red-50 text-red-700 rounded-lg text-sm">
                                {{ $error }}
                            </div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <div class="flex items-center justify-between">
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Email Address
                            </label>
                        </div>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input 
                                id="email" 
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 focus:outline-none"
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                placeholder="you@example.com"
                                required 
                                autofocus 
                                autocomplete="email"
                            />
                        </div>
                        @error('email')
                            <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                Password
                            </label>
                            @if (Route::has('password.request'))
                                <a class="text-sm font-medium text-blue-600 hover:text-blue-500 transition duration-200" href="{{ route('password.request') }}">
                                    Forgot password?
                                </a>
                            @endif
                        </div>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input 
                                id="password" 
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 focus:outline-none"
                                type="password"
                                name="password"
                                placeholder="••••••••"
                                required 
                                autocomplete="current-password" 
                            />
                            <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input 
                            id="remember_me" 
                            type="checkbox" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded transition duration-200 cursor-pointer"
                            name="remember"
                        />
                        <label for="remember_me" class="ml-2 block text-sm text-gray-700 cursor-pointer">
                            Remember me
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 transform hover:-translate-y-0.5 active:scale-95">
                            Sign in to your account
                            <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </form>

                <!-- Register Link -->
                @if (Route::has('register'))
                    <div class="mt-8 text-center">
                        <p class="text-sm text-gray-600">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500 transition duration-200">
                                Sign up here
                            </a>
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Password visibility toggle
        document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });
        
        // Add animation on form inputs focus
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-blue-200');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-blue-200');
            });
        });
        
        // Client-side validation (optional)
        document.querySelector('form').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            let isValid = true;
            
            // Clear previous custom errors
            document.querySelectorAll('[id$="-error"]').forEach(el => {
                if (el.id.startsWith('custom-')) {
                    el.remove();
                }
            });
            
            // Email validation
            if (!email) {
                showError('email', 'Email is required');
                isValid = false;
            } else if (!/\S+@\S+\.\S+/.test(email)) {
                showError('email', 'Please enter a valid email address');
                isValid = false;
            }
            
            // Password validation
            if (!password) {
                showError('password', 'Password is required');
                isValid = false;
            } else if (password.length < 6) {
                showError('password', 'Password must be at least 6 characters');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
            }
            
            function showError(fieldId, message) {
                const field = document.getElementById(fieldId);
                const errorDiv = document.createElement('div');
                errorDiv.id = `custom-${fieldId}-error`;
                errorDiv.className = 'mt-2 text-sm text-red-600';
                errorDiv.textContent = message;
                field.parentNode.parentNode.appendChild(errorDiv);
            }
        });
    </script>
</body>
</html>