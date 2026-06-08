<header class="topbar">
    <a class="topbar-brand" href="{{ route('dashboard') }}">
        @include('partials.brand')
    </a>

    <div class="topbar-actions">
        @if (session('is_logged_in'))
            <span class="role-pill">{{ ucfirst(session('user_role', 'mahasiswa')) }}</span>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="btn btn-outline" type="submit">Keluar</button>
            </form>
        @else
            <a class="btn btn-outline" href="{{ route('login') }}">Masuk</a>
            <a class="btn btn-primary" href="{{ route('register') }}">Daftar</a>
        @endif
    </div>
</header>
