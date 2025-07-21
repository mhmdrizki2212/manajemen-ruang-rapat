<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .main-background {
                background-image: url("{{ asset('images/background.jpg') }}");
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col main-background">
            <header class="w-full bg-white shadow-md p-4 flex justify-between items-center">
                <h1 class="text-xl font-bold text-gray-800">Pertamina Jambi</h1>
                <nav class="space-x-8">
                    <a href="#" class="text-gray-600 hover:text-gray-900 font-semibold">Beranda</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900 font-semibold">Pesan Ruangan</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900 font-semibold">Riwayat</a>
                </nav>
            </header>

            <main class="flex-grow flex items-center justify-center">
                {{ $slot }}
            </main>

            <footer class="w-full bg-white p-6 text-center border-t">
                <div class="flex flex-col items-center justify-center space-y-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Footer" class="h-8 mb-2">
                    <p class="text-sm font-semibold">Address: Jl. Kol. M. Kukuh, Kenali Asam Atas, Kec. Kota Baru, Kota Jambi, Jambi 36128</p>
                    <p class="text-sm font-semibold">Email: costdgnjkl@pertamina.com</p>
                </div>
                <div class="mt-4 pt-4 border-t text-xs text-gray-500 flex justify-between items-center">
                   <h3>© Copyright PT Pertamina Hulu Rokan Zone 1 2021. All Right Reserved. | Kebijakan Privasi | Waspada Penipuan</h3>
\
                </div>
            </footer>
        </div>
    </body>
</html>