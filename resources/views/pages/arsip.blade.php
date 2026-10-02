@extends('layouts.app')

@section('content')
    <section class="arsip-page">
        <div class="page-header">
            <div>
                <span class="eyebrow-badge">Pusat Data Terpadu</span>
                <h1>Arsip Prestasi Mahasiswa 📂</h1>
                <p>Kumpulan rekam jejak prestasi mahasiswa yang telah terdata dan terverifikasi secara resmi oleh HIMATRIS.</p>
            </div>
            <a href="{{ route('prestasi.tambah') }}" class="btn-primary-action">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                <span>+ Laporkan Prestasi</span>
            </a>
        </div>

        <!-- Filter & Search Toolbar -->
        <div class="arsip-toolbar">
            <form action="{{ route('arsip') }}" method="GET" class="filter-form">
                <div class="search-box">
                    <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <input type="search" name="q" value="{{ $search ?? '' }}" placeholder="Cari nama, NIM, atau judul prestasi..." autocomplete="off">
                </div>

                <div class="filter-selects">
                    <select name="tingkat" onchange="this.form.submit()">
                        <option value="">Semua Tingkat</option>
                        <option value="Internasional" {{ ($selectedTingkat ?? '') === 'Internasional' ? 'selected' : '' }}>Internasional</option>
                        <option value="Nasional" {{ ($selectedTingkat ?? '') === 'Nasional' ? 'selected' : '' }}>Nasional</option>
                        <option value="Regional" {{ ($selectedTingkat ?? '') === 'Regional' ? 'selected' : '' }}>Regional</option>
                        <option value="Provinsi" {{ ($selectedTingkat ?? '') === 'Provinsi' ? 'selected' : '' }}>Provinsi</option>
                        <option value="Universitas" {{ ($selectedTingkat ?? '') === 'Universitas' ? 'selected' : '' }}>Universitas</option>
                    </select>

                    <select name="kategori" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        <option value="Teknologi & Desain" {{ ($selectedKategori ?? '') === 'Teknologi & Desain' ? 'selected' : '' }}>Teknologi & Desain</option>
                        <option value="Akademik & Sains" {{ ($selectedKategori ?? '') === 'Akademik & Sains' ? 'selected' : '' }}>Akademik & Sains</option>
                        <option value="Karya Ilmiah" {{ ($selectedKategori ?? '') === 'Karya Ilmiah' ? 'selected' : '' }}>Karya Ilmiah</option>
                        <option value="Wirausaha & Bisnis" {{ ($selectedKategori ?? '') === 'Wirausaha & Bisnis' ? 'selected' : '' }}>Wirausaha & Bisnis</option>
                        <option value="Seni & Budaya" {{ ($selectedKategori ?? '') === 'Seni & Budaya' ? 'selected' : '' }}>Seni & Budaya</option>
                        <option value="Olahraga" {{ ($selectedKategori ?? '') === 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                    </select>

                    <select name="status" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="Terverifikasi" {{ ($selectedStatus ?? '') === 'Terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                        <option value="Menunggu Verifikasi" {{ ($selectedStatus ?? '') === 'Menunggu Verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                    </select>

                    @if ($search || $selectedTingkat || $selectedKategori || $selectedStatus)
                        <a href="{{ route('arsip') }}" class="btn-reset-filter" title="Reset Filter">Reset</a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Data Table -->
        <div class="table-container">
            <table class="arsip-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Mahasiswa</th>
                        <th>Nama Kegiatan / Prestasi</th>
                        <th>Tingkat & Kategori</th>
                        <th>Tanggal</th>
                        <th>Poin</th>
                        <th>Status</th>
                        <th style="text-align: center; width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($achievements as $index => $item)
                        <tr>
                            <td class="text-muted">{{ $index + 1 }}</td>
                            <td>
                                <div class="cell-student">
                                    <div class="avatar-mini">{{ strtoupper(substr($item['mahasiswa'], 0, 1)) }}</div>
                                    <div>
                                        <strong>{{ $item['mahasiswa'] }}</strong>
                                        <small>{{ $item['nim'] }} • {{ $item['prodi'] }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="cell-achievement">
                                    <span class="achievement-cell-title">{{ $item['judul'] }}</span>
                                    <small class="text-muted">{{ $item['penyelenggara'] }}</small>
                                </div>
                            </td>
                            <td>
                                <div class="cell-badges">
                                    <span class="badge-level badge-{{ strtolower($item['tingkat']) }}">{{ $item['tingkat'] }}</span>
                                    <span class="badge-sub">{{ $item['kategori'] }}</span>
                                </div>
                            </td>
                            <td class="text-nowrap">{{ $item['tanggal'] }}</td>
                            <td>
                                <span class="badge-points">+{{ $item['poin'] }} Poin</span>
                            </td>
                            <td>
                                @if ($item['status'] === 'Terverifikasi')
                                    <span class="status-pill status-verified">Terverifikasi</span>
                                @elseif ($item['status'] === 'Menunggu Verifikasi')
                                    <span class="status-pill status-pending">Menunggu</span>
                                @else
                                    <span class="status-pill status-rejected">Ditolak</span>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="btn-detail" onclick="openDetailModal({{ json_encode($item) }})">
                                    <span>Detail</span>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="table-empty">
                                <div class="empty-state">
                                    <p>Tidak ada data prestasi yang cocok dengan kriteria pencarian.</p>
                                    <a href="{{ route('arsip') }}" class="btn-reset-link">Tampilkan Semua Data</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <!-- Modal Detail Prestasi -->
    <div id="detailModal" class="modal-backdrop" style="display: none;">
        <div class="modal-card">
            <div class="modal-header">
                <div>
                    <span id="modalStatusPill" class="status-pill status-verified">Status</span>
                    <h2 id="modalTitle">Detail Capaian Prestasi</h2>
                </div>
                <button type="button" class="btn-close-modal" onclick="closeDetailModal()">&times;</button>
            </div>

            <div class="modal-body">
                <div class="modal-section modal-student-info">
                    <div class="avatar-modal" id="modalAvatar">N</div>
                    <div>
                        <h3 id="modalStudentName">Nama Mahasiswa</h3>
                        <p id="modalStudentMeta">NIM • Program Studi</p>
                    </div>
                </div>

                <div class="modal-grid-2">
                    <div class="modal-item">
                        <small>Tingkat Kompetisi</small>
                        <strong id="modalTingkat">-</strong>
                    </div>
                    <div class="modal-item">
                        <small>Capaian / Peringkat</small>
                        <strong id="modalPeringkat">-</strong>
                    </div>
                    <div class="modal-item">
                        <small>Kategori Bidang</small>
                        <strong id="modalKategori">-</strong>
                    </div>
                    <div class="modal-item">
                        <small>Akumulasi Poin</small>
                        <strong id="modalPoin" class="text-gold">+0 Poin</strong>
                    </div>
                    <div class="modal-item">
                        <small>Penyelenggara</small>
                        <strong id="modalPenyelenggara">-</strong>
                    </div>
                    <div class="modal-item">
                        <small>Tanggal Pelaksanaan</small>
                        <strong id="modalTanggal">-</strong>
                    </div>
                </div>

                <div class="modal-item full-width">
                    <small>Catatan Verifikator HIMATRIS</small>
                    <p id="modalCatatan" class="catatan-box">Sertifikat dan dokumen pendukung telah divalidasi secara resmi.</p>
                </div>

                <div class="modal-item full-width">
                    <small>Berkas Bukti Dokumen</small>
                    <div class="file-attachment">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                        <span id="modalBerkas">sertifikat_prestasi.pdf</span>
                        <span class="file-valid-tag">Terlampir</span>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeDetailModal()">Tutup</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function openDetailModal(data) {
        document.getElementById('modalTitle').textContent = data.judul;
        document.getElementById('modalStudentName').textContent = data.mahasiswa;
        document.getElementById('modalStudentMeta').textContent = data.nim + ' • ' + (data.prodi || 'Sistem Informasi');
        document.getElementById('modalAvatar').textContent = data.mahasiswa.charAt(0).toUpperCase();
        document.getElementById('modalTingkat').textContent = data.tingkat;
        document.getElementById('modalPeringkat').textContent = data.peringkat || '-';
        document.getElementById('modalKategori').textContent = data.kategori;
        document.getElementById('modalPoin').textContent = '+' + data.poin + ' Poin';
        document.getElementById('modalPenyelenggara').textContent = data.penyelenggara;
        document.getElementById('modalTanggal').textContent = data.tanggal;
        document.getElementById('modalCatatan').textContent = data.catatan || 'Dokumen telah terverifikasi oleh tim kemahasiswaan.';
        document.getElementById('modalBerkas').textContent = data.berkas || 'berkas_prestasi.pdf';

        const statusPill = document.getElementById('modalStatusPill');
        statusPill.className = 'status-pill';
        if (data.status === 'Terverifikasi') {
            statusPill.classList.add('status-verified');
            statusPill.textContent = 'Terverifikasi';
        } else if (data.status === 'Menunggu Verifikasi') {
            statusPill.classList.add('status-pending');
            statusPill.textContent = 'Menunggu Verifikasi';
        } else {
            statusPill.classList.add('status-rejected');
            statusPill.textContent = 'Ditolak';
        }

        document.getElementById('detailModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeDetailModal() {
        document.getElementById('detailModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('detailModal');
        if (event.target === modal) {
            closeDetailModal();
        }
    }
</script>
@endpush
