<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pertamina Hulu Rokan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Jika pakai Vite --}}
</head>
<body class="relative min-h-screen bg-cover bg-center flex items-center justify-center" style="background-image: url('{{ asset('images/background.jpg') }}')">

    <!-- Optional: Background blur overlay layer -->
    <div class="absolute inset-0 bg-white/10 backdrop-blur-sm"></div>

    <div class="relative z-10 bg-white/90 rounded-2xl shadow-lg w-full max-w-md p-8">
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-48">
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mt-4">
                <label for="email" class="block text-sm font-medium text-gray-700">
                    {{ __('Email') }}
                </label>

                <input 
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    class="block mt-1 w-full bg-white text-gray-900 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#0073fe] focus:border-[#0073fe]"
                >

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>


           <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-gray-700">
                    {{ __('Password') }}
                </label>

                <input 
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="current-password"
                    class="block mt-1 w-full bg-white text-gray-900 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#0073fe] focus:border-[#0073fe]"
                >

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#0073fe] shadow-sm focus:ring-[#0073fe]" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- Action buttons -->
            <div class="flex items-center justify-between mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <!-- Custom login button -->
                <button type="submit"
                        class="ml-3 px-4 py-2 bg-[#0073fe] hover:bg-[#005fd1] text-white font-semibold text-sm rounded-md transition">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>

        <p class="text-sm text-center text-gray-600 mt-4">
            Don't have an account yet?
            <a href="{{ route('register') }}" class="font-semibold text-black">Register</a>
        </p>
    </div>

</body>
</html>
