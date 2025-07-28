<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tambahkan di dalam <head> atau sebelum </body> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary-red: #fd0017;
            --primary-blue: #0073fe;
            --primary-green: #9fe400;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        
        .sidebar {
            transition: all 0.3s ease;
        }
        
        .nav-item:hover {
            background-color: rgba(253, 0, 23, 0.1);
        }
        
        .nav-item.active {
            background-color: rgba(253, 0, 23, 0.1);
            border-left: 4px solid var(--primary-red);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .chart-container {
            background: linear-gradient(135deg, rgba(253, 0, 23, 0.05) 0%, rgba(0, 115, 254, 0.05) 100%);
        }
    </style>
</head>
<body>
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="sidebar bg-gradient-to-b from-white to-gray-100 w-64 border-r border-gray-200 flex flex-col shadow-lg rounded-tr-3xl rounded-br-3xl">
            <!-- Logo -->
            <div class="flex flex-col items-center justify-center py-6 px-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Pertamina Hulu Rokan" class="h-20 w-20 object-contain rounded-full bg-white p-2 shadow-md mb-2">
                <div class="text-center leading-tight">
                    <span class="text-[22px] font-extrabold text-[#1A1A1A] tracking-tight uppercase block">SIMARU</span>
                    <span class="text-xs text-gray-500">Sistem Informasi Manajemen Rapat</span>
                </div>
                
                
             </div>
        
            <!-- Menu -->
            <nav class="flex-1 overflow-y-auto px-4 py-2">
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-4">Main Menu</div>
        
                <!-- Dashboard -->
                <a href="{{ route('admin.home') }}" class="flex items-center py-3 px-4 rounded-lg mb-2 text-gray-700 hover:bg-gray-100 hover:text-[#0073fe] transition duration-200 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg"  class="h-5 w-5 text-inherit" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="ml-3">Dashboard</span>
                </a>
        
                <!-- Products -->
                <a href="#" class="flex items-center py-3 px-4 rounded-lg mb-2 text-gray-700 hover:bg-gray-100 hover:text-[#0073fe] transition duration-200 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-inherit" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span class="ml-3">Ruang</span>
                </a>
        
                <!-- Calendar -->
                <a href="#" class="flex items-center py-3 px-4 rounded-lg mb-2 text-gray-700 hover:bg-gray-100 hover:text-[#0073fe] transition duration-200 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-inherit" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="ml-3">Jadwal Rapat</span>
                </a>
        
                <!-- Users -->
                <a href="{{ route('users.index') }}" class="flex items-center py-3 px-4 rounded-lg mb-2 text-white bg-red-500 hover:bg-red-600 transition-all duration-200 font-semibold shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-inherit" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span class="ml-3">Users</span>
                </a>
            </nav>
        
            <!-- Logout -->
            <div class="px-4 py-6 border-t border-gray-200">
                <div class="flex justify-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 focus:ring-2 focus:ring-red-300 px-5 py-2 rounded-lg shadow-md transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 11-4 0v-1m0-4v-1a2 2 0 114 0v1" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
                <div class="text-center mt-6 text-[11px] text-gray-400 px-4">
                    © PT Pertamina Hulu Rokan Zona 1 2025.
                </div>
                
            </div>
        </div>
        
        
        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
         
 
            <div class="flex-1 overflow-auto px-6 py-8 bg-gray-50 min-h-screen">
                <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-lg">
                    <h2 class="text-3xl font-bold text-gray-800 mb-8 border-b pb-4">Tambah User Baru</h2>
            
                    <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
                        @csrf
            
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="name" id="name" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200" />
                            </div>
            
                            <!-- Role -->
                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                                <select name="role" id="role" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200">
                                    <option value="">Pilih Role</option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
            
                            <!-- Email -->
                            <div class="md:col-span-2">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" id="email" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200" />
                            </div>
            
                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <input type="password" name="password" id="password" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200" />
                            </div>
            
                            <!-- Konfirmasi Password -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200" />
                                    
                                @if ($errors->has('password'))
                                    <p class="text-red-500 text-sm mt-1">
                                        {{ $errors->first('password') == 'The password confirmation does not match.' 
                                            ? 'Konfirmasi password tidak sesuai.' 
                                            : $errors->first('password') }}
                                    </p>
                                @endif
                            </div>
                            
                        </div>
            
                        <!-- Tombol Simpan -->
                        <div class="flex justify-end mt-8 space-x-4">
                            <a href="{{ url()->previous() }}"
                               class="inline-flex items-center px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium rounded-lg shadow-sm transition duration-200">
                                ← Kembali
                            </a>
                        
                            <button type="submit"
                                class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-200">
                                Simpan User
                            </button>
                        </div>
                        
                        
                    </form>
                </div>
            </div>
            
        </div>
    </div>

    <script>
        // Mobile sidebar toggle
        document.querySelector('.lg\\:hidden').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('-translate-x-full');
        });
        
        // Add active class to nav items on click
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        // Animation for stat cards
        document.querySelectorAll('.stat-card').forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = 1;
                card.style.transform = 'translateY(0)';
            }, index * 150);
        });
    </script>
    @if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif

</body>
</html>
