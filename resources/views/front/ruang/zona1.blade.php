<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ruangan Gedung Zona 1 - Pertamina Hulu Rokan</title>
    
    <!-- Menghubungkan ke file CSS eksternal -->
    <link rel="stylesheet" href="{{ asset('anima/zona1.css') }}">
    
    <!-- Memuat Google Fonts: Poppins and Work Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body>

    <!-- Container Utama -->
    <div class="main-container">

        <!-- Header -->
        <header>
            <div class="container header-inner">
                <!-- Logo -->
                <div class="logo">
                    <!-- Ganti dengan path logo Anda -->
                    <a href="/"><img src="{{ asset('anima/logo.png') }}" alt="Logo Pertamina"></a>
                   <!-- <span class="logo-text">Pertamina Hulu Rokan</span> -->
                </div>
                <!-- Navigasi -->
                <nav class="main-nav">
                    <a href="/">Beranda</a>
                    <a href="#" class="active"> Lihat Jadwal </a>
                </nav>
                <!-- Ikon Pengguna -->
                <div class="user-icons">
                    <a href="#" class="icon-link">
                        <!-- Ikon Notifikasi -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                    </a>
                    <!-- Dropdown Container -->
                    <div class="dropdown-container">
                        <a href="#" class="icon-link" id="user-menu-button">
                            <!-- Ikon Pengguna -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                        </a>
                        <!-- Dropdown Menu -->
                        <div id="user-dropdown" class="dropdown-menu hidden">
                            <a href="/profile" class="dropdown-item">Profile</a>
                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item w-full text-left">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="container">
            <h1 class="main-title">Daftar Ruangan Gedung Zona 1</h1>
            
            <!-- Tabs Lantai -->
            <div class="tabs-container">
                <nav class="tabs-nav">
                    <a href="#" class="tab-link active" onclick="openTab(event, 'lantai1')"> Lantai 1 </a>
                     <a href="#" class="tab-link" onclick="openTab(event, 'lantai2')"> Lantai 2 </a>
                </nav>
            </div>

  <!-- Daftar Ruangan Lantai 1 -->
