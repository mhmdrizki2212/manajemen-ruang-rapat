<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('anima/createadmin.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Work+Sans:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
<div class="sidebar flex flex-col justify-between bg-white shadow-md w-64 h-screen">
    <!-- Logo -->
    <div class="flex flex-col items-center py-6 px-4">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Pertamina Hulu Rokan" class="w-20 h-20 object-contain mb-2">
        <div class="text-center leading-tight">
            <span class="block text-xl font-bold">SIMARU</span>
            <span class="block text-xs text-gray-500">Sistem Informasi Manajemen Ruang</span>
        </div>
    </div>

    <!-- Menu -->
    <nav class="flex-1 overflow-y-auto px-4 py-2">
        <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-4">Main Menu</div>

        <!-- Dashboard -->
        <a href="{{ route('admin.home') }}" 
           class="nav-item {{ request()->is('admin/home') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-inherit" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="ml-3">Dashboard</span>
        </a>

        <!-- Ruang -->
        <a href="{{ route('ruangs.index') }}" 
           class="nav-item {{ request()->is('ruangs*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-inherit" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            <span class="ml-3">Ruang</span>
        </a>

        <!-- Jadwal Ruang -->
        <a href="{{ route('jadwals.index') }}" 
           class="nav-item {{ request()->is('jadwals*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-inherit" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span class="ml-3">Jadwal Ruang</span>
        </a>

        <!-- Users -->
        <a href="{{ route('users.index') }}" 
           class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-inherit" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <span class="ml-3">Users</span>
        </a>
    </nav>

    <!-- Logout -->
    <div class="px-4 py-6 border-t border-gray-200">
        <form method="POST" action="{{ route('logout') }}" class="flex justify-center">
            @csrf
            <button type="submit" class="logout-btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 11-4 0v-1m0-4v-1a2 2 0 114 0v1" />
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
            <div class="main-content">
                <div class="form-container">
                    <h2>{{ isset($ruang) ? 'Edit Ruangan' : 'Tambah Ruangan Baru' }}</h2>
                    
                    <form method="POST" action="{{ isset($ruang) ? route('ruangs.update', $ruang->id) : route('ruangs.store') }}" enctype="multipart/form-data">
                        @csrf
                       
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Ruangan -->
                            <div class="md:col-span-2">
                                <label for="nama">Nama Ruangan</label>
                                <input type="text" name="nama" id="nama"
                                    value="{{ old('nama', $ruang->nama ?? '') }}" required
                                    class="input-field" />
                                @error('nama')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>
                    
                            <!-- Lantai -->
                            <div>
                                <label for="lantai">Lantai</label>
                                <input type="number" name="lantai" id="lantai"
                                    value="{{ old('lantai', $ruang->lantai ?? '') }}" required
                                    class="input-field" />
                                @error('lantai')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>
                    
                            <!-- Gedung -->
                            <div>
                                <label for="gedung_id">Gedung</label>
                                <select name="gedung_id" id="gedung_id" required class="select-field">
                                    <option value="">Pilih Gedung</option>
                                    @foreach ($gedungs as $gedung)
                                        <option value="{{ $gedung->id }}"
                                            {{ old('gedung_id', $ruang->gedung_id ?? '') == $gedung->id ? 'selected' : '' }}>
                                            {{ $gedung->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('gedung_id')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>
                    
                            <!-- Upload Gambar -->
                            <div class="md:col-span-2">
                                <label for="img">Upload Gambar</label>
                                <input type="file" name="img" id="img" accept=".jpg,.jpeg,.png"
                                    class="input-field" onchange="previewImage(event)" />
                    
                                <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB.</p>
                                @error('img')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                    
                                <!-- Tempat Preview -->
                                <div class="mt-3">
                                    <img id="preview"
                                        src="{{ isset($ruang) && $ruang->img ? asset('storage/'.$ruang->img) : '#' }}"
                                        alt="Preview Gambar"
                                        class="{{ isset($ruang) && $ruang->img ? '' : 'hidden' }}" />
                                </div>
                            </div>
                        </div>
                    
                        <!-- Tombol Simpan -->
                        <div class="flex justify-end mt-8 space-x-4">
                            <a href="{{ route('ruangs.index') }}" class="btn-back">← Kembali</a>
                            <button type="submit" class="btn-save">
                                {{ isset($ruang) ? 'Simpan Perubahan' : 'Simpan Ruangan' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview');
    
            if (file) {
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                const maxSize = 2 * 1024 * 1024; // 2MB
    
                if (!allowedTypes.includes(file.type)) {
                    Swal.fire('Error', 'Hanya file JPG, JPEG, atau PNG yang diperbolehkan.', 'error');
                    event.target.value = '';
                    preview.classList.add('hidden');
                    return;
                }
    
                if (file.size > maxSize) {
                    Swal.fire('Error', 'Ukuran file maksimal 2MB.', 'error');
                    event.target.value = '';
                    preview.classList.add('hidden');
                    return;
                }
    
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = "#";
                preview.classList.add('hidden');
            }
        }
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
