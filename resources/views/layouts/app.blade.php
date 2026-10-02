<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'PRESTO - Sistem Database Prestasi Mahasiswa' }}</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/presto.css') }}">
    @stack('styles')
</head>
<body>
    <div class="app-shell soft-bg">
        @include('partials.topbar')

        <div class="workspace">
            @include('partials.sidebar', ['active' => $active ?? ''])

            <main class="content">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
