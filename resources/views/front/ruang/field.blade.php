<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ruangan Gedung Field - Pertamina Hulu Rokan</title>
    
    <!-- CSS eksternal -->
    <link rel="stylesheet" href="{{ asset('anima/zona1.css') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body>

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
                    <a href="#" class="active">Pesan Ruangan</a>
                    <a href="/riwayat">Riwayat</a>
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


        <!-- Main -->
        <main class="container">
            <h1 class="main-title">Daftar Ruangan Gedung Field</h1>
            
            <!-- Tabs Lantai -->
            <div class="tabs-container">
                <nav class="tabs-nav">
                    <a href="#" class="tab-link active" onclick="openTab(event, 'lantai1')"> Lantai 1 </a>
                    <a href="#" class="tab-link" onclick="openTab(event, 'lantai2')"> Lantai 2 </a>
                </nav>
            </div>

            <!-- Lantai 1 -->
            <div id="lantai1" class="ruangan-list" style="display: block;">
                @foreach($ruangs->where('lantai', 1) as $ruang)
                    <div class="ruangan-item">
                        <div class="ruangan-info">
                            <h2>{{ $ruang->nama }}</h2>
                            @if($ruang->status ?? false)
                                <p class="status tersedia">Tersedia</p>
                                <a href="/formpinjam/{{ $ruang->id }}" class="btn btn-tersedia">Pinjam</a>
                            @else
                                <p class="status tidak-tersedia">Tidak Tersedia</p>
                                <a href="#" class="btn btn-tidak-tersedia disabled">Pinjam</a>
                            @endif
                        </div>
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

            <!-- Lantai 2 -->
            <div id="lantai2" class="ruangan-list mb-3" style="display: none;">
                @foreach($ruangs->where('lantai', 2) as $ruang)
                    <div class="ruangan-item">
                        <div class="ruangan-info">
                            <h2>{{ $ruang->nama }}</h2>
                            @if($ruang->status ?? false)
                                <p class="status tersedia">Tersedia</p>
                                <a href="/formpinjam/{{ $ruang->id }}" class="btn btn-tersedia">Pinjam</a>
                            @else
                                <p class="status tidak-tersedia">Tidak Tersedia</p>
                                <a href="#" class="btn btn-tidak-tersedia disabled">Pinjam</a>
                            @endif
                        </div>
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
                    <p>© Copyright PT Pertamina Hulu Rokan Field 2025. All Right Reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <script>
    function openTab(evt, tabId) {
        document.querySelectorAll('.ruangan-list').forEach(el => el.style.display = 'none');
        document.querySelectorAll('.tab-link').forEach(link => link.classList.remove('active'));
        document.getElementById(tabId).style.display = 'block';
        evt.currentTarget.classList.add('active');
    }
    </script>
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
