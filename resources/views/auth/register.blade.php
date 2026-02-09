<!-- TailwindCSS CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Optional: Google Fonts (Inter) -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Optional: Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-...your-integrity-hash..." crossorigin="anonymous" referrerpolicy="no-referrer" />

<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
        <div class="max-w-md w-full bg-white p-8 rounded-2xl shadow-lg">
            <h2 class="text-3xl font-bold text-center text-indigo-600 mb-6">Create Your Account</h2>
            <p class="text-center text-gray-500 mb-8">Join us today! It only takes a few steps.</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" class="text-gray-700 font-medium" />
                    <x-text-input id="name" class="mt-1 block w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:outline-none shadow-sm" 
                                  type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-500 text-sm" />
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
                    <x-text-input id="email" class="mt-1 block w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:outline-none shadow-sm" 
                                  type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-500 text-sm" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
                    <x-text-input id="password" class="mt-1 block w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:outline-none shadow-sm" 
                                  type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-500 text-sm" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 font-medium" />
                    <x-text-input id="password_confirmation" class="mt-1 block w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:outline-none shadow-sm" 
                                  type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-500 text-sm" />
                </div>

                <div class="flex items-center justify-between mb-6">
                    <a class="text-sm text-gray-600 hover:text-indigo-500 transition" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                </div>

                <x-primary-button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2">
                    {{ __('Register') }}
                </x-primary-button>
            </form>
        </div>
    </div>

    <!-- Optional: Custom Tailwind Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        x-guest-layout {
            display: block;
        }
    </style>
</x-guest-layout>
