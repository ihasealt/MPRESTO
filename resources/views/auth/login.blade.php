<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Masuk ke PRESTO' }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/presto.css') }}">
</head>
<body class="auth-body">
    <div class="auth-scenic-overlay"></div>

    <main class="auth-page">
        <section class="auth-card" aria-labelledby="login-title">
            <div class="auth-logo-wrapper">
                <img class="auth-logo" src="{{ asset('assets/img/presto-emblem.svg') }}" alt="Logo PRESTO">
            </div>

            <h1 id="login-title">Masuk ke PRESTO</h1>
            <p class="auth-subtitle">Sistem Database Prestasi Mahasiswa</p>

            @if (session('error'))
                <div class="alert">
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert">
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ route('login.attempt') }}" method="post" class="auth-form">
                @csrf
                <div class="input-icon-group">
                    <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    <input type="text" name="identifier" value="{{ old('identifier', '240102054') }}" placeholder="Email atau NIM Mahasiswa" autocomplete="username" required>
                </div>

                <div class="input-icon-group">
                    <svg class="input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    <input type="password" name="password" value="password" placeholder="Kata Sandi" autocomplete="current-password" required>
                </div>

                <button type="submit" class="btn-auth-submit">
                    <span>Masuk</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </button>
            </form>

            <div class="auth-footer-links">
                <a class="muted-link" href="#">Lupa Kata Sandi?</a>
                <p class="auth-switch">Belum memiliki akun? <a href="{{ route('register') }}">Daftar Sekarang</a></p>
            </div>
        </section>
    </main>
</body>
</html>
