@php
    $active = $active ?? '';
    $items = [
        ['key' => 'dashboard', 'label' => 'Dashboard', 'url' => route('dashboard'), 'icon' => 'grid'],
        ['key' => 'laporan', 'label' => 'Laporan', 'url' => route('laporan'), 'icon' => 'pin'],
        ['key' => 'arsip', 'label' => 'Arsip Prestasi', 'url' => route('arsip'), 'icon' => 'archive'],
        ['key' => 'hall', 'label' => 'Hall of Fame', 'url' => route('hall'), 'icon' => 'star'],
    ];
@endphp

<aside class="sidebar">
    <nav class="side-nav" aria-label="Navigasi utama">
        @foreach ($items as $item)
            <a class="side-link {{ $active === $item['key'] ? 'is-active' : '' }}" href="{{ $item['url'] }}">
                <span class="side-icon side-icon-{{ $item['icon'] }}"></span>
                <span>{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>
</aside>
