<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman Ruang - Pertamina</title>

    <!-- Menghubungkan ke file CSS eksternal -->
    <link rel="stylesheet" href="{{ asset('anima/formpinjam.css') }}">

    <!-- Memuat Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Work+Sans:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

    <!-- Header -->
    <header>
        <div class="container header-inner">
            <div class="logo">
                <img src="{{ asset('anima/logo.png') }}" alt="Logo Pertamina">
                <!-- <span class="logo-text">Pertamina Hulu Rokan</span> -->
            </div>
            <nav class="main-nav">
                <a href="/">Beranda</a>
                <a href="formpinjam" class="active">Pesan Ruangan</a>
                <a href="/riwayat">Riwayat</a>
            </nav>
            <div class="user-icons">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                </a>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content: Form -->
    <main>
        <div class="form-container">
            <div class="form-card">
                <div class="form-header">
                    <h1>Form Peminjaman Ruang</h1>
                    <p>Isi Formulir Berikut Untuk Meminjam Ruangan</p>
                </div>

                <form id="peminjamanForm" action="#" method="POST">
                    <div class="form-group">
                        <label for="ruangan">Pilih Ruangan</label>
                        <div class="input-wrapper">
                            <select id="ruangan" name="ruangan" required>
                                <option value="" disabled selected>Pilih Ruangan...</option>
                                <option value="rapat-utama">Ruang Rapat Utama</option>
                                <option value="diskusi-kecil">Ruang Diskusi Kecil</option>
                                <option value="konferensi-video">Ruang Konferensi Video</option>
                                <option value="pelatihan">Ruang Pelatihan</option>
                                <option value="santai">Ruang Santai</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tanggal">Tanggal Penggunaan</label>
                        <div class="input-wrapper icon-right">
                            <input type="date" id="tanggal" name="tanggal" required>
                            <span class="input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            </span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="waktu-mulai">Waktu Mulai</label>
                            <div class="input-wrapper icon-right">
                                <input type="time" id="waktu-mulai" name="waktu_mulai" required>
                                 <span class="input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="waktu-selesai">Waktu Selesai</label>
                            <div class="input-wrapper icon-right">
                                <input type="time" id="waktu-selesai" name="waktu_selesai" required>
                                 <span class="input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jumlah-peserta">Jumlah Peserta</label>
                        <div class="input-wrapper">
                            <input type="number" id="jumlah-peserta" name="jumlah_peserta" placeholder="Masukkan Jumlah Peserta..." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="penanggung-jawab">Penanggung Jawab</label>
                        <div class="input-wrapper">
                            <input type="text" id="penanggung-jawab" name="penanggung_jawab" placeholder="Masukkan Nama Penanggung Jawab..." required>
                        </div>
                    </div>
                    
                     <!-- Field Pilih Fasilitas -->
                    <div class="form-group">
                        <label>Pilih Fasilitas</label>
                        <div class="checkbox-group">
                            <div class="checkbox-item">
                                <input type="checkbox" id="proyektor" name="fasilitas[]" value="proyektor">
                                <label for="proyektor">Proyektor</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="papan-tulis" name="fasilitas[]" value="papan-tulis">
                                <label for="papan-tulis">Papan Tulis</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="sound-system" name="fasilitas[]" value="sound-system">
                                <label for="sound-system">Sound System</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="kopi-teh" name="fasilitas[]" value="kopi-teh">
                                <label for="kopi-teh">Kopi & Teh</label>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="tujuan">Tujuan Penggunaan</label>
                        <div class="input-wrapper">
                            <textarea id="tujuan" name="tujuan" rows="4" placeholder="Jelaskan Tujuan Penggunaan Ruangan..."></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Popup Success Message -->
    <div id="successPopup" class="popup-overlay hidden">
        <div class="popup-card">
            <h2>Peminjaman Anda Di Simpan</h2>
            <button id="closePopup" class="popup-btn">Kembali</button>
        </div>
    </div>

    <script>
        // Get the form, popup, and close button elements
        const peminjamanForm = document.getElementById('peminjamanForm');
        const successPopup = document.getElementById('successPopup');
        const closePopupButton = document.getElementById('closePopup');

        // Listen for the form submission
        peminjamanForm.addEventListener('submit', function(event) {
            // Prevent the default form submission which reloads the page
            event.preventDefault(); 
            
            // Show the popup
            successPopup.classList.remove('hidden');

            // Here you would typically send the form data to the server using fetch()
            // For example:
            // const formData = new FormData(peminjamanForm);
            // fetch('/your-submit-url', { method: 'POST', body: formData })
            //   .then(response => response.json())
            //   .then(data => console.log('Success:', data))
            //   .catch(error => console.error('Error:', error));
        });

        // Listen for clicks on the "Kembali" button inside the popup
        closePopupButton.addEventListener('click', function() {
            // Hide the popup
            successPopup.classList.add('hidden');
        });
    </script>

</body>
</html>