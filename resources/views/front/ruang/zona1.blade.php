{{-- zona1.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ruangan Gedung Zona 1 - Pertamina Hulu Rokan</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('anima/pertaminaicon.png') }}">


    <link rel="stylesheet" href="{{ asset('anima/zona1.css') }}">
    {{-- Menambahkan link ke file CSS form yang baru --}}
    <link rel="stylesheet" href="{{ asset('anima/zona1-form.css') }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Work+Sans:wght@600;700&display=swap"
        rel="stylesheet">
</head>

<body>

    <div class="main-container">
        <header>
            <div class="container header-inner">
                <div class="logo">
                    <img src="{{ asset('anima/logo.png') }}" alt="Logo Pertamina">
                </div>
                <nav class="main-nav">
                    <a href="/">Beranda</a>
                    <a href="/#zona1" class="active">Lihat Jadwal</a>
                </nav>
                <div class="user-icons">
                    <div class="dropdown-container">
                        <a href="#" class="icon-link" id="user-menu-button">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </a>
                        <div id="user-dropdown" class="dropdown-menu hidden">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item w-full text-left">Logout</button>
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
        
            @foreach(['1', '2'] as $lantai)
                <div id="lantai{{ $lantai }}" class="ruangan-list" style="{{ $lantai == '1' ? '' : 'display: none;' }}">
                    @foreach($ruangs->where('lantai', $lantai) as $ruang)
                        <div class="ruangan-item"
                             data-id-ruang="{{ $ruang->id }}"
                             data-nama="{{ $ruang->nama }}"
                             data-history="{{ json_encode(
                                $ruang->jadwals->map(function($jadwal) {
                                    return [
                                        'tanggal'   => \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y'),
                                        'peminjam'  => $jadwal->penanggung_jawab,
                                        'kegiatan'  => $jadwal->nama_kegiatan,
                                        'fungsi'    => $jadwal->fungsi,
                                    ];
                                })
                             ) }}">
        
                            <div class="ruangan-gambar">
                                <img src="{{ $ruang->img ? asset('storage/' . $ruang->img) : 'https://via.placeholder.com/400x250?text=No+Image' }}"
                                     alt="Ruang {{ $ruang->nama }}">
                            </div>
        
                            @php
                                $jadwalHariIni = $ruang->jadwals->filter(function($j) {
                                    return \Carbon\Carbon::parse($j->tanggal)->isToday();
                                });
                            @endphp
        
                            <div class="ruangan-info">
                                <h2>{{ $ruang->nama }}</h2>
        
                                <div class="jadwal-ringkas">
                                    @if($jadwalHariIni->isEmpty())
                                        <p class="status-tersedia">
                                            <span class="status-dot"></span> Tersedia
                                        </p>
                                    @else
                                        <p class="status-terpakai">
                                            <span class="status-dot"></span> Terpakai
                                        </p>
                                        @foreach($jadwalHariIni as $jadwal)
                                            <p class="status-terpakai">
                                                {{ $jadwal->fungsi }} : {{ $jadwal->nama_kegiatan }}
                                            </p>
                                        @endforeach
                                    @endif
                                </div>
                                <div style="display: flex; gap: 10px;">
                                    <button class="btn btn-detail">Lihat Detail</button>
                                    <button class="btn btn-pinjam">Pinjam</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </main>
        
        <footer>
            {{-- ... --}}
        </footer>
    </div>

    <div id="detailModal" class="modal">
        <div class="modal-content">
            <h2 id="modal-title">Detail Ruangan</h2>
            <p id="modal-subtitle">Lihat detail riwayat ruangan</p>

            <div class="history-container">
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Peminjam</th>
                            <th>Kegiatan</th>
                            <th>Fungsi</th>
                        </tr>
                    </thead>
                    <tbody id="modal-table-body">
                    </tbody>
                </table>
                <div class="pagination-footer">
                    <span id="pagination-info"></span>
                    <div class="pagination-controls" id="pagination-controls">
                    </div>
                </div>
            </div>

            <div class="modal-actions">
                <button id="closeModal" class="btn-kembali">Tutup</button>
            </div>
        </div>
    </div>

    <div id="bookingModal" class="modal">
        <div class="modal-content" style="max-width: 850px; padding: 0; background: transparent; box-shadow: none;">
            <div class="form-container">
                <div class="form-header">
                    <h1>Form Peminjaman Ruang</h1>
                    <p>Isi Formulir Berikut Untuk Meminjam Ruangan</p>
                </div>
                <form id="jadwalForm" action="{{ route('ruang.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nama User</label>
                        <input type="text" value="{{ Auth::user()->name }}" readonly class="input-field" />
                        <input type="hidden" name="user_admin_id" value="{{ Auth::id() }}">
                    </div>
                    <div class="form-group">
                        <label for="ruang_id">Pilih Ruangan</label>
                        <div class="input-wrapper">
                            <select id="modal-ruang-id" name="ruang_id" required class="select-field">
                                <option value="" disabled>Pilih Ruangan yang tersedia...</option>
                                @foreach($ruangs as $ruang)
                                    <option value="{{ $ruang->id }}">{{ $ruang->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="penanggung_jawab">Penanggung Jawab</label>
                        <input type="text" id="penanggung_jawab" name="penanggung_jawab" value="{{ old('penanggung_jawab') }}" required class="input-field" placeholder="Masukkan Nama Penanggung Jawab...">
                    </div>
                    <div class="form-group">
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                        <input type="text" id="nama_kegiatan" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}" required class="input-field" placeholder="Masukkan Nama Kegiatan...">
                    </div>
                    <div class="form-group">
                        <label for="fungsi">Fungsi / Divisi</label>
                        <input type="text" id="fungsi" name="fungsi" value="{{ old('fungsi') }}" required class="input-field" placeholder="Masukkan Fungsi atau Divisi Anda...">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="jumlah_peserta">Jumlah Peserta</label>
                            <div class="input-wrapper">
                                <input type="number" id="jumlah_peserta" name="jumlah_peserta" value="{{ old('jumlah_peserta') }}" min="1" required class="input-field" placeholder="Masukkan Jumlah...">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal Penggunaan</label>
                            <div class="input-wrapper">
                                <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" min="{{ date('Y-m-d') }}" required class="input-field">
                                <span class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Fasilitas</label>
                        <div class="checkbox-group">
                            <label class="checkbox-item"><input type="checkbox" name="fasilitas[]" value="classroom Fasilitas Tambahan"> classroom Fasilitas Tambahan</label>
                            <label class="checkbox-item"><input type="checkbox" name="fasilitas[]" value="Infocus & Screen"> Infocus & Screen</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="catatan_pelaksanaan">Tujuan Penggunaan</label>
                        <textarea id="catatan_pelaksanaan" name="catatan_pelaksanaan" rows="3" class="input-field" placeholder="Jelaskan Tujuan Penggunaan Ruangan...">{{ old('catatan_pelaksanaan') }}</textarea>
                    </div>
                    <div class="form-footer">
                        <button type="button" id="closeBookingModal" class="btn-back">Tutup</button>
                        <button type="submit" class="btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // --- Logika Dropdown User (tetap sama) ---
            const userMenuButton = document.getElementById('user-menu-button');
            const userDropdown = document.getElementById('user-dropdown');
            userMenuButton.addEventListener('click', function (event) {
                event.stopPropagation();
                userDropdown.classList.toggle('hidden');
            });
            window.addEventListener('click', function (event) {
                if (!userDropdown.classList.contains('hidden')) {
                    userDropdown.classList.add('hidden');
                }
            });

            // --- Logika Modal Detail Ruangan (tetap sama) ---
            const detailModal = document.getElementById('detailModal');
            const modalTitle = document.getElementById('modal-title');
            const tableBody = document.getElementById('modal-table-body');
            const closeModal = document.getElementById('closeModal');
            const detailButtons = document.querySelectorAll('.btn-detail');
            const paginationInfo = document.getElementById('pagination-info');
            const paginationControls = document.getElementById('pagination-controls');
            let currentHistory = [];
            let currentPage = 1;
            const rowsPerPage = 6;
            
            function renderTable(page) {
                currentPage = page;
                tableBody.innerHTML = '';
                const start = (page - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                const paginatedItems = currentHistory.slice(start, end);
                paginatedItems.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td>${item.tanggal}</td><td>${item.peminjam}</td><td>${item.kegiatan}</td><td>${item.fungsi}</td>`;
                    tableBody.appendChild(row);
                });
                renderPagination();
            }

            function renderPagination() {
                paginationControls.innerHTML = '';
                const pageCount = Math.ceil(currentHistory.length / rowsPerPage);
                const startItem = (currentPage - 1) * rowsPerPage + 1;
                const endItem = Math.min(startItem + rowsPerPage - 1, currentHistory.length);
                paginationInfo.textContent = `Menampilkan ${startItem} sampai ${endItem} dari ${currentHistory.length} hasil...`;
                const prevButton = document.createElement('button');
                prevButton.textContent = 'Previous';
                prevButton.disabled = currentPage === 1;
                prevButton.addEventListener('click', () => renderTable(currentPage - 1));
                paginationControls.appendChild(prevButton);
                for (let i = 1; i <= pageCount; i++) {
                    const pageButton = document.createElement('button');
                    pageButton.textContent = i;
                    if (i === currentPage) { pageButton.classList.add('active'); }
                    pageButton.addEventListener('click', () => renderTable(i));
                    paginationControls.appendChild(pageButton);
                }
                const nextButton = document.createElement('button');
                nextButton.textContent = 'Next';
                nextButton.disabled = currentPage === pageCount;
                nextButton.addEventListener('click', () => renderTable(currentPage + 1));
                paginationControls.appendChild(nextButton);
            }

            detailButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const roomItem = this.closest('.ruangan-item');
                    modalTitle.textContent = roomItem.dataset.nama;
                    currentHistory = JSON.parse(roomItem.dataset.history);
                    renderTable(1);
                    detailModal.classList.add('visible');
                    document.body.classList.add('modal-open');
                });
            });

            function hideDetailModal() { 
                detailModal.classList.remove('visible');
                document.body.classList.remove('modal-open');
            }
            closeModal.addEventListener('click', hideDetailModal);
            detailModal.addEventListener('click', function (e) { if (e.target === detailModal) { hideDetailModal(); } });

            // === JAVASCRIPT BARU UNTUK MODAL BOOKING ===
            const bookingModal = document.getElementById('bookingModal');
            const pinjamButtons = document.querySelectorAll('.btn-pinjam');
            const closeBookingModal = document.getElementById('closeBookingModal');
            const ruangSelect = document.getElementById('modal-ruang-id');

            pinjamButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const roomItem = this.closest('.ruangan-item');
                    const idRuang = roomItem.dataset.idRuang;
                    if(ruangSelect) {
                        ruangSelect.value = idRuang;
                    }
                    bookingModal.classList.add('visible');
                    document.body.classList.add('modal-open');
                });
            });

            function hideBookingModal() {
                bookingModal.classList.remove('visible');
                document.body.classList.remove('modal-open');
            }

            closeBookingModal.addEventListener('click', hideBookingModal);
            bookingModal.addEventListener('click', function (e) {
                if (e.target === bookingModal) {
                    hideBookingModal();
                }
            });
        });

        function openTab(evt, tabId) {
            document.querySelectorAll('.ruangan-list').forEach(el => el.style.display = 'none');
            document.querySelectorAll('.tab-link').forEach(link => link.classList.remove('active'));
            document.getElementById(tabId).style.display = 'grid';
            evt.currentTarget.classList.add('active');
        }
    </script>

</body>

</html>