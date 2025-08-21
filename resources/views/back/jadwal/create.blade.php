<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                    <span class="text-xs text-gray-500">Sistem Informasi Manajemen Ruang</span>
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
                <a href="{{ route('ruangs.index') }}" class="flex items-center py-3 px-4 rounded-lg mb-2 text-gray-700 hover:bg-gray-100 hover:text-[#0073fe] transition duration-200 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-inherit" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span class="ml-3">Ruang</span>
                </a>
        
                <!-- Calendar -->
                <a href="{{ route('jadwals.index') }}" class="flex items-center py-3 px-4 rounded-lg mb-2 text-white bg-red-500 hover:bg-red-600 transition-all duration-200 font-semibold shadow-sm"> 
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-inherit" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span class="ml-3">Jadwal Ruang</span>
                </a>
        
                <!-- Users -->
                <a href="{{ route('users.index') }}" class="flex items-center py-3 px-4 rounded-lg mb-2 text-gray-700 hover:bg-gray-100 hover:text-[#0073fe] transition duration-200 font-medium">
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
        <div class="flex-1 overflow-auto px-6 py-8 bg-gray-50 min-h-screen">
            <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-lg">
                <h2 class="text-3xl font-bold text-gray-800 mb-8 border-b pb-4">
                    Tambah Jadwal Baru
                </h2>
                <form action="{{ route('jadwals.store') }}" method="POST" class="space-y-6">
                    @csrf
                
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama User -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama User</label>
                            <input type="text" value="{{ Auth::user()->name }}" readonly
                                class="w-full px-4 py-2 border border-gray-300 bg-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200" />
                            <input type="hidden" name="user_admin_id" value="{{ Auth::id() }}">
                        </div>
                
                        <!-- Nama Kegiatan -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200" />
                            @error('nama_kegiatan')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                
                        <!-- Fungsi -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Fungsi</label>
                            <input type="text" name="fungsi" value="{{ old('fungsi') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200" />
                        </div>
                
                        <!-- Tanggal, Jam Mulai, Jam Selesai -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:col-span-2">
                            <div>
                                <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                                <input type="date" id="tanggal" name="tanggal"
                                    min="{{ date('Y-m-d') }}"
                                    value="{{ old('tanggal') }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200">
                            </div>
                
                            <div>
                                <label for="jam_mulai" class="block text-sm font-medium text-gray-700 mb-1">Jam Mulai</label>
                                <input type="time" id="jam_mulai" name="jam_mulai" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200">
                            </div>
                
                            <div>
                                <label for="jam_selesai" class="block text-sm font-medium text-gray-700 mb-1">Jam Selesai</label>
                                <input type="time" id="jam_selesai" name="jam_selesai" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200">
                            </div>
                        </div>
                
                        <!-- Pilih Gedung -->
                        <div>
                            <label for="gedung" class="block text-sm font-medium text-gray-700 mb-1">Pilih Gedung</label>
                            <select id="gedung" name="gedung_id" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200">
                                <option value="">-- Pilih Gedung --</option>
                                @foreach($gedungs as $gedung)
                                    <option value="{{ $gedung->id }}">{{ $gedung->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                
                        <!-- Pilih Lantai -->
                        <div>
                            <label for="lantai" class="block text-sm font-medium text-gray-700 mb-1">Pilih Lantai</label>
                            <select id="lantai" name="lantai" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200">
                                <option value="">-- Pilih Lantai --</option>
                            </select>
                        </div>
                
                        <!-- Pilih Ruang -->
                        <div class="md:col-span-2">
                            <label for="ruang" class="block text-sm font-medium text-gray-700 mb-1">Pilih Ruang</label>
                            <select id="ruang" name="ruang_id" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200">
                                <option value="">-- Pilih Ruang --</option>
                            </select>
                        </div>
                    </div>
                
                    <!-- Tombol -->
                    <div class="flex justify-end mt-8 space-x-4">
                        <a href="{{ route('jadwals.index') }}"
                            class="inline-flex items-center px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium rounded-lg shadow-sm transition duration-200">
                            ← Kembali
                        </a>
                
                        <button type="submit"
                            class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-200">
                            Simpan Jadwal
                        </button>
                    </div>
                </form>
                
                
            </div>
        </div>


        <div id="jadwal-info" style="color: red; font-weight: bold; margin-bottom: 10px;"></div>

<script>
const ruangSelect = document.getElementById('ruang');
const tanggalInput = document.getElementById('tanggal');
const jamMulaiInput = document.getElementById('jam_mulai');
const jamSelesaiInput = document.getElementById('jam_selesai');
const submitBtn = document.getElementById('submit-btn'); // pastikan tombol submit punya id ini
const infoDiv = document.getElementById('jadwal-info');

function checkJadwal() {
    const ruangId = ruangSelect.value;
    const tanggal = tanggalInput.value;
    const jamMulai = jamMulaiInput.value;
    const jamSelesai = jamSelesaiInput.value;

    if (!ruangId || !tanggal || !jamMulai || !jamSelesai) return;

    fetch(`/check-jadwal?ruang_id=${ruangId}&tanggal=${tanggal}&jam_mulai=${jamMulai}&jam_selesai=${jamSelesai}`)
        .then(res => res.json())
        .then(data => {
            if (!data.tersedia) {
                infoDiv.textContent = data.message;
                submitBtn.disabled = true;
            } else {
                infoDiv.textContent = '';
                submitBtn.disabled = false;
            }
        });
}

[ruangSelect, tanggalInput, jamMulaiInput, jamSelesaiInput].forEach(el => {
    el.addEventListener('change', checkJadwal);
});
</script>

 <!-- Load Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- SweetAlert: Success -->
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 1500
    });
