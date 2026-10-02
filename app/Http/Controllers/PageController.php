<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PageController extends Controller
{
    public function dashboard(): View
    {
        $totalPrestasi = Prestasi::count();
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $totalNasional = Prestasi::where('tingkat', 'Nasional')->count();
        $totalInternasional = Prestasi::where('tingkat', 'Internasional')->count();

        return view('pages.dashboard', [
            'title' => 'Dashboard - PRESTO',
            'active' => 'dashboard',
            'stats' => [
                'total_prestasi' => $totalPrestasi,
                'total_mahasiswa' => $totalMahasiswa,
                'total_nasional' => $totalNasional,
                'total_internasional' => $totalInternasional,
            ],
        ]);
    }

    public function laporan(Request $request): View
    {
        $user = Auth::user();
        $userRole = $user ? $user->role : session('user_role', 'mahasiswa');
        $userName = $user ? $user->name : session('user_name', 'Nadya Adella Putri');
        $userNim = $user ? $user->nim : session('user_identifier', '240102054');

        $query = Prestasi::query();

        // Jika peran mahasiswa, tampilkan prestasinya sendiri
        if ($userRole !== 'admin') {
            $query->where(function ($q) use ($user, $userNim) {
                if ($user) {
                    $q->where('user_id', $user->id)->orWhere('nim', $user->nim);
                } else {
                    $q->where('nim', $userNim);
                }
            });
        }

        // Filter pencarian jika ada
        $search = $request->query('q');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%")
                  ->orWhere('tingkat', 'like', "%{$search}%")
                  ->orWhere('mahasiswa', 'like', "%{$search}%")
                  ->orWhere('penyelenggara', 'like', "%{$search}%");
            });
        }

        $achievements = $query->orderByDesc('tanggal')->orderByDesc('id')->get();

        // Hitung total akumulasi poin dari prestasi yang terverifikasi
        $totalPoin = $achievements->where('status', 'Terverifikasi')->sum('poin');

        return view('pages.laporan', [
            'title' => 'Laporan Prestasi - PRESTO',
            'active' => 'laporan',
            'role' => $userRole,
            'name' => $userName,
            'nim' => $userNim,
            'totalPoin' => $totalPoin,
            'achievements' => $achievements,
            'search' => $search,
        ]);
    }

    public function tambahPrestasi(): View
    {
        $user = Auth::user();
        return view('pages.tambah-prestasi', [
            'title' => 'Tambah Prestasi Baru - PRESTO',
            'active' => 'laporan',
            'name' => $user ? $user->name : session('user_name', 'Nadya Adella Putri'),
            'nim' => $user ? $user->nim : session('user_identifier', '240102054'),
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
            'tanggal' => ['required', 'date'],
            'deskripsi' => ['nullable', 'string', 'max:500'],
            'berkas' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
        ], [
            'judul.required' => 'Nama kegiatan / prestasi wajib diisi.',
            'kategori.required' => 'Kategori bidang wajib dipilih.',
            'tingkat.required' => 'Tingkat kompetisi wajib dipilih.',
            'peringkat.required' => 'Capaian prestasi wajib dipilih.',
            'penyelenggara.required' => 'Nama penyelenggara wajib diisi.',
            'tanggal.required' => 'Tanggal pelaksanaan wajib diisi.',
            'berkas.max' => 'Ukuran berkas dokumen maksimal 5MB.',
        ]);

        $user = Auth::user();
        $nim = $user ? $user->nim : session('user_identifier', '240102054');
        $nama = $user ? $user->name : session('user_name', 'Nadya Adella Putri');
        $prodi = $user ? ($user->prodi ?? 'Sistem Informasi') : 'Sistem Informasi';

        // Hitung poin otomatis dari tingkat perlombaan
        $calculatedPoint = Prestasi::calculatePoints($validated['tingkat']);

        // Simpan file bukti sertifikat jika diunggah
        $berkasName = 'berkas_bukti_' . time() . '.pdf';
        if ($request->hasFile('berkas')) {
            $file = $request->file('berkas');
            $berkasName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $file->storeAs('public/berkas_prestasi', $berkasName);
        }

        Prestasi::create([
            'user_id' => $user ? $user->id : null,
            'nim' => $nim,
            'mahasiswa' => $nama,
            'prodi' => $prodi,
            'judul' => $validated['judul'],
            'kategori' => $validated['kategori'],
            'tingkat' => $validated['tingkat'],
            'peringkat' => $validated['peringkat'],
            'penyelenggara' => $validated['penyelenggara'],
            'tanggal' => $validated['tanggal'],
            'tahun' => date('Y', strtotime($validated['tanggal'])),
            'poin' => $calculatedPoint,
            'status' => 'Menunggu Verifikasi',
            'catatan' => 'Laporan baru dikirim, menunggu verifikasi oleh tim HIMATRIS.',
            'berkas' => $berkasName,
        ]);

        return redirect()->route('laporan')->with('success', 'Prestasi berhasil dilaporkan dan tersimpan ke database PRESTO! Menunggu verifikasi.');
    }

    public function arsip(Request $request): View
    {
        $search = $request->query('q');
        $tingkat = $request->query('tingkat');
        $kategori = $request->query('kategori');
        $status = $request->query('status');

        $query = Prestasi::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('mahasiswa', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%")
                  ->orWhere('penyelenggara', 'like', "%{$search}%");
            });
        }

        if ($tingkat) {
            $query->where('tingkat', $tingkat);
        }

        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $achievements = $query->orderByDesc('tanggal')->orderByDesc('id')->get();

        return view('pages.arsip', [
            'title' => 'Arsip Prestasi - PRESTO',
            'active' => 'arsip',
            'achievements' => $achievements,
            'search' => $search,
            'selectedTingkat' => $tingkat,
            'selectedKategori' => $kategori,
            'selectedStatus' => $status,
        ]);
    }

    public function hallOfFame(): View
    {
        // Ambil semua prestasi dari database
        $all = Prestasi::all();

        // Agregasi poin dan prestasi per mahasiswa
        $studentMap = [];
        foreach ($all as $item) {
            $nim = $item->nim;
            if (!isset($studentMap[$nim])) {
                $studentMap[$nim] = [
                    'nim' => $nim,
                    'name' => $item->mahasiswa,
                    'prodi' => $item->prodi,
                    'points' => 0,
                    'total_achievements' => 0,
                    'top_achievement' => $item->judul,
                ];
            }
            $studentMap[$nim]['total_achievements']++;
            if ($item->status === 'Terverifikasi') {
                $studentMap[$nim]['points'] += $item->poin;
            }
        }

        // Urutkan mahasiswa berdasarkan poin tertinggi
        usort($studentMap, function ($a, $b) {
            if ($a['points'] === $b['points']) {
                return $b['total_achievements'] <=> $a['total_achievements'];
            }
            return $b['points'] <=> $a['points'];
        });

        // Tetapkan peringkat
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

    public function verifikasi(Request $request, $id): RedirectResponse
    {
        $prestasi = Prestasi::findOrFail($id);
        $action = $request->input('action'); // 'approve' atau 'reject'
        $catatan = $request->input('catatan');

        $adminId = Auth::id() ?: User::where('role', 'admin')->value('id');

        if ($action === 'approve') {
            $prestasi->update([
                'status' => 'Terverifikasi',
                'catatan' => $catatan ?: 'Sertifikat dan berkas telah diverifikasi secara sah oleh Tim Admin HIMATRIS.',
                'verified_at' => now(),
                'verified_by' => $adminId,
            ]);
            return back()->with('success', 'Prestasi "' . $prestasi->judul . '" berhasil disetujui (Terverifikasi)!');
        } else {
            $prestasi->update([
                'status' => 'Ditolak',
                'catatan' => $catatan ?: 'Dokumen tidak valid atau tidak sesuai ketentuan.',
                'verified_at' => now(),
                'verified_by' => $adminId,
            ]);
            return back()->with('success', 'Prestasi "' . $prestasi->judul . '" ditolak.');
        }
    }
}
