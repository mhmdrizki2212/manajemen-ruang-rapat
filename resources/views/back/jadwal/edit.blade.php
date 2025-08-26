<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal Rapat - Admin</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('anima/pertaminaicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Menautkan file CSS baru untuk halaman edit --}}
    <link rel="stylesheet" href="{{ asset('anima/editjadwal.css') }}">
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
                <a href="{{ route('ruangs.index') }}" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg><span class="ml-3">Ruang</span></a>
                <a href="{{ route('jadwals.index') }}" class="nav-item active"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg><span class="ml-3">Jadwal Ruang</span></a>
                <a href="{{ route('users.index') }}" class="nav-item"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg><span class="ml-3">Users</span></a>
            </nav>
            <div class="px-4 py-6 border-t border-gray-200">
                <div class="flex justify-center"><form method="POST" action="{{ route('logout') }}"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button type="submit" class="logout-btn"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 11-4 0v-1m0-4v-1a2 2 0 114 0v1" /></svg>Logout</button></form></div>
                <div class="text-center mt-6 text-[11px] text-gray-400 px-4">© PT Pertamina Hulu Rokan Zona 1 2025.</div>
            </div>
        </div>

        <div class="main-content">
            <div class="form-container">
                <div class="form-header">
                    <h1>Edit Jadwal Ruang</h1>
                    <p>Ubah detail peminjaman ruangan di bawah ini</p>
                </div>

                <form id="jadwalForm" action="{{ route('jadwals.update', $jadwal->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Nama User</label>
                        <input type="text" value="{{ $jadwal->user->name ?? Auth::user()->name }}" readonly class="input-field" />
                        <input type="hidden" name="user_admin_id" value="{{ $jadwal->user_admin_id ?? Auth::id() }}">
                    </div>

                    <div class="form-group">
                        <label for="ruang_id">Pilih Ruangan</label>
                        <div class="input-wrapper">
                            <select id="ruang_id" name="ruang_id" required class="select-field">
                                <option value="" disabled>-- Pilih Ruangan --</option>
                                @foreach($ruangs as $ruang)
                                    <option value="{{ $ruang->id }}" {{ old('ruang_id', $jadwal->ruang_id) == $ruang->id ? 'selected' : '' }}>
                                        {{ $ruang->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="penanggung_jawab">Penanggung Jawab</label>
                        <input type="text" id="penanggung_jawab" name="penanggung_jawab" value="{{ old('penanggung_jawab', $jadwal->penanggung_jawab) }}" required class="input-field" placeholder="Masukkan Nama Penanggung Jawab...">
                    </div>

                    <div class="form-group">
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                        <input type="text" id="nama_kegiatan" name="nama_kegiatan" value="{{ old('nama_kegiatan', $jadwal->nama_kegiatan) }}" required class="input-field" placeholder="Masukkan Nama Kegiatan...">
                    </div>

                    <div class="form-group">
                        <label for="fungsi">Fungsi / Divisi</label>
                        <input type="text" id="fungsi" name="fungsi" value="{{ old('fungsi', $jadwal->fungsi) }}" required class="input-field" placeholder="Masukkan Fungsi atau Divisi Anda...">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="jumlah_peserta">Jumlah Peserta</label>
                            <div class="input-wrapper">
                                <input type="number" id="jumlah_peserta" name="jumlah_peserta" value="{{ old('jumlah_peserta', $jadwal->jumlah_peserta) }}" min="1" required class="input-field" placeholder="Masukkan Jumlah...">
                                <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal Penggunaan</label>
                            <div class="input-wrapper">
                                <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', $jadwal->tanggal) }}" min="{{ date('Y-m-d') }}" required class="input-field">
                                <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Fasilitas</label>
                        @php
                            $fasilitas = old('fasilitas', is_array($jadwal->fasilitas) ? $jadwal->fasilitas : explode(',', $jadwal->fasilitas));
                        @endphp
                        <div class="checkbox-group">
                            <label class="checkbox-item">
                                <input type="checkbox" name="fasilitas[]" value="Class Room Fasilitas Tambahan" {{ in_array('Class Room Fasilitas Tambahan', $fasilitas) ? 'checked' : '' }}>
                                Class Room Fasilitas Tambahan
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="fasilitas[]" value="Infocus & Screen" {{ in_array('Infocus & Screen', $fasilitas) ? 'checked' : '' }}>
                                Infocus & Screen
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="catatan_pelaksanaan">Tujuan Penggunaan</label>
                        <textarea id="catatan_pelaksanaan" name="catatan_pelaksanaan" rows="3" class="input-field" placeholder="Jelaskan Tujuan Penggunaan Ruangan...">{{ old('catatan_pelaksanaan', $jadwal->catatan_pelaksanaan) }}</textarea>
                    </div>

                    <div class="form-footer">
                        <a href="{{ route('jadwals.index') }}" class="btn-back">Kembali</a>
                        <button type="submit" class="btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Scripts --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        {{-- Sisa script Anda tetap di sini dan tidak diubah --}}
    </div>
</body>
</html>