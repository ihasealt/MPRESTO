@extends('layouts.app')

@section('content')
    <section class="report-page">
        @if (session('success'))
            <p class="success-banner">{{ session('success') }}</p>
        @endif

        <div class="report-header">
            <div>
                <p class="eyebrow">{{ $role === 'admin' ? 'Panel Admin HIMATRIS' : 'Ruang Mahasiswa' }}</p>
                <h1>Helaur, {{ $name }}!</h1>
                <p>Setiap pencapaian adalah langkah menuju masa depan yang lebih gemilang. Laporkan prestasimu dan biarkan HIMATRIS membantu mengarsipkannya dengan rapi.</p>
            </div>

            <div class="points-card">
                <span>Total Akumulasi</span>
                <strong>0</strong>
                <small>Poin</small>
            </div>
        </div>

        <div class="report-toolbar">
            <label class="search-box">
                <span></span>
                <input type="search" placeholder="Cari Prestasi...">
            </label>
            <button class="add-report" type="button">+ Tambah Prestasi</button>
        </div>

        <section class="report-list" aria-labelledby="latest-report">
            <div class="list-heading">
                <h2 id="latest-report">Prestasi Terbaru Saya</h2>
                <a href="{{ route('arsip') }}">lihat semua</a>
            </div>

            <div class="empty-lines">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </section>

        <a class="hof-banner" href="{{ route('hall') }}">
            <strong>Masuk ke Hall of Fame HIMATRIS!</strong>
            <span>Terus tingkatkan prestasimu dan kumpulkan poin sebanyak-banyaknya untuk menjadi inspirasi bagi mahasiswa Program Studi Sistem Informasi.</span>
        </a>
    </section>
@endsection
