<!DOCTYPE html>
<html>
<head>
    <title>Beranda - Sistem Ruang Rapat</title>
</head>
<body>
    <h1>Selamat Datang di Sistem Manajemen Ruang Rapat</h1>
    <p>Ini halaman publik, bisa diakses siapa saja tanpa login.</p>

    <a href="{{route('user.jadwal')}}">Lihat Jadwal Rapat</a>

    {{-- Jika user sudah login, tampilkan tombol ke halaman admin --}}
    @auth
        <br><br>
        <a href="{{ route('admin.home') }}">➡ Masuk ke Halaman Admin</a>
    @endauth

    {{-- Jika belum login, tampilkan tombol login --}}
    @guest
        <br><br>
        <a href="{{ route('login') }}">🔐 Login sebagai Admin</a>
    @endguest


    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
