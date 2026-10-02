@extends('layouts.app')

@section('content')
    <section class="hall-page">
        <div class="hall-header">
            <span class="eyebrow-badge">Ruang Apresiasi Tertinggi</span>
            <h1>Hall of Fame HIMATRIS 🌟</h1>
            <p>Penghargaan dan apresiasi resmi kepada mahasiswa Program Studi Sistem Informasi yang telah mengharumkan almamater melalui berbagai kejuaraan dan kompetisi bergengsi.</p>
        </div>

        <!-- The 3-Tier Podium -->
        <div class="podium-container">
            <!-- Rank 2: Silver (Left) -->
            @if (!empty($topThree['second']))
                <div class="podium-col podium-rank-2">
                    <div class="podium-card card-silver">
                        <div class="podium-badge badge-silver">
                            <span>🥈 #2</span>
                        </div>
                        <div class="podium-avatar avatar-silver">
                            {{ strtoupper(substr($topThree['second']['name'], 0, 1)) }}
                        </div>
                        <h3 class="podium-name">{{ $topThree['second']['name'] }}</h3>
                        <span class="podium-nim">{{ $topThree['second']['nim'] }} • {{ $topThree['second']['prodi'] }}</span>
                        <div class="podium-achievement">
                            <small>{{ $topThree['second']['top_achievement'] }}</small>
                        </div>
                        <div class="podium-points points-silver">
                            <strong>{{ number_format($topThree['second']['points'], 0, ',', '.') }}</strong>
                            <span>Poin</span>
                        </div>
                    </div>
                    <div class="pedestal pedestal-2">
                        <span class="pedestal-num">2</span>
                    </div>
                </div>
            @endif

            <!-- Rank 1: Gold (Center) -->
            @if (!empty($topThree['first']))
                <div class="podium-col podium-rank-1">
                    <div class="podium-card card-gold">
                        <div class="crown-icon">👑</div>
                        <div class="podium-badge badge-gold">
                            <span>🥇 #1 JUARA UMUM</span>
                        </div>
                        <div class="podium-avatar avatar-gold">
                            {{ strtoupper(substr($topThree['first']['name'], 0, 1)) }}
                        </div>
                        <h3 class="podium-name">{{ $topThree['first']['name'] }}</h3>
                        <span class="podium-nim">{{ $topThree['first']['nim'] }} • {{ $topThree['first']['prodi'] }}</span>
                        <div class="podium-achievement">
                            <small>{{ $topThree['first']['top_achievement'] }}</small>
                        </div>
                        <div class="podium-points points-gold">
                            <strong>{{ number_format($topThree['first']['points'], 0, ',', '.') }}</strong>
                            <span>Poin</span>
                        </div>
                    </div>
                    <div class="pedestal pedestal-1">
                        <span class="pedestal-num">1</span>
                    </div>
                </div>
            @endif

            <!-- Rank 3: Bronze (Right) -->
            @if (!empty($topThree['third']))
                <div class="podium-col podium-rank-3">
                    <div class="podium-card card-bronze">
                        <div class="podium-badge badge-bronze">
                            <span>🥉 #3</span>
                        </div>
                        <div class="podium-avatar avatar-bronze">
                            {{ strtoupper(substr($topThree['third']['name'], 0, 1)) }}
                        </div>
                        <h3 class="podium-name">{{ $topThree['third']['name'] }}</h3>
                        <span class="podium-nim">{{ $topThree['third']['nim'] }} • {{ $topThree['third']['prodi'] }}</span>
                        <div class="podium-achievement">
                            <small>{{ $topThree['third']['top_achievement'] }}</small>
                        </div>
                        <div class="podium-points points-bronze">
                            <strong>{{ number_format($topThree['third']['points'], 0, ',', '.') }}</strong>
                            <span>Poin</span>
                        </div>
                    </div>
                    <div class="pedestal pedestal-3">
                        <span class="pedestal-num">3</span>
                    </div>
                </div>
            @endif
        </div>

        <!-- Leaderboard Table (Ranks 4+) -->
        <section class="leaderboard-section">
            <div class="section-title-row">
                <div>
                    <h2>Peringkat Mahasiswa Berprestasi</h2>
                    <p>Daftar mahasiswa berprestasi dengan akumulasi poin terverifikasi berikutnya</p>
                </div>
                <a href="{{ route('prestasi.tambah') }}" class="btn-primary-action">
                    <span>+ Tingkatkan Poin Anda</span>
                </a>
            </div>

            <div class="table-container">
                <table class="leaderboard-table">
                    <thead>
                        <tr>
                            <th style="width: 70px;">Peringkat</th>
                            <th>Mahasiswa</th>
                            <th>Program Studi</th>
                            <th>Capaian Unggulan</th>
                            <th style="text-align: center;">Total Prestasi</th>
                            <th style="text-align: right;">Total Poin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaderboard as $student)
                            <tr>
                                <td>
                                    <span class="rank-circle">#{{ $student['rank'] }}</span>
                                </td>
                                <td>
                                    <div class="cell-student">
                                        <div class="avatar-mini">{{ strtoupper(substr($student['name'], 0, 1)) }}</div>
                                        <div>
                                            <strong>{{ $student['name'] }}</strong>
                                            <small>{{ $student['nim'] }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $student['prodi'] }}</td>
                                <td>
                                    <span class="cell-highlight">{{ $student['top_achievement'] }}</span>
                                </td>
                                <td style="text-align: center;">
                                    <span class="badge-count">{{ $student['total_achievements'] }} Prestasi</span>
                                </td>
                                <td style="text-align: right;">
                                    <strong class="leaderboard-points">+{{ number_format($student['points'], 0, ',', '.') }} Poin</strong>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </section>
@endsection
