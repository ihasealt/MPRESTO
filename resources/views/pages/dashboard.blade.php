@extends('layouts.app')

@section('content')
    <section class="hero-panel">
        <div class="hero-badge">Sistem Database Prestasi Mahasiswa</div>
        <h1>Mengelola Prestasi dengan <span>Standar Profesional</span></h1>
        <p><strong>PRESTasi Online (PRESTO)</strong> dirancang untuk menjadi pusat data prestasi mahasiswa yang sistematis, terstruktur, dan dapat diakses secara transparan oleh mahasiswa maupun dosen.</p>

        <div class="hero-cta-group">
            <a href="{{ route('laporan') }}" class="btn-hero-primary">
                <span>Mulai Laporkan Prestasi</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
            <a href="{{ route('hall') }}" class="btn-hero-secondary">
                <span>Lihat Hall of Fame</span>
            </a>
        </div>

        <div class="feature-grid">
            <article class="feature-card">
                <div class="feature-icon-wrapper">
                    <span class="feature-icon document"></span>
                </div>
                <h2>Pendataan Terpusat</h2>
                <p>Semua pencapaian akademik dan non-akademik tersimpan rapi dan aman dalam database resmi sistem informasi.</p>
            </article>

            <article class="feature-card">
                <div class="feature-icon-wrapper">
                    <span class="feature-icon check"></span>
                </div>
                <h2>Verifikasi Resmi</h2>
                <p>Bukti sertifikat dan dokumen prestasi divalidasi langsung oleh tim verifikator HIMATRIS dan dosen pembina.</p>
            </article>

            <article class="feature-card">
                <div class="feature-icon-wrapper">
                    <span class="feature-icon medal"></span>
                </div>
                <h2>Apresiasi & Peringkat</h2>
                <p>Mahasiswa berprestasi mendapatkan poin portofolio dan ruang apresiasi eksklusif pada podium Hall of Fame.</p>
            </article>
        </div>

        <div class="stats-row">
            <div class="stat-item">
                <strong>500+</strong>
                <span>Prestasi Tercatat</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <strong>200+</strong>
                <span>Mahasiswa Aktif</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <strong>30+</strong>
                <span>Kompetisi Nasional</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <strong>10+</strong>
                <span>Prestasi Internasional</span>
            </div>
        </div>
    </section>
@endsection