<div id="lantai1" class="ruangan-list" style="display: block;">
    @foreach($ruangs->where('lantai', 1) as $ruang)
    <div class="ruangan-item">
        {{-- Bagian Info Ruangan --}}
        <div class="ruangan-info">
            <h2>{{ $ruang->nama }}</h2>
            <ul>
                <li>tes</li>
            </ul>
    
            @php
            // Jam kerja: 05:00 sampai 17:00
            $startWork = \Carbon\Carbon::createFromTimeString('05:00:00');
            $endWork = \Carbon\Carbon::createFromTimeString('17:00:00');
    
            // Ambil semua jadwal hari ini, urut berdasarkan jam_mulai
            $jadwalsHariIni = $ruang->jadwals->sortBy('jam_mulai');
    
            // Inisialisasi array untuk slot kosong
            $slotsKosong = [];
            $prevEnd = $startWork;
    
            foreach ($jadwalsHariIni as $jadwal) {
                $jamMulai = \Carbon\Carbon::parse($jadwal->jam_mulai);
                $jamSelesai = \Carbon\Carbon::parse($jadwal->jam_selesai);
    
                // Batasi jam kerja
                if ($jamMulai < $startWork) $jamMulai = $startWork;
                if ($jamSelesai > $endWork) $jamSelesai = $endWork;
    
                // Jika ada celah antara jadwal sebelumnya dengan jadwal ini
                if ($jamMulai > $prevEnd) {
                    $slotsKosong[] = [
                        'mulai' => $prevEnd->format('H:i'),
                        'selesai' => $jamMulai->format('H:i')
                    ];
                }
    
                // Update prevEnd ke akhir jadwal saat ini
                $prevEnd = $jamSelesai > $prevEnd ? $jamSelesai : $prevEnd;
            }
    
            // Slot kosong terakhir sampai jam kerja berakhir
            if ($prevEnd < $endWork) {
                $slotsKosong[] = [
                    'mulai' => $prevEnd->format('H:i'),
                    'selesai' => $endWork->format('H:i')
                ];
            }
    
            // Hitung total durasi yang dipakai hari ini
            $totalBookedMinutes = $jadwalsHariIni->sum(function($jadwal) use ($startWork, $endWork) {
                $jamMulai = \Carbon\Carbon::parse($jadwal->jam_mulai);
                $jamSelesai = \Carbon\Carbon::parse($jadwal->jam_selesai);
    
                if ($jamMulai < $startWork) $jamMulai = $startWork;
                if ($jamSelesai > $endWork) $jamSelesai = $endWork;
    
                return $jamMulai->diffInMinutes($jamSelesai);
            });
    
            $totalWorkMinutes = $startWork->diffInMinutes($endWork);
            $isAvailable = $totalBookedMinutes < $totalWorkMinutes;
            @endphp

    
            {{-- Tampilkan slot kosong --}}
            <div class="jadwal-list mt-2">
                <h3>Jadwal Kosong Hari Ini</h3>
                @if(count($slotsKosong) > 0)
                    <ul>
                        @foreach($slotsKosong as $slot)
                            <li>{{ $slot['mulai'] }} - {{ $slot['selesai'] }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>Tidak ada slot kosong. Ruang penuh hari ini.</p>
                @endif
            </div>
            @if($isAvailable)
            <p class="status tersedia">Tersedia</p>
            <a href="/formpinjam/{{ $ruang->id }}" class="btn btn-tersedia">Pinjam</a>
        @else
            <p class="status tidak-tersedia">Tidak Tersedia</p>
            <a href="#" class="btn btn-tidak-tersedia disabled">Pinjam</a>
        @endif
    

        </div>
    
        {{-- Bagian Gambar Ruangan --}}
        <div class="ruangan-gambar">
            @if($ruang->img)
                <img src="{{ asset('storage/' . $ruang->img) }}" 
                     alt="Ruang {{ $ruang->nama }}" 
                     class="w-64 h-40 object-cover rounded-lg shadow">
            @else
                <img src="https://via.placeholder.com/300x200?text=No+Image" 
                     alt="No Image" 
                     class="w-64 h-40 object-cover rounded-lg shadow">
            @endif
        </div>
    </div>
    
    @endforeach
</div>

<!-- Daftar Ruangan Lantai 2 -->
<div id="lantai2" class="ruangan-list mb-3" style="display: none;">
    @foreach($ruangs->where('lantai', 2) as $ruang)
        <div class="ruangan-item">
            {{-- Bagian Info Ruangan --}}
            <div class="ruangan-info">
                <h2>{{ $ruang->nama }}</h2>

                @php
                // Jam kerja: 05:00 sampai 17:00
                $startWork = \Carbon\Carbon::createFromTimeString('05:00:00');
                $endWork = \Carbon\Carbon::createFromTimeString('17:00:00');

                // Ambil semua jadwal hari ini, urut berdasarkan jam_mulai
                $jadwalsHariIni = $ruang->jadwals->sortBy('jam_mulai');

                // Inisialisasi array untuk slot kosong
                $slotsKosong = [];
                $prevEnd = $startWork;

                foreach ($jadwalsHariIni as $jadwal) {
                    $jamMulai = \Carbon\Carbon::parse($jadwal->jam_mulai);
                    $jamSelesai = \Carbon\Carbon::parse($jadwal->jam_selesai);

                    // Batasi jam kerja
                    if ($jamMulai < $startWork) $jamMulai = $startWork;
                    if ($jamSelesai > $endWork) $jamSelesai = $endWork;

                    // Jika ada celah antara jadwal sebelumnya dengan jadwal ini
                    if ($jamMulai > $prevEnd) {
                        $slotsKosong[] = [
                            'mulai' => $prevEnd->format('H:i'),
                            'selesai' => $jamMulai->format('H:i')
                        ];
                    }

                    // Update prevEnd ke akhir jadwal saat ini
                    $prevEnd = $jamSelesai > $prevEnd ? $jamSelesai : $prevEnd;
                }

                // Slot kosong terakhir sampai jam kerja berakhir
                if ($prevEnd < $endWork) {
                    $slotsKosong[] = [
                        'mulai' => $prevEnd->format('H:i'),
                        'selesai' => $endWork->format('H:i')
                    ];
                }

                // Hitung total durasi yang dipakai hari ini
                $totalBookedMinutes = $jadwalsHariIni->sum(function($jadwal) use ($startWork, $endWork) {
                    $jamMulai = \Carbon\Carbon::parse($jadwal->jam_mulai);
                    $jamSelesai = \Carbon\Carbon::parse($jadwal->jam_selesai);

                    if ($jamMulai < $startWork) $jamMulai = $startWork;
                    if ($jamSelesai > $endWork) $jamSelesai = $endWork;

                    return $jamMulai->diffInMinutes($jamSelesai);
                });

                $totalWorkMinutes = $startWork->diffInMinutes($endWork);
                $isAvailable = $totalBookedMinutes < $totalWorkMinutes;
                @endphp

                {{-- Tampilkan slot kosong --}}
                <div class="jadwal-list mt-2">
                    <h3>Jadwal Kosong Hari Ini</h3>
                    @if(count($slotsKosong) > 0)
                        <ul>
                            @foreach($slotsKosong as $slot)
                                <li>{{ $slot['mulai'] }} - {{ $slot['selesai'] }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>Tidak ada slot kosong. Ruang penuh hari ini.</p>
                    @endif
                </div>

                {{-- Status dan tombol pinjam --}}
                @if($isAvailable)
                    <p class="status tersedia">Tersedia</p>
                    <a href="/formpinjam/{{ $ruang->id }}" class="btn btn-tersedia">Pinjam</a>
                @else
                    <p class="status tidak-tersedia">Tidak Tersedia</p>
                    <a href="#" class="btn btn-tidak-tersedia disabled">Pinjam</a>
                @endif
            </div>

            {{-- Bagian Gambar Ruangan --}}
            <div class="ruangan-gambar">
                @if($ruang->img)
                    <img src="{{ asset('storage/' . $ruang->img) }}" 
                         alt="Ruang {{ $ruang->nama }}" 
                         class="w-64 h-40 object-cover rounded-lg shadow">
                @else
                    <img src="https://via.placeholder.com/300x200?text=No+Image" 
                         alt="No Image" 
                         class="w-64 h-40 object-cover rounded-lg shadow">
                @endif
            </div>
        </div>
    @endforeach
</div>

            
<script>
function openTab(evt, tabId) {
    // Sembunyikan semua daftar ruangan
    document.querySelectorAll('.ruangan-list').forEach(el => {
        el.style.display = 'none';
    });

    // Hilangkan 'active' dari semua tab
    document.querySelectorAll('.tab-link').forEach(link => {
        link.classList.remove('active');
    });

    // Tampilkan lantai yang dipilih
    document.getElementById(tabId).style.display = 'block';

    // Tandai tab yang sedang aktif
    evt.currentTarget.classList.add('active');
}
</script>

        </main>

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="footer-logo">
                    <img src="{{ asset('anima/logo.png') }}" alt="Logo Pertamina Footer">
                </div>
                <div class="footer-info">
                    <p><span class="font-bold">Address:</span> Jl. Kol. M. Kukuh, Kenali Asam Atas, Kec. Kota Baru, Kota Jambi, Jambi 36128</p>
                    <p><span class="font-bold">Email:</span> asdfghjkl@pertamina.com</p>
                </div>
                <div class="footer-copyright">
                    <p>© Copyright PT Pertamina Hulu Rokan Zona 1 2025. All Right Reserved.</p>
                    <div class="social-icons">
                        <a href="#"><svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg></a>
                        <a href="#"><svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg></a>
                        <a href="#"><svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path></svg></a>
                    </div>
                </div>
            </div>
        </footer>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const userMenuButton = document.getElementById('user-menu-button');
            const userDropdown = document.getElementById('user-dropdown');

            userMenuButton.addEventListener('click', function (event) {
                event.stopPropagation(); // Mencegah event sampai ke window
                userDropdown.classList.toggle('hidden');
            });

            // Menutup dropdown jika klik di luar area dropdown
            window.addEventListener('click', function (event) {
                if (!userDropdown.classList.contains('hidden')) {
                    userDropdown.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>
