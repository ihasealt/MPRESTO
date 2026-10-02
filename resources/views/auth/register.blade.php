<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Daftar Akun PRESTO' }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/presto.css') }}">
</head>
<body class="auth-body">
    <div class="auth-scenic-overlay"></div>

    <main class="auth-page">
        <section class="auth-card register-card" aria-labelledby="register-title">
            <div class="auth-logo-wrapper">
                <img class="auth-logo" src="{{ asset('assets/img/presto-emblem.svg') }}" alt="Logo PRESTO">
            </div>

            <h1 id="register-title">Daftar Akun Baru</h1>
            <p class="auth-subtitle">Registrasi Mahasiswa Program Studi Sistem Informasi</p>

            @if ($errors->any())
                <div class="alert">
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ route('register.store') }}" method="post" class="auth-form">
                @csrf
                <div class="input-icon-group">
                    <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap Mahasiswa" autocomplete="name" required>
                </div>

                <div class="input-icon-group">
                    <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    <input type="text" name="identifier" value="{{ old('identifier') }}" placeholder="Nomor Induk Mahasiswa (NIM)" autocomplete="username" required>
                </div>

                <div class="input-icon-group">
                    <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Alamat Email Mahasiswa" autocomplete="email" required>
                </div>

                <div class="input-icon-group">
                    <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    <input type="password" name="password" placeholder="Kata Sandi Baru" autocomplete="new-password" required>
                </div>

                <div class="input-icon-group">
                    <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    <input type="password" name="password_confirmation" placeholder="Ulangi Kata Sandi" autocomplete="new-password" required>
                </div>

                <button type="submit" class="btn-auth-submit">
                    <span>Daftarkan Akun</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </button>
            </form>

            <div class="auth-footer-links">
                <p class="auth-switch">Sudah memiliki akun? <a href="{{ route('login') }}">Masuk Sekarang</a></p>
            </div>
        </section>
    </main>
</body>
</html>
