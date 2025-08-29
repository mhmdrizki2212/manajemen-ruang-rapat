<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Admin</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('anima/pertaminaicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Menautkan file CSS baru untuk halaman ini --}}
    <link rel="stylesheet" href="{{ asset('anima/edituser.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="flex h-screen overflow-hidden">
        <div class="sidebar">
            <div class="flex flex-col items-center justify-center py-6 px-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Pertamina Hulu Rokan" class="logo-img">
                <div class="text-center leading-tight mt-2"><span class="title">SIMARU</span><span class="subtitle">Sistem Informasi Manajemen Ruang</span></div>
            </div>
            <nav class="flex-1 overflow-y-auto px-4 py-2">
                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-4">Main Menu</div>
                <a href="{{ route('admin.home') }}" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg><span class="ml-3">Dashboard</span></a>
                <a href="{{ route('ruangs.index') }}" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg><span class="ml-3">Ruang</span></a>
                <a href="{{ route('jadwals.index') }}" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg><span class="ml-3">Jadwal Ruang</span></a>
                <a href="{{ route('jadwals.request') }}" 
                class="flex items-center py-3 px-4 rounded-lg mb-2 text-gray-700 hover:bg-gray-100 hover:text-[#0073fe] transition duration-200 font-medium">
                    
                    <img src="https://www.svgrepo.com/show/435937/request-send.svg" 
                        class="h-5 w-5" alt="Request Icon">
                        
                    <span class="ml-3">Daftar Permintaan</span>
                </a>

                <a href="{{ route('users.index') }}" class="nav-item active"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg><span class="ml-3">Users</span></a>
            </nav>
            <div class="px-4 py-6 border-t border-gray-200">
                <div class="flex justify-center"><form method="POST" action="{{ route('logout') }}"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button type="submit" class="logout-btn"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 11-4 0v-1m0-4v-1a2 2 0 114 0v1" /></svg>Logout</button></form></div>
                <div class="text-center mt-6 text-[11px] text-gray-400 px-4">© PT Pertamina Hulu Rokan Zona 1 2025.</div>
            </div>
        </div>

        <div class="main-content">
            <div class="form-container">
                <div class="form-header">
                    <h1>Edit User</h1>
                    <p>Ubah detail user di bawah ini</p>
                </div>

                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <div class="input-wrapper">
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="input-field">
                                <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="role">Role</label>
                            <div class="input-wrapper">
                                <select name="role" id="role" required class="select-field">
                                    <option value="" disabled>Pilih Role</option>
                                    <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-wrapper">
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="input-field">
                             <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></span>
                        </div>
                        @error('email')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <div class="input-wrapper">
                                <input type="password" name="password" id="password" class="input-field" placeholder="Kosongkan jika tidak diubah">
                                <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg></span>
                            </div>
                            <p class="helper-text">Kosongkan jika tidak ingin mengubah password.</p>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password Baru</label>
                            <div class="input-wrapper">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="input-field">
                                 <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg></span>
                            </div>
                        </div>
                    </div>
                     @error('password')
                        <p class="error-text">{{ $message }}</p>
                    @enderror

                    <div class="form-footer">
                        <a href="{{ route('users.index') }}" class="btn-back">Kembali</a>
                        <button type="submit" class="btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- SweetAlert Scripts --}}
    @if (session('success'))
        <script>
            Swal.fire({ icon: 'success', title: 'Berhasil', text: '{{ session('success') }}', timer: 2500, showConfirmButton: false });
        </script>
    @endif
    @if ($errors->has('password') && $errors->first('password') === 'The password confirmation does not match.')
        <script>
            Swal.fire({ icon: 'error', title: 'Konfirmasi Password Salah', text: 'Pastikan password dan konfirmasi password sama!', confirmButtonColor: '#e3342f' });
        </script>
    @endif
    @if ($errors->has('email'))
        <script>
             Swal.fire({ icon: 'error', title: 'Email sudah terdaftar', text: '{{ $errors->first('email') }}', confirmButtonColor: '#e3342f' });
        </script>
    @endif

</body>
</html>