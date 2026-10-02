<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    private function getInitialAchievements(): array
    {
        return [
            [
                'id' => 1,
                'nim' => '240102054',
                'mahasiswa' => 'Nadya Adella Putri',
                'prodi' => 'Sistem Informasi',
                'judul' => 'Juara 1 UI/UX Design Competition National Techfest 2024',
                'kategori' => 'Teknologi & Desain',
                'tingkat' => 'Nasional',
                'peringkat' => 'Juara 1',
                'penyelenggara' => 'Institut Teknologi Bandung & HIMATIF',
                'tanggal' => '18 Mei 2024',
                'tahun' => '2024',
                'poin' => 200,
                'status' => 'Terverifikasi',
                'catatan' => 'Sertifikat dan Surat Tugas telah divalidasi oleh Tim Verifikasi HIMATRIS.',
                'berkas' => 'sertifikat-techfest-2024.pdf',
            ],
            [
                'id' => 2,
                'nim' => '240102054',
                'mahasiswa' => 'Nadya Adella Putri',
                'prodi' => 'Sistem Informasi',
                'judul' => 'Juara 2 International Web Development Hackathon 2024',
                'kategori' => 'Teknologi & Desain',
                'tingkat' => 'Internasional',
                'peringkat' => 'Juara 2',
                'penyelenggara' => 'Global Tech Innovators Singapore',
                'tanggal' => '12 Juli 2024',
                'tahun' => '2024',
                'poin' => 250,
                'status' => 'Terverifikasi',
                'catatan' => 'Validasi internasional terkonfirmasi via portal resmi penyelenggara.',
                'berkas' => 'international-hackathon-cert.pdf',
            ],
            [
                'id' => 3,
                'nim' => '230101012',
                'mahasiswa' => 'Ahmad Rizky Pratama',
                'prodi' => 'Teknik Informatika',
                'judul' => 'Juara 1 Gemastik Divisi Pemrograman 2024',
                'kategori' => 'Akademik & Sains',
                'tingkat' => 'Nasional',
                'peringkat' => 'Juara 1',
                'penyelenggara' => 'Puspresnas Kemendikbudristek',
                'tanggal' => '20 Agustus 2024',
                'tahun' => '2024',
                'poin' => 200,
                'status' => 'Terverifikasi',
                'catatan' => 'Sertifikat juara dan medali emas resmi.',
                'berkas' => 'gemastik-juara-1.pdf',
            ],
            [
                'id' => 4,
                'nim' => '230101012',
                'mahasiswa' => 'Ahmad Rizky Pratama',
                'prodi' => 'Teknik Informatika',
                'judul' => 'Juara 2 National Data Science Challenge 2024',
                'kategori' => 'Akademik & Sains',
                'tingkat' => 'Nasional',
                'peringkat' => 'Juara 2',
                'penyelenggara' => 'Universitas Indonesia',
                'tanggal' => '05 September 2024',
                'tahun' => '2024',
                'poin' => 180,
                'status' => 'Terverifikasi',
                'catatan' => 'Dokumen terverifikasi lengkap.',
                'berkas' => 'ui-datascience-cert.pdf',
            ],
            [
                'id' => 5,
                'nim' => '240102019',
                'mahasiswa' => 'Siti Nurhaliza',
                'prodi' => 'Sistem Informasi',
                'judul' => 'Juara 2 Competitive Programming Contest ASC 2024',
                'kategori' => 'Akademik & Sains',
                'tingkat' => 'Nasional',
                'peringkat' => 'Juara 2',
                'penyelenggara' => 'Asian Science Council',
                'tanggal' => '14 Juni 2024',
                'tahun' => '2024',
                'poin' => 180,
                'status' => 'Terverifikasi',
                'catatan' => 'Terverifikasi oleh departemen.',
                'berkas' => 'sertifikat-asc-2024.pdf',
            ],
            [
                'id' => 6,
                'nim' => '240102019',
                'mahasiswa' => 'Siti Nurhaliza',
                'prodi' => 'Sistem Informasi',
                'judul' => 'Juara 3 Business Plan Competition Regional Java 2024',
                'kategori' => 'Wirausaha & Bisnis',
                'tingkat' => 'Regional',
                'peringkat' => 'Juara 3',
                'penyelenggara' => 'Kadin Jawa Timur',
                'tanggal' => '02 Oktober 2024',
                'tahun' => '2024',
                'poin' => 140,
                'status' => 'Terverifikasi',
                'catatan' => 'Dokumen lengkap dan absensi valid.',
                'berkas' => 'sertifikat-business-plan.pdf',
            ],
            [
                'id' => 7,
                'nim' => '230102088',
                'mahasiswa' => 'Budi Santoso',
                'prodi' => 'Teknik Komputer',
                'judul' => 'Juara 1 Lomba Karya Tulis Ilmiah Nasional 2024',
                'kategori' => 'Karya Ilmiah',
                'tingkat' => 'Nasional',
                'peringkat' => 'Juara 1',
                'penyelenggara' => 'Universitas Gadjah Mada',
                'tanggal' => '10 September 2024',
                'tahun' => '2024',
                'poin' => 200,
                'status' => 'Terverifikasi',
                'catatan' => 'Sertifikat dan naskah terverifikasi.',
                'berkas' => 'lkti-ugm-2024.pdf',
            ],
            [
                'id' => 8,
                'nim' => '240102041',
                'mahasiswa' => 'Fajar Ramadhan',
                'prodi' => 'Sistem Informasi',
                'judul' => 'Juara Harapan 1 Mobile App Innovation Summit 2024',
                'kategori' => 'Teknologi & Desain',
                'tingkat' => 'Nasional',
                'peringkat' => 'Juara Harapan 1',
                'penyelenggara' => 'Google Developer Student Clubs Indonesia',
                'tanggal' => '22 September 2024',
                'tahun' => '2024',
                'poin' => 90,
                'status' => 'Terverifikasi',
                'catatan' => 'Aplikasi lolos tahap final nasional.',
                'berkas' => 'gdsc-cert-2024.pdf',
            ],
            [
                'id' => 9,
                'nim' => '240102054',
                'mahasiswa' => 'Nadya Adella Putri',
                'prodi' => 'Sistem Informasi',
                'judul' => 'Finalis Capture The Flag Cybersecurity National 2024',
                'kategori' => 'Teknologi & Desain',
                'tingkat' => 'Nasional',
                'peringkat' => 'Finalis',
                'penyelenggara' => 'Badan Siber dan Sandi Negara (BSSN)',
                'tanggal' => '28 September 2024',
                'tahun' => '2024',
                'poin' => 50,
                'status' => 'Menunggu Verifikasi',
                'catatan' => 'Menunggu validasi dokumen sertifikat dari BSSN.',
                'berkas' => 'bssn-ctf-finalist.pdf',
            ],
        ];
    }

    private function getAllAchievements(): array
    {
        $sessionData = session('presto_achievements');
        if (!is_array($sessionData)) {
            $sessionData = $this->getInitialAchievements();
            session(['presto_achievements' => $sessionData]);
        }
        return $sessionData;
    }

    public function dashboard(): View
    {
        return view('pages.dashboard', [
            'title' => 'Dashboard - PRESTO',
            'active' => 'dashboard',
        ]);
    }

    public function laporan(Request $request): View
    {
        $userNim = session('user_identifier', '240102054');
        $userName = session('user_name', 'Nadya Adella Putri');
        $userRole = session('user_role', 'mahasiswa');

        $all = $this->getAllAchievements();

        // If admin, show all or filtered; if mahasiswa, show their own
        if ($userRole === 'admin') {
            $myAchievements = $all;
        } else {
            $myAchievements = array_values(array_filter($all, function ($item) use ($userNim, $userName) {
                return $item['nim'] === $userNim || $item['mahasiswa'] === $userName;
            }));
            // fallback if newly registered user has no match, show default demo user achievements
            if (empty($myAchievements)) {
                $myAchievements = array_values(array_filter($all, fn($item) => $item['nim'] === '240102054'));
            }
        }

        // Calculate accumulated points for verified achievements
        $totalPoin = array_reduce($myAchievements, function ($carry, $item) {
            return $carry + ($item['status'] === 'Terverifikasi' ? ($item['poin'] ?? 0) : 0);
        }, 0);

        // Filter search query if provided
        $search = $request->query('q');
        if ($search) {
            $searchLower = strtolower($search);
            $myAchievements = array_values(array_filter($myAchievements, function ($item) use ($searchLower) {
                return str_contains(strtolower($item['judul']), $searchLower)
                    || str_contains(strtolower($item['kategori']), $searchLower)
                    || str_contains(strtolower($item['tingkat']), $searchLower);
            }));
        }

        return view('pages.laporan', [
            'title' => 'Laporan Prestasi - PRESTO',
            'active' => 'laporan',
            'role' => $userRole,
            'name' => $userName,
            'nim' => $userNim,
            'totalPoin' => $totalPoin,
            'achievements' => $myAchievements,
            'search' => $search,
        ]);
    }

    public function tambahPrestasi(): View
    {
        return view('pages.tambah-prestasi', [
            'title' => 'Tambah Prestasi Baru - PRESTO',
            'active' => 'laporan',
            'name' => session('user_name', 'Nadya Adella Putri'),
            'nim' => session('user_identifier', '240102054'),
        ]);
    }

    public function storePrestasi(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:200'],
            'kategori' => ['required', 'string'],
            'tingkat' => ['required', 'string'],
            'peringkat' => ['required', 'string'],
            'penyelenggara' => ['required', 'string', 'max:150'],
            'tanggal' => ['required', 'string'],
            'deskripsi' => ['nullable', 'string', 'max:500'],
        ], [
            'judul.required' => 'Nama kegiatan / prestasi wajib diisi.',
            'kategori.required' => 'Kategori bidang wajib dipilih.',
            'tingkat.required' => 'Tingkat kompetisi wajib dipilih.',
            'peringkat.required' => 'Capaian prestasi wajib dipilih.',
            'penyelenggara.required' => 'Nama penyelenggara wajib diisi.',
            'tanggal.required' => 'Tanggal pelaksanaan wajib diisi.',
        ]);

        $all = $this->getAllAchievements();

        // Calculate points based on level
        $pointMap = [
            'Internasional' => 250,
            'Nasional' => 200,
            'Regional' => 140,
            'Provinsi' => 120,
            'Universitas' => 80,
        ];
        $calculatedPoint = $pointMap[$validated['tingkat']] ?? 100;

        $newEntry = [
            'id' => count($all) + 1,
            'nim' => session('user_identifier', '240102054'),
            'mahasiswa' => session('user_name', 'Nadya Adella Putri'),
            'prodi' => 'Sistem Informasi',
            'judul' => $validated['judul'],
            'kategori' => $validated['kategori'],
            'tingkat' => $validated['tingkat'],
            'peringkat' => $validated['peringkat'],
            'penyelenggara' => $validated['penyelenggara'],
            'tanggal' => date('d M Y', strtotime($validated['tanggal'])),
            'tahun' => date('Y', strtotime($validated['tanggal'])),
            'poin' => $calculatedPoint,
            'status' => 'Menunggu Verifikasi',
            'catatan' => 'Laporan baru dikirim, menunggu verifikasi oleh tim HIMATRIS.',
            'berkas' => 'berkas_bukti_' . time() . '.pdf',
        ];

        array_unshift($all, $newEntry);
        session(['presto_achievements' => $all]);

        return redirect()->route('laporan')->with('success', 'Prestasi berhasil dilaporkan dan sedang menunggu verifikasi oleh HIMATRIS!');
    }

    public function arsip(Request $request): View
    {
        $all = $this->getAllAchievements();

        $search = $request->query('q');
        $tingkat = $request->query('tingkat');
        $kategori = $request->query('kategori');
        $status = $request->query('status');

        $filtered = array_values(array_filter($all, function ($item) use ($search, $tingkat, $kategori, $status) {
            if ($search) {
                $term = strtolower($search);
                $matches = str_contains(strtolower($item['judul']), $term)
                    || str_contains(strtolower($item['mahasiswa']), $term)
                    || str_contains(strtolower($item['nim']), $term)
                    || str_contains(strtolower($item['penyelenggara']), $term);
                if (!$matches) {
                    return false;
                }
            }
            if ($tingkat && $item['tingkat'] !== $tingkat) {
                return false;
            }
            if ($kategori && $item['kategori'] !== $kategori) {
                return false;
            }
            if ($status && $item['status'] !== $status) {
                return false;
            }
            return true;
        }));

        return view('pages.arsip', [
            'title' => 'Arsip Prestasi - PRESTO',
            'active' => 'arsip',
            'achievements' => $filtered,
            'search' => $search,
            'selectedTingkat' => $tingkat,
            'selectedKategori' => $kategori,
            'selectedStatus' => $status,
        ]);
    }

    public function hallOfFame(): View
    {
        $all = $this->getAllAchievements();

        // Aggregate points and achievements by student
        $studentMap = [];
        foreach ($all as $item) {
            $nim = $item['nim'];
            if (!isset($studentMap[$nim])) {
                $studentMap[$nim] = [
                    'nim' => $nim,
                    'name' => $item['mahasiswa'],
                    'prodi' => $item['prodi'],
                    'points' => 0,
                    'total_achievements' => 0,
                    'top_achievement' => $item['judul'],
                ];
            }
            $studentMap[$nim]['total_achievements']++;
            if ($item['status'] === 'Terverifikasi') {
                $studentMap[$nim]['points'] += $item['poin'] ?? 0;
            }
        }

        // Sort descending by points
        usort($studentMap, function ($a, $b) {
            if ($a['points'] === $b['points']) {
                return $b['total_achievements'] <=> $a['total_achievements'];
            }
            return $b['points'] <=> $a['points'];
        });

        // Add additional top candidates if list is short to make podium & leaderboard glorious
        if (count($studentMap) < 6) {
            $extras = [
                ['nim' => '230102044', 'name' => 'Dimas Aditya Saputra', 'prodi' => 'Teknik Informatika', 'points' => 190, 'total_achievements' => 2, 'top_achievement' => 'Juara 1 Web Design Festival 2024'],
                ['nim' => '240102081', 'name' => 'Kezia Aurelia', 'prodi' => 'Sistem Informasi', 'points' => 170, 'total_achievements' => 2, 'top_achievement' => 'Juara 2 National Pitching Battle 2024'],
                ['nim' => '230103015', 'name' => 'Farhan Maulana', 'prodi' => 'Teknik Komputer', 'points' => 150, 'total_achievements' => 1, 'top_achievement' => 'Juara 1 IoT Prototype Expo 2024'],
            ];
            foreach ($extras as $extra) {
                if (!isset($studentMap[$extra['nim']])) {
                    $studentMap[] = $extra;
                }
            }
            usort($studentMap, fn($a, $b) => $b['points'] <=> $a['points']);
        }

        // Assign ranks
        $ranked = [];
        $rank = 1;
        foreach ($studentMap as $student) {
            $student['rank'] = $rank++;
            $ranked[] = $student;
        }

        $topThree = [
            'first' => $ranked[0] ?? null,
            'second' => $ranked[1] ?? null,
            'third' => $ranked[2] ?? null,
        ];
        $leaderboard = array_slice($ranked, 3);

        return view('pages.hall', [
            'title' => 'Hall of Fame - PRESTO',
            'active' => 'hall',
            'topThree' => $topThree,
            'leaderboard' => $leaderboard,
        ]);
    }
}
