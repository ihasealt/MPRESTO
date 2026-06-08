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
        <section class="auth-card register-card" aria-labelledby="register-title">
            <img class="auth-logo" src="{{ asset('assets/img/presto-emblem.svg') }}" alt="Logo PRESTO">
            <h1 id="register-title">Daftar Akun</h1>

            @if ($errors->any())
                <p class="alert">{{ $errors->first() }}</p>
            @endif

            <form action="{{ route('register.store') }}" method="post" class="auth-form">
                @csrf
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Mahasiswa" autocomplete="name">
                <input type="text" name="identifier" value="{{ old('identifier') }}" placeholder="Nomor Induk Mahasiswa" autocomplete="username">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" autocomplete="email">
                <input type="password" name="password" placeholder="Kata Sandi" autocomplete="new-password">
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" autocomplete="new-password">
                <button type="submit">Daftar</button>
            </form>

            <p class="auth-switch">Sudah punya akun? <a href="{{ route('login') }}">Masuk disini</a></p>
        </section>
    </main>
</body>
</html>
