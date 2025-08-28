<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Ruangan - Admin </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('anima/pertaminaicon.png') }}">    <script src="https://cdn.tailwindcss.com"></script>
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
        <div
            class="sidebar bg-gradient-to-b from-white to-gray-100 w-64 border-r border-gray-200 flex flex-col shadow-lg rounded-tr-3xl rounded-br-3xl">
            <!-- Logo -->
            <div class="flex flex-col items-center justify-center py-6 px-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Pertamina Hulu Rokan"
                    class="h-20 w-20 object-contain rounded-full bg-white p-2 shadow-md mb-2">
                <div class="text-center leading-tight">
                    <span class="text-[22px] font-extrabold text-[#1A1A1A] tracking-tight uppercase block">SIMARU</span>
                    <span class="text-xs text-gray-500">Sistem Informasi Manajemen Ruang</span>
                </div>


            </div>

                        <nav class="flex-1 overflow-y-auto px-4 py-2">
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-4">Main Menu</div>
        
                <!-- Dashboard -->
                <a href="{{ route('admin.home') }}" class="flex items-center py-3 px-4 rounded-lg mb-2 text-gray-700 hover:bg-gray-100 hover:text-[#0073fe] transition duration-200 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-inherit" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="ml-3">Dashboard</span>
                </a>
        
                <!-- Products -->
    <!-- Products -->
                <a href="{{ route('ruangs.index') }}"
                    class="flex items-center py-3 px-4 rounded-lg mb-2 text-white bg-red-500 hover:bg-red-600 transition-all duration-200 font-semibold shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-inherit" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
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

                <a href="{{ route('jadwals.request') }}" class="flex items-center py-3 px-4 rounded-lg mb-2 text-gray-700 hover:bg-gray-100 hover:text-[#0073fe] transition duration-200 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-inherit" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="ml-3">Request Jadwal</span>
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
                <div class="flex justify-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center gap-2 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 focus:ring-2 focus:ring-red-300 px-5 py-2 rounded-lg shadow-md transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 11-4 0v-1m0-4v-1a2 2 0 114 0v1" />
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
            @if(session('not_found'))
            <div class="mb-4 px-4 py-3 bg-yellow-100 text-yellow-800 rounded-lg shadow text-sm">
                {{ session('not_found') }}
            </div>
            @endif


            <!-- Dashboard Content -->
            <main class="p-6">

                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-800"> Manajemen Ruang </h1>

                    <form action="#" method="GET" class="flex items-center space-x-2">
                        <input type="text" name="search" value="" placeholder="Cari Ruang"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm" />
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 text-sm">
                            Cari
                        </button>
                    </form>
                </div>

                <!-- Recent Orders -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-800">List Ruang</h3>

                            <a href="{{ route('ruangs.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-green-500 text-white text-sm font-medium rounded-lg shadow hover:bg-green-600 transition duration-150 ease-in-out">
                                + Tambah Ruang
                            </a>
                        </div>
                    </div>


                    <div class="overflow-x-auto">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr class="bg-gray-100 text-gray-700 text-sm font-semibold tracking-wide">
                                        <th class="px-6 py-4 text-left">No.</th>
                                        <th class="px-6 py-4 text-left">Gambar</th> {{-- Kolom baru --}}
                                        <th class="px-6 py-4 text-left">Gedung</th>
                                        <th class="px-6 py-4 text-left">Nama Ruangan</th>
                                        <th class="px-6 py-4 text-left">Lantai</th>
                                        <th class="px-6 py-4 text-left">Action</th>
                                        <th class="px-6 py-4 text-left">Riwayat Penggunaan</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($ruangs as $ruang)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $loop->iteration + ($ruangs->currentPage() - 1) * $ruangs->perPage() }}
                                        </td>
                            
                                        {{-- Kolom gambar --}}
                                        <td class="px-6 py-4">
                                            @if ($ruang->img)
                                                <img src="{{ asset('storage/' . $ruang->img) }}" 
                                                     alt="Foto {{ $ruang->nama }}" 
                                                     class="w-16 h-16 object-cover rounded border" />
                                            @else
                                                <span class="text-gray-400 italic text-sm">Tidak ada gambar</span>
                                            @endif
                                        </td>
                            
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                            {{ $ruang->gedung->nama ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $ruang->nama }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            Lantai {{ $ruang->lantai }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-blue-600">
                                            <div class="flex items-center space-x-2">
                                                <!-- Edit -->
                                                <a href="{{ route('ruangs.edit', $ruang->id) }}"
                                                    class="inline-flex items-center px-3 py-1.5 bg-blue-500 text-white text-xs font-medium rounded hover:bg-blue-600 transition duration-150 ease-in-out">
                                                    Edit
                                                </a>
                            
                                                <!-- Delete -->
                                                <form action="{{ route('ruangs.destroy', $ruang->id) }}" method="POST" class="form-hapus">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white text-xs font-medium rounded hover:bg-red-600 transition duration-150 ease-in-out btn-hapus">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('ruangs.history', $ruang->id) }}"
                                               class="inline-flex items-center px-4 py-2 bg-cyan-500 text-white text-sm font-medium rounded-lg shadow hover:bg-cyan-600 transition duration-150 ease-in-out">
                                                + Lihat Riwayat
                                            </a>
                                        </td>                                        
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>

                     
                    </div>

                    @if ($ruangs->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-500">
                                Menampilkan
                                <span class="font-medium">{{ $ruangs->firstItem() }}</span>
                                sampai
                                <span class="font-medium">{{ $ruangs->lastItem() }}</span>
                                dari total
                                <span class="font-medium">{{ $ruangs->total() }}</span> ruangan
                            </div>

                            <div class="flex space-x-1">
                                {{-- Tombol Sebelumnya --}}
                                @if ($ruangs->onFirstPage())
                                <span class="px-3 py-1.5 text-sm text-gray-400 border rounded">← Prev</span>
                                @else
                                <a href="{{ $ruangs->previousPageUrl() }}{{ request('search') ? '&search=' . request('search') : '' }}"
                                    class="px-3 py-1.5 text-sm text-gray-700 hover:bg-gray-100 border rounded transition">←
                                    Prev</a>
                                @endif

                                {{-- Tombol Angka --}}
                                @for ($i = 1; $i <= $ruangs->lastPage(); $i++)
                                    <a href="{{ $ruangs->url($i) }}{{ request('search') ? '&search=' . request('search') : '' }}"
                                        class="px-3 py-1.5 text-sm border rounded
                                {{ $i == $ruangs->currentPage() ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-gray-100' }}
                                transition">
                                        {{ $i }}
                                    </a>
                                    @endfor

                                    {{-- Tombol Selanjutnya --}}
                                    @if ($ruangs->hasMorePages())
                                    <a href="{{ $ruangs->nextPageUrl() }}{{ request('search') ? '&search=' . request('search') : '' }}"
                                        class="px-3 py-1.5 text-sm text-gray-700 hover:bg-gray-100 border rounded transition">Next
                                        →</a>
                                    @else
                                    <span class="px-3 py-1.5 text-sm text-gray-400 border rounded">Next →</span>
                                    @endif
                            </div>
                        </div>
                    </div>
                    @endif




                </div>

                <!-- Recent Activity -->

            </main>
        </div>
    </div>

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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.btn-hapus');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    const form = this.closest('.form-hapus');
                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: "Data ruangan yang dihapus tidak dapat dikembalikan.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('not_found'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Tidak Ditemukan!',
            text: '{{ session('
            not_found ') }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    </script>
    @endif


    <script>
        // Mobile sidebar toggle
        document.querySelector('.lg\\:hidden').addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('-translate-x-full');
        });

        // Add active class to nav items on click
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function (e) {
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
