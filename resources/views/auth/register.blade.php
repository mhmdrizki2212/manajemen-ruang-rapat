<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Pertamina Hulu Rokan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="relative min-h-screen bg-cover bg-center flex items-center justify-center" style="background-image: url('{{ asset('images/background.jpg') }}')">

    <!-- Background blur overlay (optional) -->
    <div class="absolute inset-0 bg-white/10 backdrop-blur-sm"></div>

    <div class="relative z-10 bg-white/90 rounded-2xl shadow-lg w-full max-w-md p-8">
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-48">
        </div>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="mb-4">
                <ul class="list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input 
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    class="block mt-1 w-full bg-white text-gray-900 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#0073fe] focus:border-[#0073fe]"
                >
            </div>

            <!-- Email -->
            <div class="mt-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input 
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    class="block mt-1 w-full bg-white text-gray-900 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#0073fe] focus:border-[#0073fe]"
                >
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input 
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="new-password"
                    class="block mt-1 w-full bg-white text-gray-900 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#0073fe] focus:border-[#0073fe]"
                >
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input 
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    required
                    class="block mt-1 w-full bg-white text-gray-900 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#0073fe] focus:border-[#0073fe]"
                >
            </div>

            <!-- Register Button -->
            <div class="flex items-center justify-center mt-6">
                <button type="submit"
                        class="px-6 py-2 bg-[#0073fe] hover:bg-[#005fd1] text-white font-semibold text-sm rounded-full transition">
                    {{ __('Register') }}
                </button>
            </div>
        </form>

        <p class="text-sm text-center text-gray-600 mt-4">
            Already have an account?
            <a href="{{ route('login') }}" class="font-semibold text-black">login</a>
        </p>
    </div>

</body>
</html>
