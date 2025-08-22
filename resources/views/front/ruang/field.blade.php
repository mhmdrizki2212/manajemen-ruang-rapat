{{-- zona1.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ruangan Gedung Zona 1 - Pertamina Hulu Rokan</title>
    
    <link rel="stylesheet" href="{{ asset('anima/field.css') }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Work+Sans:wght@600;700&display=swap" rel="stylesheet">
</head>
<body>

    <div class="main-container">

        <header>
            <div class="container header-inner">
                <a href="/" class="logo">
                    <img src="{{ asset('anima/logo.png') }}" alt="Logo Pertamina">
                </a>
                <nav class="main-nav">
                    <a href="/">Beranda</a>
                    <a href="/#zona1" class="active">Lihat Jadwal</a>
                </nav>
                <div class="user-icons">
                    <a href="#" class="icon-link">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.4-1.4a2 2 0 01-.6-1.4V11a6 6 0 10-12 0v3.2c0 .5-.2 1-.6 1.4L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                    </a>
                    <div class="dropdown-container">
                        <a href="#" class="icon-link" id="user-menu-button">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </a>
                        <div id="user-dropdown" class="dropdown-menu hidden">
                            <a href="/profile" class="dropdown-item">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    
        <main class="container">
            <h1 class="main-title">Daftar Ruangan Gedung Zona 1</h1>
            
            <div class="tabs-container">
                <nav class="tabs-nav">
                    <a href="#" class="tab-link active" onclick="openTab(event, 'lantai1')">Lantai 1</a>
                    <a href="#" class="tab-link" onclick="openTab(event, 'lantai2')">Lantai 2</a>
                </nav>
            </div>

            <div id="lantai1" class="ruangan-list">
                @foreach($ruangs->where('lantai', 1) as $ruang)
                    @php
                        // Logika untuk membuat timeline jadwal
                        $startWork = \Carbon\Carbon::createFromTimeString('05:00:00');
                        $endWork = \Carbon\Carbon::createFromTimeString('17:00:00');
                        $jadwals = $ruang->jadwals->sortBy('jam_mulai');
                        
                        $timeline = [];
                        $lastEnd = clone $startWork;

                        foreach ($jadwals as $jadwal) {
                            $jamMulai = \Carbon\Carbon::parse($jadwal->jam_mulai);
                            $jamSelesai = \Carbon\Carbon::parse($jadwal->jam_selesai);

                            if ($jamMulai > $lastEnd) {
                                $timeline[] = ['status' => 'Tersedia', 'mulai' => $lastEnd->format('H:i'), 'selesai' => $jamMulai->format('H:i')];
                            }
                            $timeline[] = ['status' => 'Dipesan', 'mulai' => $jamMulai->format('H:i'), 'selesai' => $jamSelesai->format('H:i'), 'kegiatan' => $jadwal->kegiatan ?? 'Rapat Terjadwal'];
                            $lastEnd = $jamSelesai > $lastEnd ? $jamSelesai : $lastEnd;
                        }

                        if ($lastEnd < $endWork) {
                            $timeline[] = ['status' => 'Tersedia', 'mulai' => $lastEnd->format('H:i'), 'selesai' => $endWork->format('H:i')];
                        }

                        $isAvailableToday = collect($timeline)->where('status', 'Tersedia')->isNotEmpty();
                    @endphp

                    <div class="ruangan-item" 
                         data-nama="{{ $ruang->nama }}" 
                         data-img="{{ $ruang->img ? asset('storage/' . $ruang->img) : 'https://via.placeholder.com/400x250?text=No+Image' }}"
                         data-timeline="{{ json_encode($timeline) }}">
                        
                        <div class="ruangan-gambar">
                            <img src="{{ $ruang->img ? asset('storage/' . $ruang->img) : 'https://via.placeholder.com/400x250?text=No+Image' }}" alt="Ruang {{ $ruang->nama }}">
                        </div>
                        
                        <div class="ruangan-info">
                            <h2>{{ $ruang->nama }}</h2>
                            <div class="jadwal-ringkas">
                                @if($isAvailableToday)
                                    <p class="status-tersedia"><span class="status-dot"></span>Masih ada slot kosong hari ini</p>
                                @else
                                    <p class="status-dipesan"><span class="status-dot"></span>Penuh untuk hari ini</p>
                                @endif
                            </div>
                            <button class="btn btn-detail">Lihat Detail & Jadwal</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div id="lantai2" class="ruangan-list" style="display: none;">
                @foreach($ruangs->where('lantai', 2) as $ruang)
                    @php
                        $startWork = \Carbon\Carbon::createFromTimeString('05:00:00');
                        $endWork = \Carbon\Carbon::createFromTimeString('17:00:00');
                        $jadwals = $ruang->jadwals->sortBy('jam_mulai');
                        
                        $timeline = [];
                        $lastEnd = clone $startWork;

                        foreach ($jadwals as $jadwal) {
                            $jamMulai = \Carbon\Carbon::parse($jadwal->jam_mulai);
                            $jamSelesai = \Carbon\Carbon::parse($jadwal->jam_selesai);

                            if ($jamMulai > $lastEnd) {
                                $timeline[] = ['status' => 'Tersedia', 'mulai' => $lastEnd->format('H:i'), 'selesai' => $jamMulai->format('H:i')];
                            }
                            $timeline[] = ['status' => 'Dipesan', 'mulai' => $jamMulai->format('H:i'), 'selesai' => $jamSelesai->format('H:i'), 'kegiatan' => $jadwal->kegiatan ?? 'Rapat Terjadwal'];
                            $lastEnd = $jamSelesai > $lastEnd ? $jamSelesai : $lastEnd;
                        }

                        if ($lastEnd < $endWork) {
                            $timeline[] = ['status' => 'Tersedia', 'mulai' => $lastEnd->format('H:i'), 'selesai' => $endWork->format('H:i')];
                        }
                    @endphp
                    <div class="ruangan-item"
                         data-nama="{{ $ruang->nama }}"
                         data-img="{{ $ruang->img ? asset('storage/' . $ruang->img) : 'https://via.placeholder.com/400x250?text=No+Image' }}"
                         data-timeline="{{ json_encode($timeline) }}">
                        
                        <div class="ruangan-gambar">
                            <img src="{{ $ruang->img ? asset('storage/' . $ruang->img) : 'https://via.placeholder.com/400x250?text=No+Image' }}" alt="Ruang {{ $ruang->nama }}">
                        </div>

                        <div class="ruangan-info">
                            <h2>{{ $ruang->nama }}</h2>
                            <div class="jadwal-ringkas">
                                @if(collect($timeline)->where('status', 'Tersedia')->isNotEmpty())
                                    <p class="status-tersedia"><span class="status-dot"></span>Masih ada slot kosong hari ini</p>
                                @else
                                    <p class="status-dipesan"><span class="status-dot"></span>Penuh untuk hari ini</p>
                                @endif
                            </div>
                            <button class="btn btn-detail">Lihat Detail & Jadwal</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>

        <footer>
            <div class="container">
                 <div class="footer-logo">
                    <img src="{{ asset('anima/logo.png') }}" alt="Logo Pertamina Footer">
                </div>
                <div class="footer-info">
                    <p><strong>Address:</strong> Jl. Kol. M. Kukuh, Kenali Asam Atas, Kec. Kota Baru, Kota Jambi, Jambi 36128</p>
                    <p><strong>Email:</strong> asdfghjkl@pertamina.com</p>
                </div>
                <div class="footer-copyright">
                    <p>© Copyright PT Pertamina Hulu Rokan Zona 1 2025. All Right Reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <div id="detailModal" class="modal">
        <div class="modal-content">
            <h2 id="modal-title"></h2>
            <div id="modal-schedule">
                </div>
            <a href="/formpinjam/{{ $ruang->id }}" class="btn btn-tersedia">Pinjam</a>
            <button id="closeModal" class="btn-kembali">Kembali</button>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- Logika Dropdown User ---
    const userMenuButton = document.getElementById('user-menu-button');
    const userDropdown = document.getElementById('user-dropdown');

    userMenuButton.addEventListener('click', function (event) {
        event.stopPropagation();
        userDropdown.classList.toggle('hidden');
    });

    window.addEventListener('click', function () {
        if (!userDropdown.classList.contains('hidden')) {
            userDropdown.classList.add('hidden');
        }
    });

    // --- Logika Modal Detail Ruangan ---
    const modal = document.getElementById('detailModal');
    const modalTitle = document.getElementById('modal-title');
    const modalSchedule = document.getElementById('modal-schedule');
    const closeModal = document.getElementById('closeModal');
    const detailButtons = document.querySelectorAll('.btn-detail');

    detailButtons.forEach(button => {
        button.addEventListener('click', function () {
            const roomItem = this.closest('.ruangan-item');
            const nama = roomItem.dataset.nama;
            const timeline = JSON.parse(roomItem.dataset.timeline);

            modalTitle.textContent = 'Jadwal Lengkap: ' + nama;
            
            // Kosongkan jadwal sebelumnya
            modalSchedule.innerHTML = ''; 

            // Isi dengan jadwal baru
            if (timeline.length > 0) {
                timeline.forEach(slot => {
                    const item = document.createElement('div');
                    item.className = 'schedule-item';
                    
                    const time = document.createElement('span');
                    time.className = 'time';
                    time.textContent = `${slot.mulai} - ${slot.selesai}`;
                    
                    const status = document.createElement('span');
                    status.className = `status ${slot.status.toLowerCase()}`;
                    status.textContent = slot.status === 'Dipesan' ? (slot.kegiatan || 'Dipesan') : 'Tersedia';

                    item.appendChild(time);
                    item.appendChild(status);
                    modalSchedule.appendChild(item);
                });
            } else {
                modalSchedule.innerHTML = '<p>Tidak ada jadwal untuk ditampilkan.</p>';
            }
            
            modal.classList.add('visible');
        });
    });

    // Fungsi untuk menutup modal
    function hideModal() {
        modal.classList.remove('visible');
    }

    closeModal.addEventListener('click', hideModal);
    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            hideModal();
        }
    });
});

// --- Logika Tabs Lantai ---
function openTab(evt, tabId) {
    document.querySelectorAll('.ruangan-list').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.tab-link').forEach(link => link.classList.remove('active'));
    document.getElementById(tabId).style.display = 'grid'; // Gunakan 'grid' sesuai styling baru
    evt.currentTarget.classList.add('active');
}
</script>

</body>
</html>