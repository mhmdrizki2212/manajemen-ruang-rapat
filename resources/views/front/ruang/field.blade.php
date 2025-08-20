<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ruangan Gedung Zona 1 - Pertamina Hulu Rokan</title>
    
    <!-- Menghubungkan ke file CSS eksternal -->
    <link rel="stylesheet" href="{{ asset('anima/field.css') }}">
    
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
    
    <div class="ruangan-item">
        <div class="ruangan-info">
            <h2>Ruang Rapat Utama</h2>
            <p class="status tersedia">Tersedia</p>
            <a href="/formpinjam" class="btn btn-tersedia">Pinjam</a>
        </div>
        <div class="ruangan-gambar">
            <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=500" alt="Ruang Rapat Utama">
        </div>
    </div>
    
    <div class="ruangan-item">
        <div class="ruangan-info">
            <h2>Ruang Diskusi Kecil</h2>
            <p class="status tidak-tersedia">Tidak Tersedia</p>
            <a href="#" class="btn btn-tidak-tersedia">Pinjam</a>
        </div>
        <div class="ruangan-gambar">
            <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=500" alt="Ruang Diskusi Kecil">
        </div>
    </div>


    <div class="ruangan-item">
        <div class="ruangan-info">
            <h2>Ruang AAA</h2>
            <p class="status tidak-tersedia">Tidak Tersedia</p>
            <a href="#" class="btn btn-tidak-tersedia">Pinjam</a>
        </div>
        <div class="ruangan-gambar">
            <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=500" alt="Ruang Diskusi Kecil">
        </div>
    </div>
    
    <div class="ruangan-item">
        <div class="ruangan-info">
            <h2>Ruang BBB</h2>
            <p class="status tersedia">Tersedia</p>
            <a href="/formpinjam" class="btn btn-tersedia">Pinjam</a>
        </div>
        <div class="ruangan-gambar">
            <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=500" alt="Ruang Rapat Utama">
        </div>
    </div>
        
    <div class="ruangan-item">
        <div class="ruangan-info">
            <h2>Ruang CCC</h2>
            <p class="status tersedia">Tersedia</p>
            <a href="/formpinjam" class="btn btn-tersedia">Pinjam</a>
        </div>
        <div class="ruangan-gambar">
            <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=500" alt="Ruang Rapat Utama">
        </div>
    </div>

</div>

<!-- Daftar Ruangan Lantai 2 -->
<div id="lantai2" class="ruangan-list" style="display: none;">
    <!-- contoh isi lantai 2 -->
    <div class="ruangan-item">
        <div class="ruangan-info">
            <h2>Ruang Diskusi Kecil</h2>
            <p class="status tidak-tersedia">Tidak Tersedia</p>
            <a href="#" class="btn btn-tidak-tersedia">Pinjam</a>
        </div>
        <div class="ruangan-gambar">
            <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=500" alt="Ruang Diskusi Kecil">
        </div>
    </div>

    <div class="ruangan-item">
        <div class="ruangan-info">
            <h2>Ruang DDD</h2>
            <p class="status tidak-tersedia">Tidak Tersedia</p>
            <a href="#" class="btn btn-tidak-tersedia">Pinjam</a>
        </div>
        <div class="ruangan-gambar">
            <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=500" alt="Ruang Diskusi Kecil">
        </div>
    </div>

    <div class="ruangan-item">
        <div class="ruangan-info">
            <h2>Ruang EEE</h2>
            <p class="status tidak-tersedia">Tidak Tersedia</p>
            <a href="#" class="btn btn-tidak-tersedia">Pinjam</a>
        </div>
        <div class="ruangan-gambar">
            <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=500" alt="Ruang Diskusi Kecil">
        </div>
    </div>
        
    <div class="ruangan-item">
        <div class="ruangan-info">
            <h2>Ruang Rapat Utama</h2>
            <p class="status tersedia">Tersedia</p>
            <a href="/formpinjam" class="btn btn-tersedia">Pinjam</a>
        </div>
        <div class="ruangan-gambar">
            <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=500" alt="Ruang Rapat Utama">
        </div>
    </div>
    
    <div class="ruangan-item">
        <div class="ruangan-info">
            <h2>Ruang FFF</h2>
            <p class="status tersedia">Tersedia</p>
            <a href="/formpinjam" class="btn btn-tersedia">Pinjam</a>
        </div>
        <div class="ruangan-gambar">
            <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=500" alt="Ruang Rapat Utama">
        </div>
    </div>
    
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
