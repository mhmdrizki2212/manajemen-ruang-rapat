{{-- zona1.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ruangan Gedung Zona 1 - Pertamina Hulu Rokan</title>
    
    <link rel="stylesheet" href="{{ asset('anima/zona1.css') }}">
    
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
                    {{-- Ikon Notifikasi --}}
                    <div class="dropdown-container">
                        {{-- ... (kode dropdown user tetap sama) ... --}}
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
                    @php
                        // =================================================================
                        // PENTING: Ganti bagian ini dengan data riwayat dari database Anda.
                        // Ini adalah data DUMMY untuk simulasi.
                        // Di aplikasi nyata, Anda harus mengirimkan data ini dari Controller.
                        $dummyHistory = [];
                        $users = ['Nadiatul Mawaddah', ];
                        $activities = ['Induction HC dan HSE'];
                        for ($i = 0; $i < 20; $i++) {
                            $dummyHistory[] = [
                                'tanggal' => \Carbon\Carbon::now()->subDays(rand(1, 30))->format('d M Y'),
                                'peminjam' => $users[array_rand($users)],
                                'kegiatan' => $activities[array_rand($activities)]
                            ];
                        }
                        // =================================================================
                    @endphp

                    <div class="ruangan-item" 
                         data-id-ruang="{{ $ruang->id }}"
                         data-nama="{{ $ruang->nama }}" 
                         data-history="{{ json_encode($dummyHistory) }}">
                        
                        <div class="ruangan-gambar">
                            <img src="{{ $ruang->img ? asset('storage/' . $ruang->img) : 'https://via.placeholder.com/400x250?text=No+Image' }}" alt="Ruang {{ $ruang->nama }}">
                        </div>
                        
                        <div class="ruangan-info">
                            <h2>{{ $ruang->nama }}</h2>
                            <div class="jadwal-ringkas">
                                <p class="status-tersedia"><span class="status-dot"></span>Lihat riwayat pemakaian ruangan</p>
                            </div>
                            <button class="btn btn-detail">Lihat Detail</button>
                        </div>
                    </div>
                @endforeach
            </div>
            @endforeach
        </main>

        <footer>
            {{-- ... (kode footer tetap sama) ... --}}
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
                 <!-- <a href="#" id="pinjam-button" class="btn btn-detail">Pinjam Ruangan Ini</a> -->
                <button id="closeModal" class="btn-kembali">Tutup</button>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- Logika Dropdown User (tetap sama) ---

    // --- Logika Modal Detail Ruangan (Logika Baru dengan Paginasi) ---
    const modal = document.getElementById('detailModal');
    const modalTitle = document.getElementById('modal-title');
    const modalSubtitle = document.getElementById('modal-subtitle');
    const tableBody = document.getElementById('modal-table-body');
    const closeModal = document.getElementById('closeModal');
    const detailButtons = document.querySelectorAll('.btn-detail');
    const paginationInfo = document.getElementById('pagination-info');
    const paginationControls = document.getElementById('pagination-controls');
    // const pinjamButton = document.getElementById('pinjam-button');

    let currentHistory = [];
    let currentPage = 1;
    const rowsPerPage = 6;

    function renderTable(page) {
        currentPage = page;
        tableBody.innerHTML = ''; // Kosongkan tabel
        
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const paginatedItems = currentHistory.slice(start, end);

        paginatedItems.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.tanggal}</td>
                <td>${item.peminjam}</td>
                <td>${item.kegiatan}</td>
            `;
            tableBody.appendChild(row);
        });

        renderPagination();
    }

    function renderPagination() {
        paginationControls.innerHTML = '';
        const pageCount = Math.ceil(currentHistory.length / rowsPerPage);
        
        // Update Info
        const startItem = (currentPage - 1) * rowsPerPage + 1;
        const endItem = Math.min(startItem + rowsPerPage - 1, currentHistory.length);
        paginationInfo.textContent = `Menampilkan ${startItem} sampai ${endItem} dari ${currentHistory.length} hasil...`;

        // Tombol Previous
        const prevButton = document.createElement('button');
        prevButton.textContent = 'Previous';
        prevButton.disabled = currentPage === 1;
        prevButton.addEventListener('click', () => renderTable(currentPage - 1));
        paginationControls.appendChild(prevButton);

        // Tombol Angka (simplifikasi untuk contoh)
        for (let i = 1; i <= pageCount; i++) {
            const pageButton = document.createElement('button');
            pageButton.textContent = i;
            if (i === currentPage) {
                pageButton.classList.add('active');
            }
            pageButton.addEventListener('click', () => renderTable(i));
            paginationControls.appendChild(pageButton);
        }

        // Tombol Next
        const nextButton = document.createElement('button');
        nextButton.textContent = 'Next';
        nextButton.disabled = currentPage === pageCount;
        nextButton.addEventListener('click', () => renderTable(currentPage + 1));
        paginationControls.appendChild(nextButton);
    }

    detailButtons.forEach(button => {
        button.addEventListener('click', function () {
            const roomItem = this.closest('.ruangan-item');
            const nama = roomItem.dataset.nama;
            const idRuang = roomItem.dataset.idRuang;

            modalTitle.textContent = nama;
            currentHistory = JSON.parse(roomItem.dataset.history);

            // Update link tombol pinjam
            // pinjamButton.href = `/formpinjam/${idRuang}`;

            renderTable(1); // Tampilkan halaman pertama
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

// --- Logika Tabs Lantai (tetap sama) ---
function openTab(evt, tabId) {
    document.querySelectorAll('.ruangan-list').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.tab-link').forEach(link => link.classList.remove('active'));
    document.getElementById(tabId).style.display = 'grid';
    evt.currentTarget.classList.add('active');
}
</script>

</body>
</html>