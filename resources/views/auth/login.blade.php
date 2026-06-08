<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/presto.css') }}">
</head>
<body>
    <main class="auth-page auth-illustration">
        <section class="auth-card" aria-labelledby="login-title">
            <img class="auth-logo" src="{{ asset('assets/img/presto-emblem.svg') }}" alt="Logo PRESTO">
            <h1 id="login-title">Masuk ke PRESTO</h1>

            @if (session('error'))
                <p class="alert">{{ session('error') }}</p>
            @endif

            @if ($errors->any())
                <p class="alert">{{ $errors->first() }}</p>
            @endif

            <form action="{{ route('login.attempt') }}" method="post" class="auth-form">
                @csrf
                <input type="text" name="identifier" value="{{ old('identifier') }}" placeholder="Email atau NIM Mahasiswa" autocomplete="username">
                <input type="password" name="password" placeholder="Kata Sandi" autocomplete="current-password">
                <button type="submit">Masuk</button>
            </form>

            <a class="muted-link" href="#">Lupa Sandi?</a>
            <p class="auth-switch">Belum punya akun? <a href="{{ route('register') }}">Buat akun daftar</a></p>
        </section>
    </main>
</body>
</html>
