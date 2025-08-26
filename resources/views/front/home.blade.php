<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertamina Hulu Rokan - Field Jambi</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('anima/pertaminaicon.png') }}">


    <!-- Menghubungkan ke file CSS eksternal -->
    <link rel="stylesheet" href="{{ asset('anima/home.css') }}">

    <!-- Memuat Google Fonts: Poppins and Work Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Work+Sans:wght@400;700&display=swap"
        rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>

</head>

<body>

    <!-- Container Utama -->
    <div class="main-container">

        <!-- Header -->
        <header>
            <div class="container header-content">
                <!-- Logo -->
                <div class="logo">
                    <!-- Ganti dengan path logo Anda yang sebenarnya -->
                    <img src="{{ asset('anima/Pertamina-white_Logo.svg') }}" alt="Logo Pertamina">
                </div>
                <!-- Navigasi -->
                <nav>
                    <a href="/" class="nav-link active">Beranda</a>
                    <a href="#zona1" class="nav-link"> Lihat Jadwal </a>
                </nav>
                <!-- Ikon Pengguna -->
                <div class="user-icons">
                  
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
        <main>
            <!-- Hero Section -->
            <section class="hero-section">
                <div class="hero-content container">
                    <h1>
                        SELAMAT DATANG <br>
                        DI SISTEM MANAJEMEN RUANG RAPAT <br>
                        PT PERTAMINA HULU ROKAN ZONA 1 
                    </h1>
                </div>
            </section>

            <!-- Pilihan Gedung -->
            <section id="zona1" class="pilihan-gedung">
                <div class="container">
                    <h2>Pilih Gedung</h2>
                    <div class="tombol-grup">
                        <a href="{{ route('ruang.zona1') }}" class="tombol">
                            Gedung Zona 1        
                        </a>
                        <a href="{{ route('ruang.field') }}" class="tombol">
                            EP Field Jambi
                        </a>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer>
            <div class="container">
                <!-- Logo Footer -->
                <div class="footer-logo">
                    <img src="{{ asset('anima/logo.png') }}" alt="Logo Pertamina Footer">
                </div>
                <!-- Alamat & Email -->
                <div class="info">
                    <p><span class="font-bold">Address:</span> Jl. Kol. M. Kukuh, Kenali Asam Atas, Kec. Kota Baru, Kota
                        Jambi, Jambi 36128</p>
                    <p><span class="font-bold">Email:</span> asdfghjkl@pertamina.com</p>
                </div>
                <!-- Copyright -->
                <div class="copyright">
                    <p>© Copyright PT Pertamina Hulu Rokan Zona 1 2025. All Right Reserved.</p>
                    <div class="links">
                        <a href="#">Kebijakan Privasi</a>
                        <span>/</span>
                        <a href="#">Waspada Penipuan</a>
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
