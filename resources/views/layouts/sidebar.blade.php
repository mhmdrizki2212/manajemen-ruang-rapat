<div class="sidebar bg-white w-64 border-r border-gray-200 flex flex-col">
    <!-- Logo -->
    <div class="flex items-center justify-center py-6 px-4">
        <div class="flex items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Pertamina Hulu Rokan" class="h-20 w-20 object-contain rounded-full bg-white p-1 shadow-md">
            <span class="ml-3 text-xl font-bold text-gray-800 tracking-wide">SIMARU</span>
        </div>
    </div>

    <!-- Menu -->
    <nav class="flex-1 overflow-y-auto">
        <div class="px-4 py-4">
            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">Main Menu</div>

            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
               class="nav-item flex items-center py-3 px-4 rounded-lg mb-1
               {{ request()->routeIs('dashboard') ? 'bg-red-500 text-white font-semibold' : 'text-gray-800 hover:bg-red-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3" />
                </svg>
                Dashboard
            </a>

            <!-- Products -->
            <a href="{{ route('products.index') }}"
               class="nav-item flex items-center py-3 px-4 rounded-lg mb-1
               {{ request()->routeIs('products.*') ? 'bg-red-500 text-white font-semibold' : 'text-gray-800 hover:bg-red-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ request()->routeIs('products.*') ? 'text-white' : 'text-gray-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012 2h2a2 2 0 002-2" />
                </svg>
                Products
            </a>

            <!-- Calendar -->
            <a href="{{ route('calendar') }}"
               class="nav-item flex items-center py-3 px-4 rounded-lg mb-1
               {{ request()->routeIs('calendar') ? 'bg-red-500 text-white font-semibold' : 'text-gray-800 hover:bg-red-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ request()->routeIs('calendar') ? 'text-white' : 'text-gray-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Calendar
            </a>

            <!-- Users -->
            <a href="{{ route('users.index') }}"
               class="nav-item flex items-center py-3 px-4 rounded-lg mb-1
               {{ request()->routeIs('users.*') ? 'bg-red-500 text-white font-semibold' : 'text-gray-800 hover:bg-red-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 {{ request()->routeIs('users.*') ? 'text-white' : 'text-gray-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Users
            </a>
        </div>

        <!-- Logout -->
        <div class="px-4 py-4 border-t border-gray-200">
            <div class="flex justify-center items-center mt-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-2 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 px-5 py-2 rounded-lg shadow-md transition duration-200 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 11-4 0v-1m0-4v-1a2 2 0 114 0v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>

            <div class="text-center mt-6 text-[11px] text-gray-400">
                © PT Pertamina Hulu Rokan Zona 1 2025.
            </div>
        </div>
    </nav>
</div>
