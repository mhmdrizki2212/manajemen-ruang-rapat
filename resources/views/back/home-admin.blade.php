<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                    <span class="text-xs text-gray-500">Sistem Informasi Manajemen Ruang</span>
                </div>
                
                
             </div>
        
            <!-- Menu -->
            <nav class="flex-1 overflow-y-auto px-4 py-2">
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-4">Main Menu</div>
        
                <!-- Dashboard -->
                <a href="{{ route('admin.home') }}" class="flex items-center py-3 px-4 rounded-lg mb-2 text-white bg-red-500 hover:bg-red-600 transition-all duration-200 font-semibold shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="ml-3">Dashboard</span>
                </a>
        
                <!-- Products -->
                <a href="{{ route('ruangs.index') }}" class="flex items-center py-3 px-4 rounded-lg mb-2 text-gray-700 hover:bg-gray-100 hover:text-[#0073fe] transition duration-200 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-inherit" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span class="ml-3">Ruang</span>
                </a>
        
                <!-- Calendar -->
                <a href="{{ route('jadwals.index') }}" class="flex items-center py-3 px-4 rounded-lg mb-2 text-gray-700 hover:bg-gray-100 hover:text-[#0073fe] transition duration-200 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-inherit" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="ml-3">Jadwal Ruang</span>
                </a>
        
                <!-- Users -->
                <a href="{{ route('users.index') }}" class="flex items-center py-3 px-4 rounded-lg mb-2 text-gray-700 hover:bg-gray-100 hover:text-[#0073fe] transition duration-200 font-medium relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-inherit" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span class="ml-3">Users</span>
                </a>
            </nav>
        
            <!-- Logout -->
            <div class="px-4 py-6 border-t border-gray-200">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 focus:ring-2 focus:ring-red-300 px-5 py-2 rounded-lg shadow-md transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 11-4 0v-1m0-4v-1a2 2 0 114 0v1" />
                            </svg>
                            Logout
                        </button>
                    </form>
                <div class="text-center mt-6 text-[11px] text-gray-400 px-4">
                    © PT Pertamina Hulu Rokan Zona 1 2025.
                </div>
                
            </div>
        </div>
        
        
        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
 
            <!-- Dashboard Content -->
            <main class="p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard Overview</h1>
                
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="stat-card bg-white rounded-xl shadow-sm p-6 transition-all duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-sm font-medium text-gray-500">Total Ruang Terpakai Hari ini </div>
                            <div class="p-2 rounded-lg bg-blue-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#0073fe]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="text-2xl font-bold text-gray-800 mb-2"><p>{{  $totalRuangTerpakaiHariIni }}</p>
                        </div>

                    </div>
                    
                    <div class="stat-card bg-white rounded-xl shadow-sm p-6 transition-all duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-sm font-medium text-gray-500">Total Ruang</div>
                            <div class="p-2 rounded-lg bg-green-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-inherit" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                        </div>
                        <div class="text-2xl font-bold text-gray-800 mb-2">{{ $totalRuang }}</div>
                    </div>
                    
                    <div class="stat-card bg-white rounded-xl shadow-sm p-6 transition-all duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-sm font-medium text-gray-500">Total Jadwal Akan Datang</div>
                            <div class="p-2 rounded-lg bg-purple-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-inherit" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="text-2xl font-bold text-gray-800 mb-2">{{ $totalUpcomingJadwal }}</div>
                       
                    </div>
                </div>
            
                
                <!-- Recent Orders -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-800">Jadwal Hari Ini</h3>
                            <button class="text-sm font-medium text-blue-500 hover:text-blue-700">View All</button>
                        </div>
                    </div>
                    
