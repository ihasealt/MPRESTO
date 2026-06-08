<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'PRESTO' }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/presto.css') }}">
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
</body>
</html>
