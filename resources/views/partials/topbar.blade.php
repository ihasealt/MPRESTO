<header class="topbar">
    <a class="topbar-brand" href="{{ route('dashboard') }}">
        @include('partials.brand')
    </a>

    <div class="topbar-actions">
        @if (session('is_logged_in'))
            <div class="user-profile-badge">
                <div class="avatar-circle">{{ strtoupper(substr(session('user_name', 'M'), 0, 1)) }}</div>
                <div class="user-profile-text">
                    <span class="user-profile-name">{{ session('user_name', 'Mahasiswa') }}</span>
                    <span class="role-pill">{{ session('user_role') === 'admin' ? 'Admin HIMATRIS' : 'Mahasiswa' }}</span>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="post" class="logout-form">
                @csrf
                <button class="btn btn-outline" type="submit">Keluar</button>
            </form>
        @else
            <a class="btn btn-outline" href="{{ route('login') }}">Masuk</a>
            <a class="btn btn-primary" href="{{ route('register') }}">Daftar</a>
        @endif
    </div>
</header>