<div class="overflow-x-auto">
    <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden shadow-sm">
        <thead class="bg-gray-50">
            <tr class="text-gray-700 text-xs font-semibold uppercase tracking-wider">
                <th class="px-4 py-3 text-left">No</th>
                <th class="px-4 py-3 text-left">User</th>
                <th class="px-4 py-3 text-left">Ruangan</th>
                <th class="px-4 py-3 text-left">Fungsi</th>
                <th class="px-4 py-3 text-left">Tanggal</th>
                <th class="px-4 py-3 text-left">Jam Pelaksanaan</th>
                <th class="px-4 py-3 text-center">Action</th>
                <th class="px-4 py-3 text-center">Status</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200 text-sm">
            @forelse ($jadwals as $jadwal)
                <tr>
                    <td class="px-4 py-2">
                        {{ $loop->iteration + ($jadwals->currentPage() - 1) * $jadwals->perPage() }}
                    </td>
                    <td class="px-4 py-2">{{ $jadwal->userAdmin->name ?? '-' }}</td>
                    <td class="px-4 py-2 font-medium text-gray-900">{{ $jadwal->ruang->nama ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $jadwal->fungsi }}</td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d-m-Y') }}</td>
                    <td class="px-4 py-2">{{ $jadwal->jam_mulai }} -- {{ $jadwal->jam_selesai }}</td>
                    <td class="px-4 py-2 text-center">
                        @php
                        $statusText = $jadwal->status['text'] ?? '';
                    @endphp
                    
                    <span class="@if($jadwal->status == 'Sedang Berlangsung') bg-blue-200 text-blue-800
                        @elseif($jadwal->status == 'Belum Dimulai') bg-yellow-200 text-yellow-800
                        @else bg-green-200 text-green-800 @endif
                        px-2 py-0.5 rounded-full text-xs font-medium">
               {{ $jadwal->status ['text'] }}
           </span>
           
                    
                    </td>
                    <td class="px-4 py-2 text-center">
                        <div class="flex justify-center space-x-1">
                            <a href="{{ route('jadwals.edit', $jadwal->id) }}"
                               class="px-2 py-1 bg-blue-500 text-white text-xs rounded hover:bg-blue-600 transition">
                                Edit
                            </a>
                            <form action="{{ route('jadwals.destroy', $jadwal->id) }}" method="POST" class="form-hapus">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="px-2 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600 transition btn-hapus">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>

                    
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="px-4 py-2 text-center text-gray-500">
                        Tidak ada jadwal hari ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $jadwals->links() }}
    </div>
</div>

                
                <!-- Recent Activity -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-800">Recent Activity</h3>
                        </div>
                    </div>
                    
                    <div class="divide-y divide-gray-200">
                        <div class="py-4 px-6 flex items-start">
                            <img src="https://placehold.co/40x40" alt="User profile photo with blonde hair and business attire" class="w-10 h-10 rounded-full">
                            <div class="ml-3 flex-1">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-sm font-medium text-gray-900">Sarah Johnson</h4>
                                    <span class="text-xs text-gray-500">2 hours ago</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">Completed account setup</p>
                                <div class="mt-2 text-xs text-gray-500 flex items-center">
                                    <span class="inline-block w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                                    <span>Successful</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="py-4 px-6 flex items-start">
                            <img src="https://placehold.co/40x40" alt="User profile photo with glasses and formal wear" class="w-10 h-10 rounded-full">
                            <div class="ml-3 flex-1">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-sm font-medium text-gray-900">Michael Brown</h4>
                                    <span class="text-xs text-gray-500">4 hours ago</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">Updated payment information</p>
                                <div class="mt-2 text-xs text-gray-500 flex items-center">
                                    <span class="inline-block w-2 h-2 rounded-full bg-blue-500 mr-2"></span>
                                    <span>Pending review</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="py-4 px-6 flex items-start">
                            <img src="https://placehold.co/40x40" alt="User profile photo with dark hair and casual attire" class="w-10 h-10 rounded-full">
                            <div class="ml-3 flex-1">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-sm font-medium text-gray-900">Emily Davis</h4>
                                    <span class="text-xs text-gray-500">6 hours ago</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">Submitted a support ticket</p>
                                <div class="mt-2 text-xs text-gray-500 flex items-center">
                                    <span class="inline-block w-2 h-2 rounded-full bg-yellow-500 mr-2"></span>
                                    <span>Waiting for response</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="py-4 px-6 flex items-start">
                            <img src="https://placehold.co/40x40" alt="User profile photo with beard and professional appearance" class="w-10 h-10 rounded-full">
                            <div class="ml-3 flex-1">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-sm font-medium text-gray-900">David Wilson</h4>
                                    <span class="text-xs text-gray-500">Yesterday</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">Placed a new order (#7685)</p>
                                <div class="mt-2 text-xs text-gray-500 flex items-center">
                                    <span class="inline-block w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                                    <span>Completed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
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
</body>
</html>
