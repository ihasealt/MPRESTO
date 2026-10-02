@extends('layouts.app')

@section('content')
    <section class="report-page">
        @if (session('success'))
            <div class="success-banner">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="report-header">
            <div class="report-greeting">
                <span class="eyebrow-badge">{{ $role === 'admin' ? 'Panel Admin HIMATRIS' : 'Ruang Mahasiswa' }}</span>
                <h1>Halo, {{ $name }}!</h1>
                <p>Setiap pencapaian adalah langkah menuju masa depan yang lebih gemilang. Laporkan prestasimu dan biarkan HIMATRIS membantu mengarsipkannya dengan rapi dan terstandar.</p>
            </div>

            <div class="points-card">
                <span class="points-label">Total Akumulasi</span>
                <strong class="points-value">{{ number_format($totalPoin, 0, ',', '.') }}</strong>
                <span class="points-unit">Poin Prestasi</span>
                <div class="points-glow"></div>
            </div>
        </div>

        <div class="report-toolbar">
            <form action="{{ route('laporan') }}" method="GET" class="search-form">
                <div class="search-box">
                    <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <input type="search" name="q" value="{{ $search ?? '' }}" placeholder="Cari prestasi, kategori, atau tingkat..." autocomplete="off">
                </div>
            </form>
            <a href="{{ route('prestasi.tambah') }}" class="add-report">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                <span>Tambah Prestasi</span>
            </a>
        </div>

        <section class="report-list" aria-labelledby="latest-report">
            <div class="list-heading">
                <div>
                    <h2 id="latest-report">Prestasi Terbaru Saya</h2>
                    <span class="list-subheading">Daftar riwayat prestasi yang telah diajukan</span>
                </div>
                <a href="{{ route('arsip') }}" class="view-all-link">
                    <span>Lihat Semua Arsip</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </a>
            </div>

            @if (count($achievements) > 0)
                <div class="achievement-cards">
                    @foreach ($achievements as $item)
                        <article class="achievement-item">
                            <div class="achievement-main">
                                <div class="achievement-badges">
                                    <span class="badge-level badge-{{ strtolower($item['tingkat']) }}">{{ $item['tingkat'] }}</span>
                                    <span class="badge-category">{{ $item['kategori'] }}</span>
                                    <span class="badge-year">{{ $item['tahun'] ?? '2024' }}</span>
                                </div>
                                <h3 class="achievement-title">{{ $item['judul'] }}</h3>
                                <div class="achievement-meta">
                                    <span><strong>Penyelenggara:</strong> {{ $item['penyelenggara'] }}</span>
                                    <span class="meta-sep">•</span>
                                    <span><strong>Tanggal:</strong> {{ $item['tanggal'] }}</span>
                                </div>
                            </div>

                            <div class="achievement-side">
                                <div class="achievement-points">
                                    <strong>+{{ $item['poin'] }}</strong>
                                    <small>Poin</small>
                                </div>
                                <div>
                                    @if ($item['status'] === 'Terverifikasi')
                                        <span class="status-pill status-verified">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            <span>Terverifikasi</span>
                                        </span>
                                    @elseif ($item['status'] === 'Menunggu Verifikasi')
                                        <span class="status-pill status-pending">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                            <span>Menunggu</span>
                                        </span>
                                    @else
                                        <span class="status-pill status-rejected">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                            <span>Ditolak</span>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">🏆</div>
                    <h3>Belum ada prestasi yang cocok</h3>
                    <p>Mulai tambahkan prestasi membanggakanmu untuk diarsipkan secara resmi oleh HIMATRIS.</p>
                    <a href="{{ route('prestasi.tambah') }}" class="btn btn-primary">+ Tambah Prestasi Baru</a>
                </div>
            @endif
        </section>

        <a class="hof-banner" href="{{ route('hall') }}">
            <div class="hof-content">
                <strong>Masuk ke Hall of Fame HIMATRIS! 🌟</strong>
                <p>Terus tingkatkan prestasimu dan kumpulkan poin sebanyak-banyaknya untuk menempati podium penghargaan mahasiswa terbaik Program Studi Sistem Informasi.</p>
            </div>
            <div class="hof-badge-action">
                <span>Lihat Peringkat</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </div>
        </a>
    </section>
@endsection