</script>
@endif

<!-- SweetAlert: Not Found -->
@if(session('not_found'))
<script>
    Swal.fire({
        icon: 'warning',
        title: 'Tidak Ditemukan!',
        text: '{{ session('not_found') }}',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });
</script>
@endif

<script>
document.addEventListener('DOMContentLoaded', function () {

    /** ===============================
     *  FILTER GEDUNG → LANTAI → RUANG
     *  =============================== */
    const gedungSelect = document.getElementById('gedung');
    const lantaiSelect = document.getElementById('lantai');
    const ruangSelect  = document.getElementById('ruang');

    gedungSelect?.addEventListener('change', function () {
        const gedungId = this.value;
        lantaiSelect.innerHTML = '<option value="">-- Pilih Lantai --</option>';
        ruangSelect.innerHTML  = '<option value="">-- Pilih Ruang --</option>';

        if (gedungId) {
            fetch(`/get-lantai/${gedungId}`)
                .then(res => res.json())
                .then(data => {
                    data.forEach(lantai => {
                        lantaiSelect.innerHTML += `<option value="${lantai}">${lantai}</option>`;
                    });
                });
        }
    });

    lantaiSelect?.addEventListener('change', function () {
        const gedungId = gedungSelect.value;
        const lantai   = this.value;
        ruangSelect.innerHTML = '<option value="">-- Pilih Ruang --</option>';

        if (gedungId && lantai) {
            fetch(`/get-ruang/${gedungId}/${lantai}`)
                .then(res => res.json())
                .then(data => {
                    data.forEach(ruang => {
                        ruangSelect.innerHTML += `<option value="${ruang.id}">${ruang.nama}</option>`;
                    });
                });
        }
    });

    /** ===============================
     *  VALIDASI TANGGAL & JAM
     *  =============================== */
    const tanggalInput  = document.getElementById('tanggal');
    const jamMulaiInput = document.getElementById('jam_mulai');
    const jamAkhirInput = document.getElementById('jam_berakhir');

    function updateJamMulaiMin() {
        const today = new Date();
        const selectedDate = new Date(tanggalInput.value);

        if (selectedDate.toDateString() === today.toDateString()) {
            jamMulaiInput.min = today.toTimeString().slice(0, 5);
        } else {
            jamMulaiInput.min = "00:00";
        }
    }

    function updateJamAkhirMin() {
        jamAkhirInput.min = jamMulaiInput.value || "00:00";
    }

    tanggalInput?.addEventListener('change', updateJamMulaiMin);
    jamMulaiInput?.addEventListener('change', updateJamAkhirMin);

    /** ===============================
     *  SWEETALERT DELETE CONFIRMATION
     *  =============================== */
    document.querySelectorAll('.btn-hapus').forEach(button => {
        button.addEventListener('click', function () {
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

    /** ===============================
     *  SIDEBAR & NAVIGATION UI
     *  =============================== */
    document.querySelector('.lg\\:hidden')?.addEventListener('click', function () {
        document.querySelector('.sidebar').classList.toggle('-translate-x-full');
    });

    document.querySelectorAll('.nav-item').forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active'));
            this.classList.add('active');
        });
    });

    document.querySelectorAll('.stat-card').forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = 1;
            card.style.transform = 'translateY(0)';
        }, index * 150);
    });

});
</script>

</body>
</html>
